@extends('admin.layouts.app')

@section('pageTitle', 'Permissions for '.$role->name)

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.roles') }}"><i class="fa fa-user"></i> Role list</a></li>
    <li><a href="#"><i class="fa fa-lock"></i> Permission for {{ $role->name }}</a></li>
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
                                    @if($role->hasPermission($permission->id))
                                        <a class="btn btn-danger btn-sm" title="remove permission" href="{{ route('dashboard.detach.permission', ['permissionId' => $permission->id, 'roleId' => $role->id]) }}" role="button"><i class="fa fa-minus"></i></a>
                                    @else
                                        <a class="btn btn-primary btn-sm" title="add permission" href="{{ route('dashboard.attach.permission', ['permissionId' => $permission->id, 'roleId' => $role->id]) }}" role="button"><i class="fa fa-plus"></i></a>
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
