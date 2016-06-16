@extends('admin.layouts.app')

@section('pageTitle', 'Editing: '. $customer->firstName.' '.$customer->surname)

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.list.customers') }}"><i class="fa fa-user"></i> Customer List</a></li>
    <li><a href="#"><i class="fa fa-user"></i> Editing: {{ $customer->firstName }} {{ $customer->surname }}</a></li>
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
                    <h3 class="box-title">Editing: {{ $customer->firstName }} {{ $customer->surname }}</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.update.customer') }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $customer->id }}">
                    <input type="hidden" name="oldEmail" value="{{ $customer->email }}">
                    <div class="box-body">
                        <div class="form-group col-xs-6">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" value="{{ $customer->firstName }}" name="firstName">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" id="surname" value="{{ $customer->surname }}" name="surname">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $customer->email }}" name="email">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="telephone">Telephone</label>
                            <input type="text" class="form-control" id="telephone" value="{{ $customer->telephone }}" name="telephone">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="password">Password <small>(to change password, leave blank to keep existing)</small></label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary col-xs-12">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
