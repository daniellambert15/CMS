@extends('admin.layouts.app')

@section('pageTitle', 'Permissions List - <a href="'.route('dashboard.add.permission').'">New Permission</a>')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-lock"></i> Permission List</a></li>
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
                            <th>Label</th>
                            <th></th>
                        </tr>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->label }}</td>
                                <td>
                                @can('editPermission')
                                    <a class="btn btn-primary btn-sm" href="{{ route('dashboard.edit.permission', ['id' => $permission->id]) }}" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                @endcan
                                @can('deletePermission')
                                    <a class="btn btn-danger btn-sm" href="{{ route('dashboard.delete.permission', ['id' => $permission->id]) }}" onclick="return confirm('Are you sure you want to delete this permission?');" role="button"><i class="fa fa-trash-o"></i></a>
                                @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
