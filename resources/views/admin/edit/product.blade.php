@extends('admin.layouts.app')

@section('pageTitle', 'Editing: '. $product->name )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.list.products') }}"><i class="fa fa-product-hunt"></i> Product List</a></li>
    <li><a href="#"><i class="fa fa-product-hunt"></i> Editing: {{ $product->name }}</a></li>
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
                    <h3 class="box-title">Editing: {{ $product->name }}</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.update.product') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="oldName" value="{{ $product->name }}">
                    <div class="box-body">
                      <div class="form-group col-xs-6">
                          <label for="name">Product Name</label>
                          <input type="text" class="form-control" id="name" value="{{ $product->name }}" name="name">
                      </div>
                      <div class="form-group col-xs-6">
                          <label for="price">Price (pence)</label>
                          <input type="text" class="form-control" id="price" value="{{ $product->price }}" name="price">
                      </div>
                      <div class="form-group col-xs-6">
                          <label for="delivery">Delivery (pence)</label>
                          <input type="text" class="form-control" id="delivery" value="{{ $product->delivery }}" name="delivery">
                      </div>

                        <div class="form-group col-xs-2">
                            <label for="live">Live</label>
                            <select class="form-control" name="live">
                                <option value="{{ $product->live }}">- No Change -</option>
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-2">
                            <label for="hidden">Hidden</label>
                            <select class="form-control" name="hidden">
                                <option value="{{ $product->hidden }}">- No Change -</option>
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-2">
                            <label for="sitemap">Sitemap</label>
                            <select class="form-control" name="sitemap">
                                <option value="{{ $product->sitemap }}">- No Change -</option>
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                      <div class="form-group col-xs-12">
                          <label for="description">Product Description</label>
                          <textarea id="editor1" name="description">{{ $product->description }}
                          </textarea>
                      </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary col-xs-12">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
