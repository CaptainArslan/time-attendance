<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\RespondsWithJson;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    use RespondsWithJson;
    public function __construct()
    {
        // use middleware except for login and register.
        $this->middleware('auth:api', [
            'except' => [
                'loginAsAdmin',
            ],
        ]);
    }
    public function  loginAsAdmin(Request $request): JsonResponse
    {

        $validated = $this->validate($request, [
            'login' => ['required', 'max:128'], // Note: Required PHP intl extension.
            'password' => ['required'],
            // 'rememberMe' => ['required', 'boolean'],
        ]);

        //$user = User::getUserByEmail($validated['login']);

        // Check if the user with this email exists and retrieve an instance.
        if (($isEmail = filter_var($validated['login'], FILTER_VALIDATE_EMAIL)) && !($user = User::getUserByEmail($validated['login']))) {
            return $this->error('The provided email is incorrect. ', Response::HTTP_UNAUTHORIZED);
        }
        // Check if the user exists with this username and retrieve an instance.
        if (!$isEmail && !$user = User::getUserByUsername($validated['login'])) {
            return $this->error('The provided username is incorrect.', Response::HTTP_UNAUTHORIZED);
        }
        // Check if the user is active.
        if (!$user->isAdmin()) {
            return $this->error('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }
        // Check if the user credentials match our records.
        if (!$token = auth()->attempt([($isEmail ? 'email' : 'username') => $validated['login'], 'password' => $validated['password']])) {
            return $this->error('These credentials do not match our records', Response::HTTP_UNAUTHORIZED);
        }
        // // Check if the user has 2-factor authentication active.
        // if (isset($validated['verification_code']) and $validated['verification_code'] && $user->hasTwoFactorAuthenticationActive()) {
        //     if (! $this->verifyPhoneVerificationCode($validated['verification_code'], $user->phoneNumber)) {
        //         return $this->error('auth.error.invalid_verification_code', Response::HTTP_UNAUTHORIZED);
        //     }

        //     return $this->respondWithToken($token);
        // }
        // // Check if user has 2-factor authentication active but has not received verification code yet.
        // if ($user->hasTwoFactorAuthenticationActive()) {
        //     return $this->success('', [], Response::HTTP_NO_CONTENT);
        // }
        // Check if the user has the remember-me flag active.
        // if ($validated['rememberMe']) {
        //     $token = auth()->setTTL(336)->attempt([($isEmail ? 'email' : 'username') => $validated['login'], 'password' => $validated['password']]);
        // }

        // $user->updateLastLoginDate();

        return $this->respondWithToken($token);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return $this->success('Successfully logged out', Response::HTTP_OK);
    }
}
