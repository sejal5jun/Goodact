<?php

namespace App\Api\V1\Controllers;

use Config;
use App\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Api\V1\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Dingo\Api\Exception\ValidationHttpException;

class ResetPasswordController extends Controller
{
    public function resetPassword(ResetPasswordRequest $request, JWTAuth $JWTAuth)
    {
        $token = $request->input('reset_token');
        $password = $request->input('password');

        try {
            $user = User::where('password_reset_token', $token)->firstOrFail();
        }
        catch (\Exception $e) {
            throw new ValidationHttpException([ 'reset_token' => 'Invalid Token']);
        }

        if(time() > $user->password_token_expiry){
            throw new ValidationHttpException([ 'reset_token' => 'Token Expired']);
        }


        $user->password = $password;
        $user->password_reset_token = '';
        $user->save();

        return response()
            ->json([
                'status' => 'ok',
                'success_message' => 'Password has been Reset! Please login with your new password.'
            ]);
    }

    public function checkToken(Request $request){

        if(!$request->has('reset_token')) throw new HttpException(500);
        
        $token = $request->input('reset_token');
        
        try {
            $user = User::where('password_reset_token', $token)->firstOrFail();
        }
        catch (\Exception $e) {
            return response()
                ->json([
                    'status' => 'error',
                    'token_expired' => true
                ], 406);
        }

        return response()
            ->json([
                'status' => 'error',
                'token_expired' => true
            ]);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  ResetPasswordRequest  $request
     * @return array
     */
    protected function credentials(ResetPasswordRequest $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function reset($user, $password)
    {
        $user->password = $password;
        $user->save();
    }
}
