<?php

namespace App\Mail;

use App\User;
use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->subject('Please verify your Email')
                ->view('emails.user_email_verification')
                ->with([
                        'verification_link' => Config::get('app.url')."/verify-email?verification_token=".$this->user->email_token,
                        'logo' => resource_path("assets/images/munttoo-emailer-logo.jpg")
                    ]);
    }
}
