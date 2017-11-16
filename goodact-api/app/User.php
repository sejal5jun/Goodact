<?php

namespace App;
use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Mail\UserEmailVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Dingo\Api\Exception\ValidationHttpException;

class User extends Eloquent implements
    AuthenticatableContract,
     AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'first_name','last_name', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        static::creating(function ($model) {

            $model->email_token = str_random(30);
            $model->email_token_exp = time()+3600*24; //expires in 24 hours from now
            $model->email_verified = 0;
            $model->status = 1;
            $model->image = "assets/images/default-user.png";
            return true;
        });

        static::created(function ($model) {
            try{
                Mail::to($model->email)->send(new UserEmailVerification($model));
            }
            catch(\Exception $e){
                return true;
            }
            
        });
                
    }


     /**
     * Automatically creates hash for the user password.
     *
     * @param  string  $value
     * @return void
     */
     public function setPasswordAttribute($value)
    {
       $this->attributes['password'] = Hash::make($value);
      
    }

}
