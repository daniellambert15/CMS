@extends('admin.layouts.app')

@section('pageTitle', 'New Product' )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.list.products') }}"><i class="fa fa-file-text"></i> Product List</a></li>
    <li><a href="#"><i class="fa fa-plus"></i> New Product</a></li>
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">New Product</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.product') }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-xs-6">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="price">Price (pence)</label>
                            <input type="text" class="form-control" id="price" value="{{ old('price') }}" name="price">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="delivery">Delivery (pence)</label>
                            <input type="text" class="form-control" id="delivery" value="{{ old('delivery') }}" name="delivery">
                        </div>

                        <div class="form-group col-xs-2">
                            <label for="live">Live</label>
                            <select class="form-control" name="live">
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-2">
                            <label for="hidden">Hidden</label>
                            <select class="form-control" name="hidden">
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-2">
                            <label for="sitemap">Sitemap</label>
                            <select class="form-control" name="sitemap">
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="description">Product Description</label>
                            <textarea id="editor1" name="description">{{ old('description') }}
                            </textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary col-xs-12">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
