<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            return $this->formValidationErrorAlert(Arr::flatten($validator->errors()->toArray()));
        }

        try {
            $user = User::where('email', $request->email)->first();
            if (is_null($user)) {
                return $this->notFoundAlert('User not found');
            }
            if (!Hash::check($request->password, $user->password)) {
                return $this->badRequestAlert('Invalid login credentials');
            }

            $data["email"] = $request->email;
            $data["password"] = $request->password;

            $token = auth()->attempt($data);
            if (!$token) {
                return $this->badRequestAlert('Invalid credentials');
            }

            $tokenResult = $user->createToken('web-api-token')->accessToken;
            $payload = [
                'access_token' => $tokenResult,
                'user' => $user,
                'token_type' => 'Bearer',
            ];
            return $this->successResponse('success', $payload);
        }
        catch (\Exception $exception) {
            return  $this->serverErrorAlert('error', $exception);
        }
    }
}
