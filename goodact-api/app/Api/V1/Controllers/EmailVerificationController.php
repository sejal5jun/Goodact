<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\EmailVerificationRequest;
use App\User;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Dingo\Api\Exception\ValidationHttpException;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;

use App\Mail\UserEmailVerification;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function verify_email(EmailVerificationRequest $request){
    	
       // echo 1; exit;
    	$token = $request->input('verification_token');

    	try {
    		$user = User::where('email_token', $token)->where('email_verified', 0)->firstOrFail();
    	}
        catch (\Exception $e) {
            throw new ValidationHttpException([ 'verification_token' => 'Invalid Token']);
        }

        if(time() > $user->email_token_exp){
        	throw new ValidationHttpException([ 'verification_token' => 'Token Expired']);
        }

        $user->email_verified = 1;
        $user->email_token = '';
        $user->save();

        return response()
	        ->json([
	            'status' => 'ok',
	            'success_message' => 'Email verified successfully! Please login to continue.'
	        ]);
    }

    public function ResendVerification(EmailVerificationRequest $request)
    {
       $token = $request->input('verification_token'); 

       try {
            $user = User::where('email_token', $token)->where('email_verified', 0)->firstOrFail();
        }
        catch (\Exception $e) {
            throw new ValidationHttpException([ 'verification_token' => 'Invalid Token']);
        }

        $user->email_token = str_random(30);
        $user->email_token_exp = time()+3600*24; //expires in 24 hours from now
        $user->save();

        Mail::to($user->email)->send(new UserEmailVerification($user));

        return response()->json([
                'status' => 'ok',
            ], 201);
    }
}
