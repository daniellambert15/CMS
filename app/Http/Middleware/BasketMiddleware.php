<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Support\Facades\Auth;

class BasketMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $cartId;
    protected $userId;

    public function handle($request, Closure $next)
    {
        // First we need to check if the user hasn't had a basket before.
        // However, they might have cleared their cookies.

        $this->userId = null;

        if (Auth::guard('customer')->check()) {
            $this->userId = Auth::guard('customer')->user()->id;
        }


        if(!$request->cookie('basketId'))
        {

            if($this->userId != null)
            {
                // so we've got the userID, we want to set all the cart's up to use the current user ID's tracking code.

                Cart::where('customer_id', $this->userId)->
                update(['tracking_id' => session('trackingId')]);

                $cart = Cart::Where('customer_id', $this->userId)
                    ->where('invoice_id', null)
                    ->where('processed', "N")->get()->first();

                $this->cartId = $cart->id;

            }else{
                $cart = Cart::Where('tracking_id', session('trackingId'))
                    ->where('invoice_id', null)
                    ->where('processed', "N")->get()->first();

                if($cart){
                    $this->cartId = $cart->id;
                }
            }

            if($this->cartId == null){
                $cart = New Cart;
                $cart->customer_id = $this->cartId;
                $cart->tracking_id = session('trackingId');
                $cart->save();

                $this->cartId = $cart->id;

            }

            $request->session()->put('basketId', $this->cartId);
            $response = $next($request);
            $response->withCookie('basketId', $this->cartId, 60*60*24*7);

            // right, so we've setup a session AND a cookie, allow the user to go through to the correct page.
            return $response;
        }

        // Now we need to check if the user has visited before

        else
        {
            // just give the request session a cookie value
            $request->session()->put('basketId', $request->cookie('basketId'));

            // right its all good! we've setup our
            return $next($request);
        }
    }
}
