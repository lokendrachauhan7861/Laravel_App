<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;

class UserVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        


        try{
           $token = $request->header('token');
           $payload = JWTAuth::setToken($token)->getPayload()->toArray();
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

           return response()->json(['message'=> "This Token Is Expired."], 500);
    
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    
          return response()->json(['message'=> 'Please Enter Valid Token.'],500);
            
    
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

         return response()->json(['token_required'], 500);
    
        }


        return $next($request);
    }
}

