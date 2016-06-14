@extends('admin.layouts.app')

@section('pageTitle', 'Product List')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.list.categories') }}"><i class="fa fa-folder-o"></i> Category List</a></li>
    <li><a href="#"><i class="fa fa-plus"></i> Add product to category</a></li>
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
                            <th>#</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if($category->hasProduct($product->id))
                                        <a class="btn btn-danger btn-sm" title="remove product" href="{{ route('dashboard.detach.product', ['productId' => $product->id, 'categoryId' => $category->id]) }}" role="button"><i class="fa fa-minus"></i></a>
                                    @else
                                        <a class="btn btn-primary btn-sm" title="add product" href="{{ route('dashboard.attach.product', ['productId' => $product->id, 'categoryId' => $category->id]) }}" role="button"><i class="fa fa-plus"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
