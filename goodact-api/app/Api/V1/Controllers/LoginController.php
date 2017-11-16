<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\User;
use App\Institute;
use Illuminate\Support\Facades\Auth;
use Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $credentials = $request->only(['email', 'password']);
        $credentials['email_verified'] = 1;
        $credentials['status'] = 1;

         
        
        try {
            $user = User::where('email', $credentials['email'])->firstOrFail();
        } 
        catch (\Exception $e) {
            throw new UnauthorizedHttpException('Basic','Incorrect Email or Password');
        }
        
        $newuser = new User();
     
       //echo  Hash::make($credentials['password']);
       //exit();
       /*
       if(Hash::check($credentials['password'],$user->password)){
        echo 'yes';
        }
        else{
            echo 'no';
           } exit;
        */
        $user_payload = [
            'email' => $user->email
        ];
       /* if(isset($user->date_of_birth))
        {
            $birthdayTime = strtotime($user->date_of_birth);
        $ymd = date('Y-m-d',$birthdayTime);
        
         $age = date_diff(date_create($ymd), date_create('today'))->y;
         $user_payload['age'] = $age;
        }*/

      // var_dump(Auth::once($credentials)); exit;
        $token = $JWTAuth->attempt($credentials);
          //echo 2; exit;
        if(!$token) {

            if(!$user->email_verified){
                throw new UnauthorizedHttpException('Basic','Please verify your Email address');
            }

            if($user->status!=1){
                throw new UnauthorizedHttpException('Basic','Account Deactivated by admin');
            }

            throw new UnauthorizedHttpException('Basic','Incorrect Email or Password');
        }



        return response()
            ->json([
                'status' => 'ok',
                'token' => $token
            ]);
    }

    public function refresh_token(Request $request, JWTAuth $JWTAuth){
        try {
            return response()
                ->json([
                    'status' => 'ok',
                    'token' => $JWTAuth->refresh($JWTAuth->getToken())
                ]);
        } 
        catch (JWTException $e) {
            return response()
                ->json([
                    'status' => 'error',
                    'token' => $e->getMessage()
                ], 401);
        }
    }
}
