<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Cookie;
use App\Models\Lead;
use App\Models\Page;
use App\Models\User;
use App\Models\Product;
use App\Models\Tracking;
use App\Models\TrackingClick;

class TrackingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function track($page, $request)
    {
        $tracking = new Tracking;
        $tracking->trackingId = session('trackingId');
        $tracking->pageId = $page->id;
        $tracking->type_id = '1';
        $tracking->IP = $_SERVER['REMOTE_ADDR'];
        if(isset($_SERVER['HTTP_USER_AGENT'])){$tracking->browser = $_SERVER['HTTP_USER_AGENT'];}
        if(isset($_SERVER['HTTP_REFERER'])){$tracking->referer = $_SERVER['HTTP_REFERER'];}
        $tracking->visitedBefore = session('visitedBefore');
        if($request->session()->get('forwardId') != null){$tracking->forwardId = $request->session()->get('forwardId');}else{$tracking->forwardId = 0;}
        $tracking->save();
    }

    public function trackShop($Product, $request)
    {
        $tracking = new Tracking;
        $tracking->trackingId = session('trackingId');
        $tracking->pageId = $Product->id;
        $tracking->type_id = '2';
        $tracking->IP = $_SERVER['REMOTE_ADDR'];
        if(isset($_SERVER['HTTP_USER_AGENT'])){$tracking->browser = $_SERVER['HTTP_USER_AGENT'];}
        if(isset($_SERVER['HTTP_REFERER'])){$tracking->referer = $_SERVER['HTTP_REFERER'];}
        $tracking->visitedBefore = session('visitedBefore');
        if($request->session()->get('forwardId') != null){$tracking->forwardId = $request->session()->get('forwardId');}else{$tracking->forwardId = 0;}
        $tracking->save();
    }


    public function trackingClick(Request $request)
    {
        $tracking = Tracking::where('trackingId', '=' , session('trackingId'))->orderBy('id', 'desc')->first();

    	$trackingClick = new TrackingClick;
    	$trackingClick->tracking_id = $tracking->id;
    	$trackingClick->name = $request->input('name');
    	$trackingClick->type = $request->input('type');
    	$trackingClick->action = $request->input('action');
    	$trackingClick->save();
    }

    public function pageAnalytics()
    {
        return view('admin.lists.pageAnalytics', ['pages' => Page::all(), 'products' => Product::all() ]);
    }

    public function pageUsers($pageId)
    {
        return view('admin.lists.pageUsers', [
            'trackings' => Tracking::where('pageId', "=", $pageId)->where('type_id', 1)->groupBy('trackingId')->orderBy('created_at', 'desc')->get(),
            'leads' => Lead::where('pageId', "=", $pageId)->where('type_id', 1)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function productUsers($pageId)
    {
        return view('admin.lists.productUsers', [
            'trackings' => Tracking::where('pageId', "=", $pageId)->where('type_id', 2)->groupBy('trackingId')->orderBy('created_at', 'desc')->get(),
            'leads' => Lead::where('pageId', "=", $pageId)->where('type_id', 2)->orderBy('created_at', 'desc')->get()
        ]);
    }


    public function trackedUser($trackingId)
    {
        return view('admin.lists.trackedUser', [
            'trackings' => Tracking::where('trackingId', '=', $trackingId)
                ->orderBy('created_at', 'desc')->get(),
            'leads' => Lead::where('trackingId', '=', $trackingId)
                ->orderBy('created_at', 'desc')->get()
        ]);
    }


    public function checkEmail($request)
    {
        // firstly get the current tracking code.
        $trackingCode = $request->cookie('trackingId');

        // now we check if the email has previously enquired. then set the tracking cookie
        // to match theirs of a previous time.

        $lead = Lead::where('email','=',$request->input('email'))->first();

        if(count($lead) > 0)
        {
            $trackingCode = $lead->trackingId;
        }

        // Now, if the lead has signed up for a user account, that tracking code assigned to that user will trump
        // all of the other assigned tracking codes.

        $user = User::where('email','=',$request->input('email'))->first();

        if(count($user) > 0)
        {
            $trackingCode = $user->trackingId;
        }

        // now we want to update ALL their clicks they've done now, with the old tracking Id, IF a new one is set.

        if($request->cookie('trackingId') != $trackingCode)
        {
            Cookie::queue('trackingId', $trackingCode, time() + (10 * 365 * 24));
            Tracking::where('trackingId',"=",$request->cookie('trackingId'))->update(['trackingId' => $trackingCode]);
            Lead::where('trackingId',"=",$request->cookie('trackingId'))->update(['trackingId' => $trackingCode]);
        }

        return $trackingCode;
    }
}
