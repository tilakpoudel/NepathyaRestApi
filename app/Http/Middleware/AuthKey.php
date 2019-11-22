<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Closure;

class AuthKey
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
        // validate request with app key
        try {
            //code...
            // $token = Request::header('APP_KEY');
            $token = $request->header('APP_KEY');
            // dd($token);
            $app_token = 'NEPATHYATILAK';
            if($token !=$app_token){
                return response()->json(['message'=>'Authentication failed!!!'],401);
            }
            return $next($request);

        } catch (Exception $e) {
            //throw $th;
            print($e);
        }



        // give access if the user is only authenticated
        // if(Auth::onceBasic()){
        //     return response()->json(['message'=>'Authentication failed!!!'],401);
        // }
        return $next($request);

    }
}
