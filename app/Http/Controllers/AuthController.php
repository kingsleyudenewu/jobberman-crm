<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;

    private $validator;
    private $request;

    public function __construct(Request $request)
    {
        $this->validator = $this->validateCredentials($request->all());
        $this->request = $request;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminLogin(): JsonResponse
    {
        if ($this->validator->fails()) {
            return $this->formValidationErrorAlert(Arr::flatten($this->validator->errors()->toArray()));
        }

        try {
            // Validate email
            $user = $this->validateEmail('user', $this->request->email);
            if (is_null($user)) {
                return $this->notFoundAlert('User not found');
            }

            // Validate password
            if (!$this->validatePassword($user, $this->request->password)) {
                return $this->badRequestAlert('Invalid login credentials');
            }
            // Generate token for the user
            $tokenResult = $this->createToken($user, 'user');

            //Generate payload
            $payload = $this->generatePayload($tokenResult, $user);

            return $this->successResponse('success', $payload);
        } catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    public function companyLogin()
    {
        if ($this->validator->fails()) {
            return $this->formValidationErrorAlert(Arr::flatten($this->validator->errors()->toArray()));
        }

        try {
            // Validate email
            $user = $this->validateEmail('company', $this->request->email);
            if (is_null($user)) {
                return $this->notFoundAlert('User not found');
            }

            // Validate password
            if (!$this->validatePassword($user, $this->request->password)) {
                return $this->badRequestAlert('Invalid login credentials');
            }
            // Generate token for the user
            $tokenResult = $this->createToken($user, 'company');

            //Generate payload
            $payload = $this->generatePayload($tokenResult, $user);

            return $this->successResponse('success', $payload);
        } catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    public function employeeLogin()
    {
        if ($this->validator->fails()) {
            return $this->formValidationErrorAlert(Arr::flatten($this->validator->errors()->toArray()));
        }

        try {
            // Validate email
            $user = $this->validateEmail('employee', $this->request->email);
            if (is_null($user)) {
                return $this->notFoundAlert('User not found');
            }

            // Validate password
            if (!$this->validatePassword($user, $this->request->password)) {
                return $this->badRequestAlert('Invalid login credentials');
            }
            // Generate token for the user
            $tokenResult = $this->createToken($user, 'employee');

            //Generate payload
            $payload = $this->generatePayload($tokenResult, $user);

            return $this->successResponse('success', $payload);
        } catch (\Exception $exception) {
            return $this->serverErrorAlert('error', $exception);
        }
    }

    /**
     * Add endpoint to log out a user
     */
    public function logout(): JsonResponse {
        $token = $this->request->user()->token();
        $token->revoke();
        return $this->successResponse('success');
    }

    private function validateCredentials($request)
    {
        return Validator::make($request, [
            "email" => "required|email",
            "password" => "required",
        ]);
    }

    private function validateEmail($model, $email)
    {
        switch ($model) {
            case "user":
                return User::where('email', $email)->first();
                break;
            case "company":
                return Company::where('email', $email)->first();
                break;
            case "employee":
                return Employee::where('email', $email)->first();
                break;
            default:
                return null;

        }
    }

    private function validatePassword($user, $password)
    {
        if (!Hash::check($password, $user->password)) {
            return false;
        }
        return true;
    }

    private function createToken($user, $scope)
    {
        return $user->createToken('web-api-token', [$scope])->accessToken;
    }

    private function generatePayload($token, $user)
    {
        return [
            'access_token' => $token,
            'user' => $user,
            'token_type' => 'Bearer',
        ];
    }
}
