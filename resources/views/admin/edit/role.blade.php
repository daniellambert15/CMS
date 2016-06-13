@extends('admin.layouts.app')

@section('pageTitle', 'Editing: '. $role->name )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.roles') }}"><i class="fa fa-lock"></i> Role List</a></li>
    <li><a href="#"><i class="fa fa-lock"></i> Editing: {{ $role->name }}</a></li>
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
                    <h3 class="box-title">Editing: {{ $role->name }}</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.edit.role') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $role->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{ $role->name }}" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="label">Role Label</label>
                            <input type="text" class="form-control" id="label" name="label" autocomplete="off" value="{{ $role->label }}" placeholder="Enter Label">
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
