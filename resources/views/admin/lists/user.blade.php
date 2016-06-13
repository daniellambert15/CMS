@extends('admin.layouts.app')

@section('pageTitle', 'User List')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-user"></i> User List</a></li>
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
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->firstName }} {{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>@foreach($user->roles as $role)
                                {{ $role->name }}<br />
                                @endforeach</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" title="edit user role" href="{{ route('dashboard.role.user', ['id' => $user->id]) }}" role="button"><i class="fa fa-lock"></i></a>
                                    <a class="btn btn-primary btn-sm" title="edit user" href="{{ route('dashboard.edit.user', ['id' => $user->id]) }}" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                    <a class="btn btn-danger btn-sm" title="delete user" href="{{ route('dashboard.user.delete', ['id' => $user->id]) }}" onclick="return confirm('Are you sure you want to delete this user?');" role="button"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
