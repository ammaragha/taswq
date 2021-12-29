<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Traits\UserTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    use UserTrait;


    /**
     * Regestration for new users
     * @param App\Http\Requests\Api\RegisterRequest $request
     * @return response
     */

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create($this->userRecord($request, true));
            $success['token'] = $user->createToken('appToken')->accessToken;

            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => $user
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'Success' => false,
                'msg' => 'Something wrong',
            ]);
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
            $success['token'] = $user->createToken('appToken')->accessToken;
            return response()->json([
                'success' => true,
                'token' => $success,
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
