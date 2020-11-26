<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class ValidateScope
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param mixed ...$scopes
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$scopes)
    {
        if (! $request->user() || ! $request->user()->token()) {
            return $this->badRequestAlert('Invalid token credentials');
        }
        foreach ($scopes as $scope) {
            if ($request->user()->tokenCan($scope)) {
                return $next($request);
            }
        }

        return $this->forbiddenRequestAlert('Not Authorized.');
    }
}
