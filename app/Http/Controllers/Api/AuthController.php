<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return $this->error(Message::INVALID_CREDENTIALS, 401);
        }
        $user = User::where('email', $request->validated('email'))->first();
        $user->tokens()->delete();
        $token = $user->createToken('API TOKEN')->plainTextToken;
        $user->token = $token;

        return $this->success(Message::LOGIN_SUCCESS, new UserResource($user));
    }

    public function logout(Request $request)
    {
        DB::table('personal_access_tokens')->where('token', $request->bearerToken())->delete();
        return $this->success(Message::LOGOUT_SUCCESS);
    }
}
