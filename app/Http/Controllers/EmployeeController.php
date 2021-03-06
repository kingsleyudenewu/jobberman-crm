<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            if (Auth::guard('api')->check()) {
                $employee = Employee::with('company')->paginate(5);
                return  $this->successResponse('success', $employee);
            }

            if (Auth::guard('company')->check()) {
                $employee = Employee::with('company')
                    ->where('company_id', auth('company')->user()->id)
                    ->paginate(5);
                return  $this->successResponse('success', $employee);
            }

            return $this->forbiddenRequestAlert('Insufficient Permission');
        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    public function show(Employee  $employee)
    {
        try {
            if (is_null($employee)) {
                return  $this->notFoundAlert('Employee not found');
            }
        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request  $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "company_id" => "required|exists:companies,id",
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
        ]);
        if ($validator->fails()) {
            return $this->formValidationErrorAlert(Arr::flatten($validator->errors()->toArray()));
        }

        DB::beginTransaction();
        try {
            Employee::create([
                'company_id' => $request->company_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            DB::commit();
            return $this->createdResponse('Employee created successfully');
        }
        catch (\Exception $exception) {
            DB::rollBack();
            return $this->serverErrorAlert('error', $exception);
        }
    }

    /**
     * @param Request $request
     * @param Employee $employee
     * @return JsonResponse
     */
    public function update(Request  $request, Employee $employee): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
        ]);
        if ($validator->fails()) {
            return $this->formValidationErrorAlert(Arr::flatten($validator->errors()->toArray()));
        }

        DB::beginTransaction();
        try {
            if ($employee->id !== auth()->user()->id) {
                return  $this->badRequestAlert('Sorry you cannot update another users profile');
            }

            $user = Employee::updateOrCreate([
                'id' => auth('employee')->user()->id
            ],[
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            DB::commit();
            return $this->createdResponse('Employee updated successfully', $user);
        }
        catch (\Exception $exception) {
            DB::rollBack();
            return $this->serverErrorAlert('error', $exception);
        }
    }

    /**
     * @param Employee $employee
     * @return JsonResponse
     */
    public function destroy(Employee  $employee): JsonResponse
    {
        try {
            $employee->delete();
            return $this->successResponse('Employee deleted successfully');
        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }
}
