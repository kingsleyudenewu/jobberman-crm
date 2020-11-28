<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

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
}
