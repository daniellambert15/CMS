@extends('admin.layouts.app')

@section('pageTitle', 'User Roles')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.user.list') }}"><i class="fa fa-user"></i> User list</a></li>
    <li><a href="#"><i class="fa fa-lock"></i> User Roles</a></li>
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
                                    @if($user->hasRole($role->name))
                                        <a class="btn btn-danger btn-sm" title="remove role" href="{{ route('dashboard.detach.role', ['id' => $role->id]) }}" role="button"><i class="fa fa-minus"></i></a>
                                    @else
                                        <a class="btn btn-primary btn-sm" title="add role" href="{{ route('dashboard.attach.role', ['id' => $role->id]) }}" role="button"><i class="fa fa-plus"></i></a>
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
