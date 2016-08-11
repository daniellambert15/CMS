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
            $this->cartId = Cart::Where('customer_id', $customer)
                ->where('processed', 'N')
                ->where('invoice_id', null)->get()->first()->id;
        } else {
            $this->cartId = Cart::Where('tracking_id', session('trackingId'))
                ->where('processed', 'N')
                ->where('invoice_id', null)->get()->first()->id;
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

        // To save a messy basket, with mutiples of the same poduct in, we're going to search to see
        // if its already got the product in it.

        // get the cart information
        $cart = Cart::find(session('basketId'));

        // if cart has the product, update the price.
        if($cart->products->where('product_id', $request->input('id'))->count() > 0)
        {
            // update the product quantity
            $cart->products->where(
                'product_id',
                    $request->input('id'))->first()->increment('quantity', $request->input('quantity'));

            return redirect('/Shop/cart.html')->with('success', 'You\'ve added '.$product->name.'(s) to your basket!');
        }

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

    public function decrement($id){
        $item = Cart::find(session('basketId'))->products->where(
            'product_id',
            $id)->first();

        // update the product quantity
        if($item->quantity > 1)
        {
            $item->decrement('quantity', 1);
            return redirect('/Shop/cart.html')->with('success', 'You\'ve removed 1 item from your product total');
        }
        return redirect('/Shop/cart.html')->with('error', 'You cannot remove your last quantity. To remove the product, please press the bin icon.');
    }

    public function increment($id){
        Cart::find(session('basketId'))->products->where(
            'product_id',
            $id)->first()->increment('quantity', 1);

        return redirect('/Shop/cart.html')->with('success', 'You\'ve added 1 item from your product total');
    }

    public function trash($id){
        Cart::find(session('basketId'))->products->where(
            'product_id',
            $id)->first()->delete();

        return redirect('/Shop/cart.html')->with('success', 'You\'ve removed your product');
    }
}
