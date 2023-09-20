<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, AuthService $authService)
    {
        $result = $authService->register(
            $request->get('app_id'),
            $request->get('os'),
            $request->get('device_uid'),
            $request->get('language')
        );

        return response($result);
    }
}
