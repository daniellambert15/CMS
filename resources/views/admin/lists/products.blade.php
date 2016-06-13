@extends('admin.layouts.app')

@section('pageTitle', 'Product List')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-product-hunt"></i> Product List</a></li>
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
                            <th>Category</th>
                            <th>Price (pence)</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Live</th>
                            <th>Hidden</th>
                            <th>Action</th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <ul>
                                        @foreach($product->categories as $category)
                                            <li>{{ $category->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>{{ $product->updated_at }}</td>
                                <td>{{ $product->live }}</td>
                                <td>{{ $product->hidden }}</td>
                                <td>@can('editProduct')
                                <a class="btn btn-primary btn-sm" title="edit Product" href="{{ route('dashboard.edit.product', ['id' => $product->id]) }}" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                @endcan
                                @can('deleteProduct')
                                <a class="btn btn-danger btn-sm" title="delete Product" href="{{ route('dashboard.remove.product', ['id' => $product->id]) }}" onclick="return confirm('Are you sure you want to delete the {{ $product->name }} product?');" role="button"><i class="fa fa-trash-o"></i></a>
                                @endcan<td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(count($deletedProducts) > 0)
    <h3>Deleted Products</h3>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price (pence)</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                        @foreach($deletedProducts as $deletedProduct)
                            <tr>
                                <td>{{ $deletedProduct->id }}</td>
                                <td>{{ $deletedProduct->name }}</td>
                                <td>
                                    <ul>
                                        @foreach($deletedProduct->categories as $deletedCategory)
                                            <li>{{ $deletedCategory->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $deletedProduct->price }}</td>
                                <td>{{ $deletedProduct->created_at }}</td>
                                <td>{{ $deletedProduct->updated_at }}</td>
                                <td>
                                    @can('restoreProduct')
                                        <a class="btn btn-warning btn-sm" title="Restore Product" href="{{ route('dashboard.restore.product', ['id' => $deletedProduct->id]) }}" onclick="return confirm('Are you sure you want to restore the {{ $deletedProduct->name }} product? This might conflict with another product, if it doesn\'t enable, its probily the product name duplication');" role="button"><i class="fa fa-undo"></i></a>
                                    @endcan
                                    @can('deleteProduct')
                                        <a class="btn btn-danger btn-sm" title="delete Product" href="{{ route('dashboard.destroy.product', ['id' => $deletedProduct->id]) }}" onclick="return confirm('Are you sure you want to fully destory the {{ $deletedProduct->name }} product? !!! THERE WILL BE NO GOING BCACK !!!');" role="button"><i class="fa fa-trash-o"></i></a>
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
