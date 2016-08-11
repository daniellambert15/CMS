<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Hash;
use App\Http\Requests;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('customers')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.lists.customers', ['customers' => Customer::all(), 'deletedCustomers' => Customer::onlyTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        if (Gate::denies('editCustomer')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.edit.customer', ['customer' => Customer::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if (Gate::denies('editCustomer')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        if($request->input('email') != $request->input('oldEmail'))
        {
            $this->validate($request, [
                'firstName' => 'required',
                'surname' => 'required',
                'email' => 'required|unique:customers',
            ]);
        }else{
            $this->validate($request, [
                'firstName' => 'required',
                'surname' => 'required',
            ]);
        }

        $customer = Customer::where('id', $request->input('id'))->get()->first();

        $customer->firstName = $request->input('firstName');
        $customer->surname = $request->input('surname');
        $customer->email = $request->input('email');
        $customer->telephone = $request->input('telephone');
        if($request->input('password')){
            $customer->password = Hash::make($request->input('password'));
        }
        $customer->save();

        Return redirect()->route('dashboard.list.customers')->with('success', 'Your customer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('destoryCustomer')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Customer::onlyTrashed()->where('id', $id)->forceDelete();
        Return redirect()->route('dashboard.list.customers')->with('success', 'Your customer has been destoryed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (Gate::denies('deleteCustomer')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Customer::findOrFail($id)->delete();
        Return redirect()->route('dashboard.list.customers')->with('success', 'Customer has been deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (Gate::denies('restoreCustomer')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        $customer = Customer::onlyTrashed($id)->get()->first();
        $customer->restore();
        $customer->email = $customer->email.' '.date("Y-m-d H:i:s");
        $customer->save();
        Return redirect()->route('dashboard.list.customers')->with('success', 'Customer has been restored - Please go back and edit their email address..');
    }


    /**
     * This will find the customers Id by using the Email Address via the form submit
     */

    public function findCustomerByEmail($request){

        $customer = Customer::where('email', $request->input('email'))->first();

        //dd($customer);

        if($customer){
            // great we know the lead has got an account, we want to return the customer id

            // but lets say they've submitted a few leads off, without having an account. they then sign up for an account
            // 4 form submits later, we want to then sign update all the forms sent from this customer.

            Lead::where('email', $customer->email)->update(['customer_id' => $customer->id]);

            // now  we can return the customer ID
            return $customer->id;
        }
    }

    public function customerDetails($id){
        // Display the customer details, eg:
        // invoices
        // shop orders
        // leads
        // trackings

        return view('admin.details.customer', ['customer' => Customer::findOrFail($id)]);
    }
}
