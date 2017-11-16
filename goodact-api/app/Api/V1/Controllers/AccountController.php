<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\User;
use Illuminate\Support\Facades\Password;
use App\Api\V1\Requests\ChangePasswordRequest;
use Dingo\Api\Exception\ValidationHttpException;


class AccountController extends Controller
{

    public function ChangePassword(ChangePasswordRequest $request, JWTAuth $JWTAuth)
    {
       // echo 1; exit;
        $password = $request->input('password');
        $user = $JWTAuth->parseToken()->toUser();

        if($request->has('current_password'))
        {

        /*
        try {
            $user = User::where('password', Hash::make($request->input('current_password')))->andwhere('_id', $user->_id )->find();
        }
        catch (\Exception $e) {
            throw new ValidationHttpException([ 'current_password' => 'Current password is incorrect']);
        }
        */

        if (Hash::check($request->input('current_password'), $user->password))
        {
             $user->password = $password;
             $user->save();

        return response()
            ->json([
                'status' => 'ok',
                'success_message' => 'Password has been Reset! Please login with your new password.'
            ]);
        }
        else
        {
            throw new ValidationHttpException([ 'current_password' => 'Current password is incorrect']);
        }

        
       
        }
        else
        {
           throw new ValidationHttpException([ 'current_password' => 'Enter corrent password']); 
        }
    }
}
