<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.lists.categories',
            ['categories' => Category::all(),
            'deletedCategories' => Category::onlyTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('addCategory')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.create.category', ['categories' => Category::all()]);
    }

    public function PTC($id)
    {
        return view('admin.lists.ProductToCategory', ['products' => Product::all(), 'category' => Category::find($id)]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('addCategory')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        $this->validate($request, [
            'name' => 'required|unique:categories',
            'description' => 'required',
            'parent_id' => 'required',
            'live' => 'required',
            'hidden' => 'required',
            'sitemap' => 'required',
        ], [
            'required' => 'The :attribute field is required.'
        ]);

        Category::create($request->input());

        Return redirect()->route('dashboard.list.categories')->with('success', 'Category "' . $request->input('name') . '" has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit.category', ['category' => Category::find($id), 'categories' => Category::all()]);
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

        if (Gate::denies('editCategories')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        if ($request->input('name') != $request->input('oldName')) {
            $this->validate($request, [
                'name' => 'required|unique:products',
                'description' => 'required'
            ], [
                'required' => 'The :attribute field is required.',
                'unique' => 'The product :attribute should be unique.'
            ]);
        } else {
            $this->validate($request, [
                'description' => 'required'
            ], [
                'required' => 'The :attribute field is required.'
            ]);
        }

        $page = Category::find($request->input('id'));
        $page->name = $request->input('name');
        $page->description = $request->input('description');
        $page->parent_id = $request->input('parent_id');
        $page->live = $request->input('live');
        $page->sitemap = $request->input('sitemap');
        $page->hidden = $request->input('hidden');
        $page->save();

        Return redirect()->route('dashboard.list.categories')->with('success', 'Category "' . $request->input('name') . '" has been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (Gate::denies('deleteCategory')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Category::find($id)->delete();
        Return redirect()->route('dashboard.list.categories')->with('success', 'Your category has been removed');
    }

    public function destroy($id)
    {
        if (Gate::denies('destoryCategory')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Category::onlyTrashed()->where('id', $id)->forceDelete();
        Return redirect()->route('dashboard.list.categories')->with('success', 'Your category has been destoryed');
    }

    public function restore($id){

        if (Gate::denies('restoreCategory')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Category::onlyTrashed()->where('id', $id)->restore();
        $category = Category::find($id);
        $category->name = $category->name.' '.date("Y-m-d H:i:s");
        $category->save();
        Return redirect()->route('dashboard.list.categories')->with('success', 'Your category has been restored - However, you\'ll need to rename the category. A timestamp has been placed on the end of the name as to stop with duplications');
    }


    public function detach($productId, $categoryId)
    {
        if (Gate::denies('giveRolesPermissions')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Category::findorFail($categoryId)->products()->detach($productId);
        return redirect()->route('dashboard.add.products.category', ['category' => $categoryId])->with('success', 'Permission Attached');
    }

    public function attach($productId, $categoryId)
    {
        if (Gate::denies('giveRolesPermissions')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Category::findorFail($categoryId)->products()->attach($productId);
        return redirect()->route('dashboard.add.products.category', ['category' => $categoryId])->with('success', 'Permission Detached');
    }



}