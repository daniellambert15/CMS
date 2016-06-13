<?php

namespace App\Http\Controllers;

use App\Models\Postcode;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostcodeController extends Controller
{

    /**
     * Takes the Postcode *we hope* of the users request, then checks if its valid.
     * Once valid, it will query postcodeToOffice() which would output an ID of the office
     * We'll then take that ID and run a php switch to forward the usr back to the correct page
     *
     * @param Request $request
     */

    public function postPostcode(Request $request)
    {
        $this->validate($request,[
            'postcode' => ['required','regex:#^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$#i'],
        ]);

        // right, we now know the postcode is correct. Lets find which office it is.

        $thePostcode = str_replace(' ', '', $request->input('postcode'));
        $officeId = $this->postcodeToOffice($thePostcode);

        // now we've got the office ID, we want to forward the user to the correct page

        switch ($officeId){
            case 1:
                return redirect('/Cornwall-Devon-West-Country-Hampshire-West-Sussex.html');
            case 3:
                return redirect('/Cornwall-Devon-West-Country-Hampshire-West-Sussex.html');
            case 4:
                return redirect('/East-Anglia.html');
            case 5:
                return redirect('/Leicester-Peterborough-Northampton.html');
            case 6:
                return redirect('/South-Midlands.html');
            case 7:
                return redirect('/South-Wales.html');
            case 8:
                return redirect('/West-Midlands.html');
            case 9:
                return redirect('/North-Wales-The-Wirral-Liverpool.html');
            case 10:
                return redirect('/Greater-Manchester-and-the-North-West.html');
            case 11:
                return redirect('/Sheffield-Nottingham-Doncaster.html');
            case 12:
                return redirect('/Bradford-Leeds-Huddersfield.html');
            case 13:
                return redirect('/Hull-York-Harrogate-Darlington-Middlesbrough-Scarborough.html');
            case 14:
                return redirect('/North-East-England-Cumbria.html');
            case 15:
                return redirect('/Glasgow-Paisley-Kilmarnock.html');
            case 16:
                return redirect('/Inverness-Aberdeen-Dundee-Edinburgh.html');
            case 17:
                return redirect('/London-NW.html');
            case 18:
                return redirect('/London-NE.html');
            case 19:
                return redirect('/London-SW.html');
            case 20:
                return redirect('/London-SE.html');
            default:
                return redirect('/home.html');
        }
    }


    /**
     * Input is a postcode *we hope* and the output will be the local office ID
     *
     * @param Request $request
     */
    public function postcodeToOffice($postcode)
    {
        return Postcode::where('postcode', '=', $postcode)->first()->areaOffice;
    }
}
