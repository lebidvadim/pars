<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateApi extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        $token = config('app.api_token');
        if($request->bearerToken() == $token) {
            return;
        }
        $this->unauthenticated($request, $guards);
    }

}
