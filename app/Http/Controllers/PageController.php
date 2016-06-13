<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gate;
use App\Models\Page;
use App\Models\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
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
        if (Gate::denies('listPages')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.lists.page', ['Pages' => Page::all(), 'deletedPages' => Page::onlyTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        if (Gate::denies('createPage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.create.page', ['Pages' => Page::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('createPage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|unique:pages',
            'title' => 'required',
            'type' => 'required',
            'content' => 'required',
            'contactForm' => 'required',
            'metaDescription' => 'required',
            'live' => 'required',
            'hidden' => 'required',
            'page_id' => 'required',
            'blueBarTitle' => 'required',
            'affiliate_id' => 'required',
            'sitemap' => 'required',
        ]); 

        Page::create($request->input());
        Return redirect()->route('dashboard.list.pages')->with('success', 'page "'.$request->input('name').'" has been created');
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
        if (Gate::denies('editPage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.edit.page', ['page' => Page::findOrFail($id), 'pages' => Page::where('live', '=', "Y")->get()]);
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
        
        if (Gate::denies('editPage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        if($request->input('url') != $request->input('oldurl'))
        {
            $this->validate($request, [
                'name' => 'required',
                'url' => 'required|unique:pages',
                'title' => 'required',
                'type' => 'required',
                'content' => 'required',
                'contactForm' => 'required',
                'metaDescription' => 'required',
                'live' => 'required',
                'hidden' => 'required',
                'page_id' => 'required',
                'blueBarTitle' => 'required',
                'affiliate_id' => 'required',
                'sitemap' => 'required',
            ]);
        }else{
            $this->validate($request, [
                'name' => 'required',
                'url' => 'required',
                'title' => 'required',
                'type' => 'required',
                'content' => 'required',
                'contactForm' => 'required',
                'metaDescription' => 'required',
                'live' => 'required',
                'hidden' => 'required',
                'page_id' => 'required',
                'blueBarTitle' => 'required',
                'affiliate_id' => 'required',
                'sitemap' => 'required',
            ]);
        }

        $page = Page::findOrFail($request->input('id'));

        $page->name = $request->input('name');
        $page->url = $request->input('url');
        $page->title = $request->input('title');
        $page->type = $request->input('type');
        $page->content = $request->input('content');
        $page->contactForm = $request->input('contactForm');
        $page->metaDescription = $request->input('metaDescription');
        $page->live = $request->input('live');
        $page->hidden = $request->input('hidden');
        $page->page_id = $request->input('page_id');
        $page->blueBarTitle = $request->input('blueBarTitle');
        $page->affiliate_id = $request->input('affiliate_id');
        $page->sitemap = $request->input('sitemap');

        $page->save();

        Return redirect()->route('dashboard.list.pages')->with('success', 'page "'.$request->input('name').'" has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('deletePage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Page::findOrFail($id)->delete();
        Return redirect()->route('dashboard.list.pages')->with('success', 'page has been deleted');
    }

    public function undestroy($id)
    {
        if (Gate::denies('restorePage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Page::onlyTrashed($id)->restore();
        Return redirect()->route('dashboard.list.pages')->with('success', 'page has been undeleted');
    }


    public function imagesPage($id){

        if (Gate::denies('editPage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        return view('admin.lists.pageImages', ['images' => Image::all(), 'page' => Page::findOrFail($id)]);
    }

    public function attachImagePage($pageId, $imageId)
    {

        if (Gate::denies('editPage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Page::find($pageId)->images()->attach($imageId);
        return redirect()->route('dashboard.images.page', ['id' => $pageId])->with('success', 'Image Attached');
    }

    public function detachImagePage($pageId, $imageId)
    {

        if (Gate::denies('editPage')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Page::find($pageId)->images()->detach($imageId);
        return redirect()->route('dashboard.images.page', ['id' => $pageId])->with('success', 'Image Detached!');
    }
}