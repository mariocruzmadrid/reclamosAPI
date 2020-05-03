<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * create user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors(),400);
        }

        $dataInput = $request->all();
        $dataInput['password'] = bcrypt($dataInput['password']);
        $user = User::create($dataInput);
        $success['token'] = $user->createToken('authToken')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User register success');
    }


    /**
     * login user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if(auth()->attempt(['email' => $request->email,'password' => $request->password])){
            $success['token'] = auth()->user()->createToken('authToken')->accessToken;
            $success['name'] = auth()->user()->name;

            return $this->sendResponse($success, 'User login success');
        }

        return $this->sendError('Unauthorised',['error' => 'Unathorised'],400);
    }
}





















