<?php

namespace App\Mail;

use App\User;
use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetEmail extends Mailable
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
                ->subject('Password Reset request')
                ->view('emails.password_reset_email')
                ->with([
                        'reset_link' => Config::get('app.url')."/password-reset?reset_token=".$this->user->password_reset_token,
                        'logo' => resource_path("assets/images/munttoo-emailer-logo.jpg")
                    ]);
    }
}
