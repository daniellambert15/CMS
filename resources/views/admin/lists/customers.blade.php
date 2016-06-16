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
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Address(es)</th>
                            <th></th>
                        </tr>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->firstName }} {{ $customer->surname }}</td>
                                <td>{{ $customer->telephone }}</td>
                                <td><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td>
                                <td>
                                    @if($customer->deliveryAddresses)
                                        <ul>
                                            @foreach($customer->deliveryAddresses as $deliveryAddress)
                                                <li>
                                                   @if($deliveryAddress->postcode)<a target="_blank" href="https://www.google.co.uk/maps/search/{{ str_replace(" ", "", $deliveryAddress->postcode) }}">{{ $deliveryAddress->postcode }}</a>@endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td>
                                    @can('customerInvoices')
                                        <a class="btn btn-success btn-sm" title="View Invoices" href="{{ route('dashboard.customer.invoices', ['id' => $customer->id]) }}" role="button"><i class="fa fa-file-pdf-o"></i></a>
                                    @endcan
                                    @can('editCustomer')
                                        <a class="btn btn-primary btn-sm" title="edit Customer" href="{{ route('dashboard.edit.customer', ['id' => $customer->id]) }}" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                    @endcan
                                    @can('deleteCustomer')
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
        <h3>
            Deleted Customers
        </h3>
    </section>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Address(es)</th>
                            <th></th>
                        </tr>
                        @foreach($deletedCustomers as $deletedCustomer)
                            <tr>
                                <td>{{ $deletedCustomer->id }}</td>
                                <td>{{ $deletedCustomer->firstName }} {{ $deletedCustomer->surname }}</td>
                                <td>{{ $deletedCustomer->telephone }}</td>
                                <td><a href="mailto:{{ $deletedCustomer->email }}">{{ $deletedCustomer->email }}</a></td>
                                <td>
                                    @if($deletedCustomer->deliveryAddresses)
                                        <ul>
                                            @foreach($deletedCustomer->deliveryAddresses as $deletedCustomerDeliveryAddresses)
                                                <li>
                                                    @if($deletedCustomerDeliveryAddresses->postcode)<a target="_blank" href="https://www.google.co.uk/maps/search/{{ str_replace(" ", "", $deletedCustomerDeliveryAddresses->postcode) }}">{{ $deletedCustomerDeliveryAddresses->postcode }}</a>@endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td>
                                    @can('restoreCustomer')
                                        <a class="btn btn-warning btn-sm" title="restore customer" href="{{ route('dashboard.restore.customer', ['id' => $deletedCustomer->id]) }}" onclick="return confirm('Are you sure you want to restore {{ $deletedCustomer->firstName }} {{ $deletedCustomer->surname }}? - !!!!!you will have to go back and change their email address once restored!!!!!');" role="button"><i class="fa fa-plus"></i></a>
                                    @endcan
                                    @can('destroyCustomer')
                                        <a class="btn btn-danger btn-sm" title="destroy customer" href="{{ route('dashboard.delete.customer', ['id' => $deletedCustomer->id]) }}" onclick="return confirm('Are you sure you want to destroy {{ $deletedCustomer->firstName }} {{ $deletedCustomer->surname }}?');" role="button"><i class="fa fa-trash-o"></i></a>
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
