<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use ApiResponse;

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


}
