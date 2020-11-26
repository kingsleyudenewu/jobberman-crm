<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $employee = Employee::paginate(5);
            return  $this->successResponse('success', $employee);
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

    public function store(Request  $request)
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

    public function update(Request  $request, Employee $employee)
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
            $employee->update([
                'company_id' => $request->company_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            DB::commit();
            return $this->createdResponse('Employee updated successfully');
        }
        catch (\Exception $exception) {
            DB::rollBack();
            return $this->serverErrorAlert('error', $exception);
        }
    }

    public function destroy(Employee  $employee)
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
