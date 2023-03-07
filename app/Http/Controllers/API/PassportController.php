<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class PassportController extends ApiController
{
    public function register(UserRequest $request)
    {
        $input = $request->only(['name', 'email', 'password']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);

        return $this->successResponse([], 'User registered succesfully, Use Login method to receive token.');
    }


    public function login(UserLoginRequest $request)
    {
        $input = $request->only(['email', 'password']);

        // authentication attempt
        if (auth()->attempt($input)) {
            $token = auth()->user()->createToken('passport_token')->accessToken;

            return $this->successResponse($token, 'User login succesfully, Use token to authenticate.');
        } else {

            return $this->errorResponse('User authentication failed.', 401);
        }
    }

    public function logout()
    {
        $access_token = auth()->user()->token();

        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken($access_token->id);

        return $this->successResponse('User logout successfully.');
    }
}
