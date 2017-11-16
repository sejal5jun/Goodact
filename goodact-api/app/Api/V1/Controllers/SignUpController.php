<?php

namespace App\Api\V1\Controllers;

use Config;
use App\User;
use App\WebsiteUsers;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\SignUpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Http\Request;


class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request)
    {  
    	$email = $request->input('email');
      $check_user = User::where('email',$email)->first();
    	if($check_user)
        {

           if($check_user->email_verified==1)
           {
             throw new ValidationHttpException(['email' => 'Email already used',
                 'action' => 'login']);
           }
           else
           {
             throw new ValidationHttpException(['email' => 'Email not verified.',
                 'action' => '/auth/resend_verification_email?verification_token='.$check_user->email_token
                 ]);
           }
        }
        else
         {
             $user = new User();
             $user->first_name = $request->input('first_name');
             $user->last_name = $request->input('last_name');
             $user->email = $request->input('email');
             $user->password = $request->input('password');
            if($user->save())
              return response()
            ->json([
                'status' => 'ok',
                'success_message' => 'User has created successfully'
            ]);

         }


        

    }
}
