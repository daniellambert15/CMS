@extends('admin.layouts.app')

@section('pageTitle', 'Category List')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-folder-o"></i> Category List</a></li>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <b>SUCCESS:</b> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            <b>ERROR:</b> {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Parent ID</th>
                            <th>Products</th>
                            <th>Live</th>
                            <th>Hidden</th>
                            <th>Sitemap</th>
                            <th>Action</th>
                        </tr>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->parentName() }}</td>
                                <td>
                                    <ul>
                                        @foreach($category->products as $product)
                                        <li>
                                            {{ $product->name }}
                                        </li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td>{{ $category->live }}</td>
                                <td>{{ $category->hidden }}</td>
                                <td>{{ $category->sitemap }}</td>
                                <td>@can('editCategories')
                                        <a class="btn btn-primary btn-sm" title="edit Category" href="{{ route('dashboard.edit.category', ['id' => $category->id]) }}" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                    @endcan
                                    @can('deleteCategory')
                                        <a class="btn btn-danger btn-sm" title="delete Category" href="{{ route('dashboard.remove.category', ['id' => $category->id]) }}" onclick="return confirm('Are you sure you want to delete the {{ $category->name }} category?');" role="button"><i class="fa fa-trash-o"></i></a>
                                @endcan<td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(count($deletedCategories) > 0)
        <h3>Deleted Categories</h3>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Products</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                            @foreach($deletedCategories as $deletedCategory)
                                <tr>
                                    <td>{{ $deletedCategory->id }}</td>
                                    <td>{{ $deletedCategory->name }}</td>
                                    <td>{{ $deletedCategory->price }}</td>
                                    <td>{{ $deletedCategory->created_at }}</td>
                                    <td>{{ $deletedCategory->updated_at }}</td>
                                    <td>
                                        @can('restoreCategory')
                                            <a class="btn btn-warning btn-sm" title="Restore Category" href="{{ route('dashboard.restore.category', ['id' => $deletedCategory->id]) }}" onclick="return confirm('Are you sure you want to restore the {{ $deletedCategory->name }} product? This might conflict with another category, if it doesn\'t enable, its probily the product name duplication');" role="button"><i class="fa fa-undo"></i></a>
                                        @endcan
                                        @can('deleteCategory')
                                            <a class="btn btn-danger btn-sm" title="delete Category" href="{{ route('dashboard.destroy.category', ['id' => $deletedCategory->id]) }}" onclick="return confirm('Are you sure you want to fully destory the {{ $deletedCategory->name }} category? !!! THERE WILL BE NO GOING BACK !!!');" role="button"><i class="fa fa-trash-o"></i></a>
                                    @endcan
                                    <td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
