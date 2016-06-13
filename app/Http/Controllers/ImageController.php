<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gate;
use editImage;
use Validator;
use App\Models\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
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

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        if (Gate::denies('imagesTab')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.lists.images', ['images' => Image::all(), 'trashedImages' => Image::onlyTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('addImage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        return view('admin.create.image');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Gate::denies('addImage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        if ($request->hasFile('url')) {
            // getting all of the post data
            $files = $request->file('url');
            // Making counting of uploaded images
            $file_count = count($files);
            // start count how many uploaded
            $uploadcount = 0;

            $destinationPath = 'uploads';

            foreach($files as $file) {
              $rules = array('url' => 'mimes:png,gif,jpeg,jpg');
              $validator = Validator::make(array('url'=> $file), $rules);
              if($validator->passes()){
                $filename = md5(microtime()).$file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                

                // now we need to resize the image.
                $sizes = array(25,50,75,100,125,150,175,200,250,350,500,700);

                foreach($sizes as $size)
                {
                    editImage::make($destinationPath.'/'.$filename)
                        ->resize($size, null, function ($constraint) {$constraint->aspectRatio();})
                        ->save($destinationPath.'/'.$size.'/'.$filename);
                }

                $image = new Image;
                $image->url = $filename;
                $image->save();

                $uploadcount ++;
              }
            }
            if($uploadcount == $file_count){
                return redirect()->route('dashboard.list.images')->with('success', 'Images Uploaded Successfully!');
            } 
            else {
                return redirect()->route('dashboard.new.image')->with('error', 'Opps, try again!');
            }
        }else{
            return redirect()->route('dashboard.new.image')->with('error', 'Opps, you need to select an image!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('removeImage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        $image = Image::find($id);

        if(count($image) > 0)
        {
            $image->delete();
            return redirect()->route('dashboard.list.images')->with('success', 'Image has been successfully deleted!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reanimate($id)
    {
        if (Gate::denies('reanimateImage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        Image::onlyTrashed()->where('id', "=", $id)->restore();

        return redirect()->route('dashboard.list.images')->with('success', 'Image has been successfully reanimated!');
        
    }
}
