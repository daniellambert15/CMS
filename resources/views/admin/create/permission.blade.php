@extends('admin.layouts.app')

@section('pageTitle', 'New Permission' )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.permissions') }}"><i class="fa fa-lock"></i> Permission List</a></li>
    <li><a href="#"><i class="fa fa-lock"></i> New Permission</a></li>
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
                    <h3 class="box-title">New Permission</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.permission') }}" method="POST">
                {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Permission Name</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="label">Permission Label</label>
                            <input type="text" class="form-control" id="label" name="label" autocomplete="off" placeholder="Enter Label">
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
