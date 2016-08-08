<?php

namespace App\Http\Controllers;

use App\Http\Controllers\shop\CartController;
use App\Models\Product;
use App\Http\Controllers\shop\CartController as Cart;
use Cookie;
use App\Models\Page;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\TrackingController;

class SiteController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index($url, Request $request)
    {
        // get the page information
        $page = Page::where("url", "=", $url)
            ->where('live', '=', 'Y')
            ->first();
        
        // set a page track
        $tracking = new TrackingController;
        $tracking->track($page, $request);

        // return the view and the page data.
        return view('site.article', ['page' => $page]);
    }

    public function shop($productName, Request $request)
    {
        $product = Product::where('name','=', $productName)
            ->where('live','=', 'Y')
            ->first();

        // set a product track
        $tracking = new TrackingController;
        $tracking->trackShop($product, $request);

        return view('site.product', ['product' => $product]);
    }
}
