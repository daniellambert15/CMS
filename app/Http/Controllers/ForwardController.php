<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CookieJar;
use App\Models\User;
use App\Models\Lead;
use App\Models\Page;
use App\Http\Requests;
use App\Models\Forward;

class ForwardController extends Controller
{

    public function forward(Request $request, CookieJar $cookieJar ,$trackingId = null)
    {
        // So the user has hit a forwarding URL, we want to figure out these:
        // What page they're going to
        // What their email address is, so we can pick out their trackingCode and set a cookie
        // If they've got a tracking code, just set the cookie.

        // At a later date, i'll be adding campaign info to here as well.

        if($request->input('email')){

            $lead = Lead::where('email', '=', $request->input('email'))->first();

            if(count($lead))
            {
                $trackingId = $lead->trackingId;
            }else{
                $user = User::where('email', '=', $request->input('email'))->first();
                $trackingId = $user->trackingId;
            }
        }

        if(!isset($trackingId)){
            $trackingId = $request->input('trackingId');
        }

        if(isset($trackingId))
        {
            $cookieJar->queue('trackingId', $trackingId, 525600 * 8);
        }
        $request->session()->put('forwardId', $request->input('id'));

        $page = Forward::find($request->input('id'))->first();

        return redirect($page->url.'.html');
    }

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.lists.forwards', ['forwards' => Forward::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create.forward', ['pages' => Page::where('live', '=', "Y")->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $forward = new Forward;
        $forward->url = $request->input('url');
        $forward->description = $request->input('description');
        $forward->save();
        return redirect()->route('dashboard.list.forwards')->with('success', 'Forward Added!');
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
        $forward = Forward::find($id);
        $forward->delete();
        return redirect()->route('dashboard.list.forwards')->with('success', 'Forward has been successfully deleted!');
    }
}
