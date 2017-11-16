<?php

namespace App\Api\V1\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Api\V1\Requests\ForgotPasswordRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetEmail;

class ForgotPasswordController extends Controller
{
    public function sendResetEmail(ForgotPasswordRequest $request)
    {

        

        try {
            $user = User::where('email', $request->input('email'))->firstOrFail();
        }
        catch (\Exception $e) {
            throw new NotFoundHttpException("We couldn't find any user registered with that email.");
        }

        $user->password_reset_token = str_random(30);
        $user->password_token_expiry = time()+3600*24; //expires in 24 hours from now
        $user->save();

        Mail::to($user->email)->send(new PasswordResetEmail($user));

        // if($sendingResponse !== Password::RESET_LINK_SENT) {
        //     throw new HttpException(500);
        // }

        return response()->json([
            'status' => 'ok',
            'success_message' => 'Password reset instructions have been sent to your Email Address'
        ], 200);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    private function getPasswordBroker()
    {
        return Password::broker();
    }
}
