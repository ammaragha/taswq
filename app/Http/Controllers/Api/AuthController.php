<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Traits\Api\ResponseTrait;
use App\Http\Traits\UserTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    use UserTrait,ResponseTrait;


    /**
     * Regestration for new users
     * @param App\Http\Requests\Api\RegisterRequest $request
     * @return response
     */

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create($this->userRecord($request, true));
            $token = $user->createToken('appToken')->accessToken;
            $data = ['token' => $token, 'user' => $user];
            return $this->succWithData($data);
        } catch (\Exception $th) {
            return $this->errMsg('something worng');
        }
    }

    /**
     * Login
     * @param Illuminate\Http\Request
     * @return response
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            // ->createToken('appToken')->accessToken;
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }
}
