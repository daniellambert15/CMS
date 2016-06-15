@extends('admin.layouts.app')

@section('pageTitle', 'Customers List')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-user"></i> Customer List</a></li>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th></th>
                        </tr>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->firstName }} {{ $customer->surname }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->created_at }}</td>
                                <td>{{ $customer->updated_at }}</td>
                                <td>
                                    @can('editCustomer')
                                        <a class="btn btn-primary btn-sm" title="edit Customer" href="{{ route('dashboard.edit.customer', ['id' => $customer->id]) }}" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                    @endcan
                                    @can('deleteCustomere')
                                    <a class="btn btn-danger btn-sm" title="delete customer" href="{{ route('dashboard.delete.customer', ['id' => $customer->id]) }}" onclick="return confirm('Are you sure you want to delete {{ $customer->firstName }} {{ $customer->surname }}?');" role="button"><i class="fa fa-trash-o"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <section class="content-header">
        <h1>
            Deleted Customers
        </h1>
    </section>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Live</th>
                            <th>Hidden</th>
                            <th></th>
                        </tr>
                        @foreach($deletedCustomers as $deletedCustomer)
                            <tr>
                                <td>{{ $deletedCustomer->id }}</td>
                                <td>{{ $deletedCustomer->firstName }} {{ $deletedCustomer->surname }}</td>
                                <td>{{ $deletedCustomer->email }}</td>
                                <td>{{ $deletedCustomer->created_at }}</td>
                                <td>{{ $deletedCustomer->updated_at }}</td>
                                <td>
                                    @can('restoreCustomer')
                                        <a class="btn btn-warning btn-sm" title="delete customer" href="{{ route('dashboard.restore.customer', ['id' => $deletedCustomer->id]) }}" onclick="return confirm('Are you sure you want to undelete {{ $deletedCustomer->firstName }} {{ $deletedCustomer->surname }}?');" role="button"><i class="fa fa-plus"></i></a>
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
