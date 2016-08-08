<?php

namespace App\Http\Controllers\shop;

use App\Models\Cart;
use App\Models\Cart_Product;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    var $cartId;

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user()->id;
        } else {
            $customer = null;
        }

        // check if the user has a valid unpaid cart. If they do, return the ID of that cart.
        // if they dont have a valid cart, then create one for them.

        $this->cartId = null;

        if ($customer != null) {
            $existingCart = Cart::Where('customer_id', $customer)
                ->where('processed', 'N')
                ->where('invoice_id', null)->get()->id;
            $this->cartId = $existingCart;
        } else {
            $existingCart = Cart::Where('tracking_id', session('trackingId'))
                ->where('processed', 'N')
                ->where('invoice_id', null)->get()->first()->id;
            $this->cartId = $existingCart;
        }

        if ($this->cartId == null) {
            $cart = New Cart;
            $cart->customer_id = $customer;
            $cart->tracking_id = session('trackingId');
            $cart->save();

            return $cart->id;
        }

        return $this->cartId;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // first we find the product

        $product = Product::where('id',$request->input('id'))
        ->where('live', 'Y')->get()->first();

        // this will add a product to the basket.
        $cartProduct = new Cart_Product;
        $cartProduct->cart_id = session('basketId');
        $cartProduct->product_id = $product->id;
        $cartProduct->price = $product->price;
        $cartProduct->delivery = $product->delivery;
        $cartProduct->quantity = $request->input('quantity');
        $cartProduct->save();

        return redirect('/Shop/cart.html')->with('success', 'You\'ve added '.$product->name.'(s) to your basket!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cart(){

        $cart = Cart::find(session('basketId'));
        return view('site.cart', ['cart' => $cart]);
    }
}
