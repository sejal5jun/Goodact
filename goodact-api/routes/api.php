<?php

//use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app(Router::class);

$api->version('v1', function (Router $api) {

    /** Authentication **/
    $api->group(['prefix' => 'auth'], function(Router $api) {

        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->get('verify_email', 'App\\Api\\V1\\Controllers\\EmailVerificationController@verify_email' );
        $api->get('resend_verification_email', 'App\\Api\\V1\\Controllers\\EmailVerificationController@ResendVerification');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');

    $api->get('check_reset_token', 'App\\Api\\V1\\Controllers\\ResetPasswordController@checkToken' );
    $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
        

    });


     /** Authenticated Users Routes **/

    $api->group(['middleware' => ['jwt.auth']], function(Router $api)
    {

        $api->post('change_password', 'App\\Api\\V1\\Controllers\\AccountController@ChangePassword');
    });
});    
