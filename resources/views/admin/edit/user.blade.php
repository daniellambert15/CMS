@extends('admin.layouts.app')

@section('pageTitle', 'Editing: '. $user->fullName )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.user.list') }}"><i class="fa fa-user"></i> User List</a></li>
    <li><a href="#"><i class="fa fa-user"></i> Editing: {{ $user->fullName }}</a></li>
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
                    <h3 class="box-title">Editing: {{ $user->fullName }}</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.update.user') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" autocomplete="off" value="{{ $user->firstName }}" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname" autocomplete="off" value="{{ $user->surname }}" placeholder="Enter Surname">
                        </div>
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" autocomplete="off" value="{{ $user->fullName }}" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" autocomplete="off" value="{{ $user->email }}" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" autocomplete=off placeholder="Password">
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
