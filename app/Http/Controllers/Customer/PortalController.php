<?php

Namespace App\Http\Controllers\Customer;

use Auth;
use App\Http\Controllers\Controller;

class PortalController extends Controller {


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customerAuth');
    }

    public function index(){
        return view('customer.index');
    }
}