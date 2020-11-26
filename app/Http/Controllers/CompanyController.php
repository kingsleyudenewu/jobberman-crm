<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Traits\ApiResponse;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    use ApiResponse, UploadTrait;

    public function index()
    {
        try {
            $companies = Company::paginate(5);
            return $this->successResponse('success', $companies);
        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    public function show(Company  $company)
    {
        try {
            if (is_null($company)) {
                return  $this->notFoundAlert('Company not found');
            }
            return  $this->successResponse('success', $company);
        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    public function store(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "logo" => "required|mimes:jpg,jpeg,png|max:1000",
        ]);
        if ($validator->fails()) {
            return $this->formValidationErrorAlert(Arr::flatten($validator->errors()->toArray()));
        }

        DB::beginTransaction();
        try {
            $imagePath = $this->uploadFile($request->file('image'), 'category');
            if (! $imagePath) {
                return  $this->badRequestAlert( 'Image upload failed');
            }

            Company::create([
                'logo' => $imagePath,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            DB::commit();
            return $this->createdResponse('Company created successfully');
        }
        catch (\Exception $exception) {
            DB::rollBack();
            return $this->serverErrorAlert('error', $exception);
        }

    }
}
