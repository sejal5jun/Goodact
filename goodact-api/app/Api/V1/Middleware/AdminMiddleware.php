<?php

namespace App\Api\V1\Middleware;

use Closure;
use Tymon\JWTAuth\Middleware\BaseMiddleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AdminMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = \JWTAuth::parseToken()->authenticate();
        
        if(!$user || $user->type != 1){
            throw new AccessDeniedHttpException('You are not authorized to perform this action.');
        }

        return $next($request);
    }
}
