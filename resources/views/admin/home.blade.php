@extends('admin.layouts.app')

@section('pageTitle', 'Dashboard')

@section('breadcrumb')
    <li><a href="{{ url('/dashboard/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
@endsection

@section('content')


@if (session('error'))
    <div class="alert alert-danger" role="alert">
        <b>ERROR:</b> {{ session('error') }}
    </div>
@endif

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
@endsection
