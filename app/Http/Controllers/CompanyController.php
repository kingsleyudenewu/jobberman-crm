<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Traits\ApiResponse;
use App\Traits\UploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    use ApiResponse, UploadTrait;

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $companies = Company::select('name', 'email', 'url')->paginate(5);
            return $this->successResponse('success', $companies);

        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    /**
     * @return JsonResponse
     */
    public function all (): JsonResponse
    {
        try {
            $company = Company::all();
            return $this->successResponse('success', $company);
        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    /**
     * @param Company $company
     * @return JsonResponse
     */
    public function show(Company  $company): JsonResponse
    {
        try {
            if (is_null($company)) {
                return  $this->notFoundAlert('User not found');
            }
            return  $this->successResponse('success', $company);
        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    /**
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function viewEmployees(Company $company) : JsonResponse
    {
        try {
            $employees = Employee::where('company_id', $company->id)->get();
            return $this->successResponse('success', $employees);
        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request  $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "url" => "required",
            "logo" => "required|mimes:jpg,jpeg,png|max:1000",
        ]);
        if ($validator->fails()) {
            return $this->formValidationErrorAlert(Arr::flatten($validator->errors()->toArray()));
        }

        DB::beginTransaction();
        try {
            $imagePath = $this->uploadFile($request->file('logo'), 'company');
            if (! $imagePath) {
                return  $this->badRequestAlert( 'Image upload failed');
            }

            Company::create([
                'logo' => $imagePath,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'url' => $request->url,
            ]);

            DB::commit();
            return $this->createdResponse('Company created successfully');
        }
        catch (\Exception $exception) {
            DB::rollBack();
            return $this->serverErrorAlert('error', $exception);
        }
    }

    public function update(Request $request, Company $company)
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
            $user = Company::updateOrCreate([
                'id' => auth('company')->user()->id
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
}
