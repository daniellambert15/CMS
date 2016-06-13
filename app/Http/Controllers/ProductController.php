<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests;
use Gate;

class ProductController extends Controller
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
        if (Gate::denies('editProduct')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        return view('admin.lists.products', ['products' => Product::all(),
            'deletedProducts' => Product::onlyTrashed()->get(),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('addProduct')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        return view('admin.create.product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Gate::denies('addProduct')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        $this->validate($request, [
            'name' => 'required|unique:products',
            'description' => 'required',
            'price' => 'required|integer',
            'delivery' => 'required|integer',
            'live' => 'required',
            'hidden' => 'required',
            'sitemap' => 'required',
        ], [
            'required' => 'The :attribute field is required.',
            'unique' => 'The product :attribute should be unique.',
            'integer' => 'The product :attribute should be a whole number. So, £1.99 should be 199 - the system works in pennies.',
        ]);

        Product::create($request->input());
        Return redirect()->route('dashboard.list.products')->with('success', 'Product "' . $request->input('name') . '" has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit.product', [
            'product' => Product::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Gate::denies('editProduct')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        if ($request->input('name') != $request->input('oldName')) {
            $this->validate($request, [
                'name' => 'required|unique:products',
                'description' => 'required',
                'price' => 'required|integer',
                'delivery' => 'required|integer',
                'live' => 'required',
                'hidden' => 'required',
                'sitemap' => 'required',
            ], [
                'required' => 'The :attribute field is required.',
                'unique' => 'The product :attribute should be unique.',
                'integer' => 'The product :attribute should be a whole number. So, £1.99 should be 199 - the system works in pennies.',
            ]);
        } else {
            $this->validate($request, [
                'description' => 'required',
                'price' => 'required|integer',
                'delivery' => 'required|integer',
                'live' => 'required',
                'hidden' => 'required',
                'sitemap' => 'required',
            ], [
                'required' => 'The :attribute field is required.',
                'integer' => 'The product :attribute should be a whole number. So, £1.99 should be 199 - the system works in pennies.',
            ]);
        }

        $page = Product::findOrFail($request->input('id'));

        $page->name = $request->input('name');
        $page->price = $request->input('price');
        $page->delivery = $request->input('delivery');
        $page->description = $request->input('description');
        $page->live = $request->input('live');
        $page->hidden = $request->input('hidden');
        $page->sitemap = $request->input('sitemap');
        $page->save();

        Return redirect()->route('dashboard.list.products')->with('success', 'Product "' . $request->input('name') . '" has been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (Gate::denies('deleteProduct')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Product::find($id)->delete();
        Return redirect()->route('dashboard.list.products')->with('success', 'Your product has been removed');
    }

    public function destory($id)
    {
        if (Gate::denies('destoryProduct')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Product::onlyTrashed()->where('id', $id)->forceDelete();
        Return redirect()->route('dashboard.list.products')->with('success', 'Your product has been destoryed');
    }

    public function restore($id){

        if (Gate::denies('restoreProduct')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Product::onlyTrashed()->where('id', $id)->restore();
        $Product = Product::find($id);
        $Product->name = $Product->name.' '.date("Y-m-d H:i:s");

        $Product->save();


        Return redirect()->route('dashboard.list.products')->with('success', 'Your product has been restored - However, you\'ll need to rename the product. A timestamp has been placed on the end of the name as to stop with duplications ');
    }
}
