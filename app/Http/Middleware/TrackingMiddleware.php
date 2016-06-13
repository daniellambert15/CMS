<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tracking;
use Illuminate\Http\Response;

class TrackingMiddleware
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
        $trackingId = md5(date('l jS \of F Y h:i:s A').'SECRET'.microtime());
        
        // First we need to check if the user is brand new = No session + No cookie

        if(!$request->cookie('trackingId'))
        {
            $request->session()->put('trackingId', $trackingId);
            $request->session()->put('visitedBefore', "N");
            $response = $next($request);
            $response->withCookie(cookie()->forever('trackingId', $trackingId));
            
            // right, so we've setup a session AND a cookie, allow the user to go through to the correct page.
            return $response;
        }

        // Now we need to check if the user has visited before


        else
        {
            // just give the request session a cookie value
            $request->session()->put('trackingId', $request->cookie('trackingId'));
            $request->session()->put('visitedBefore', "Y");

            // right its all good! we've setup our 
            return $next($request);
        }


    }
}
