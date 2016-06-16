<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\TrackingController;

class ContactFormController extends Controller
{
    public function formOne(Request $request)
    {
        // we check the users email and tracking code.
        $trackingController = new TrackingController();
        $trackingCode = $trackingController->checkEmail($request);

        $userController = new CustomerController();
        $customer_id = $userController->findCustomerByEmail($request);

        // right, now we've got the correc tracking code. we want to check a few values

        $this->validate($request, [
            'firstName' => 'required',
            'surname' => 'required',
            'contactNumber' => 'required',
            'houseNumber' => 'required',
            'postcode' => ['required', 'regex:#^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$#i'],
            'email' => 'required',
            'service' => 'required',
            'optout' => 'required',
        ]);

        // now we know its valid, we want to start saving the users data
        $postcode = new PostcodeController();

        $thePostcode = str_replace(' ', '', $request->input('postcode'));

        $lead = new Lead;
        $lead->firstName = $request->input('firstName');
        $lead->surname = $request->input('surname');
        $lead->fullName = $request->input('firstName') . ' ' . $request->input('surname');
        $lead->email = $request->input('email');
        $lead->landline = $request->input('contactNumber');
        $lead->addressLine1 = $request->input('houseNumber');
        $lead->postcode = $request->input('postcode');
        $lead->serviceRequired = $request->input('service');
        $lead->trackingId = $trackingCode;
        $lead->pageId = $request->input('pageId');
        $lead->forwardedId = $request->session()->get('forwardId');
        $lead->area = $postcode->postcodeToOffice($thePostcode);
        $lead->sentToEcis = "N";

        if($customer_id){
            $lead->customer_id = $customer_id;
        }

        $lead->save();

        // now we fire the user off to the thank you page
        return redirect('thank-you.html');
    }
}
