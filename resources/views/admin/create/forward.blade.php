@extends('admin.layouts.app')

@section('pageTitle', 'New Forward' )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.list.forwards') }}"><i class="fa fa-hand-o-right"></i> Forward List</a></li>
    <li><a href="#"><i class="fa fa-plus"></i> New Forward</a></li>
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

@if (session('error'))
    <div class="alert alert-danger" role="alert">
        <b>ERROR:</b> {{ session('error') }}
    </div>
@endif

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">New Forward</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.forward') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-xs-12">
                            <label for="url">URL</label><br />
                            <select class="form-control" name="url">
                                @foreach($pages as $page)
                                    <option value="{{ $page->url }}">{{ $page->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="description">Description</label><br />
                            <input name="description" class="form-control" type="input"/>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
