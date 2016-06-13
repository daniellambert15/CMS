@extends('admin.layouts.app')

@section('pageTitle', 'Role List - <a href="'.route('dashboard.add.role').'">New Role</a>')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-lock"></i> Role List</a></li>
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
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->label }}</td>
                                <td>
                                @can('giveRolesPermissions')
                                    <a class="btn btn-success btn-sm" title="edit permission role" href="{{ route('dashboard.permission.role', ['id' => $role->id]) }}" role="button"><i class="fa fa-lock"></i></a>
                                @endcan
                                @can('editRole')
                                    <a class="btn btn-primary btn-sm" href="{{ route('dashboard.edit.role', ['id' => $role->id]) }}" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                @endcan
                                @can('deleteRole')
                                    <a class="btn btn-danger btn-sm" href="{{ route('dashboard.delete.role', ['id' => $role->id]) }}" onclick="return confirm('Are you sure you want to delete this role?');" role="button"><i class="fa fa-trash-o"></i></a>
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
