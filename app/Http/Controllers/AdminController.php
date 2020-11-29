<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    use ApiResponse;

    public function index(User $user)
    {
        try {
            if ($user->id != auth('api')->user()->id) {
                return $this->badRequestAlert('Invalid Request');
            }
            return $this->successResponse('success', $user);
        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error');
        }
    }

    public function update(Request $request)
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
            $user = User::updateOrCreate([
                'id' => auth()->user()->id
            ],[
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            DB::commit();
            return $this->createdResponse('Employee updated successfully', $user);
        }
        catch (\Exception $exception) {
            return $this->serverErrorAlert('error');
        }
    }
}
