<?php

namespace App\Http\Middleware;
use App\Role;
use JWTAuth;
use Closure;
use App\User;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$params)
    {
         $user = JWTAuth::toUser(JWTAuth::getToken());

        if ($user == null) 
        {
            return response()->json(['message' => 'No user found, Unsufficient access', 'code' => 401], 401);
        }

          
        
        if ($user->hasAnyRole($params))
         {
            return $next($request);
         }
          else
           {
            return response()->json(['message' => 'User does not have sufficient access for this request', 'code' => 401], 401);
            }
    }
}
