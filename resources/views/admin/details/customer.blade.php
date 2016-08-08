@extends('admin.layouts.app')

@section('pageTitle', 'Customer Details: '.$customer->firstName .' '. $customer->surname)

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-user"></i> Customer: {!! $customer->firstName !!} {!! $customer->surname !!}</a></li>
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

    <p>Here are the details of {!! $customer->firstName !!} {!! $customer->surname !!} who has visited the site and posibly become a member.</p>
    <h2>Details</h2>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>

                        <tr>
                            <td>{!! $customer->firstName!!}</td>
                            <td>{!! $customer->surname !!}</td>
                            <td>{!! $customer->telephone !!}</td>
                            <td>{!! $customer->email !!}</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <h2>Leads</h2>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Enquired</th>
                            <th>Contact Numbers</th>
                            <th>Address</th>
                            <th>Service Required</th>
                            <th>Area</th>
                            <th>Page</th>
                            <th>Affiliate</th>
                            <th>Campaign</th>
                            <th>Forward</th>
                            <th>Action</th>
                        </tr>
                        @foreach($customer->leads as $lead)
                            <tr>
                                <td>#{!! $lead->id !!}</td>
                                <td>{!! $lead->created_at !!}</td>
                                <td>@if($lead->mobile != "")Mobile "{!! $lead->mobile !!}" <br /> @endif
                                    @if($lead->landline != "")Landline "{!! $lead->landline !!}"@endif </td>
                                <td>{!! $lead->addressLine1 !!}<br /> {!! $lead->postcode !!}</td>
                                <td>{!! $lead->serviceRequired !!}</td>
                                <td>{!! $lead->area !!}</td>
                                <td>{!! $lead->pageId !!}</td>
                                <td>{!! $lead->affiliateId !!}</td>
                                <td>{!! $lead->campaignId !!}</td>
                                <td>{!! $lead->forwardedId !!}</td>
                                <td>{!! $lead->id !!}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    @if(count($customer->orders) > 0)
        <h2>Orders</h2>
        @foreach($customer->orders as $order)
            <ul>
                <li>Delivery Address: </li>
                <li>Invoice: </li>
                <li>Created: {!! $order->created_at !!}</li>
                <li>Product Total: </li>
                <li>Delivery Total: </li>
                <li>VAT: </li>
                <li>Total:</li>
            </ul>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Delivery</th>
                                </tr>
                                @foreach($order->products as $product)
                                    <tr>
                                        <td>{!! $product->product->name !!}</td>
                                        <td>{!! $product->price !!}</td>
                                        <td>{!! $product->delivery !!}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


    @if(count($customer->carts) > 0)
        <h2>Shopping Baskets</h2>
        @foreach($customer->carts as $cart)
            <ul>
                <li>Created: {!! $cart->created_at !!}</li>
                <li>Product Total: </li>
                <li>Delivery Total: </li>
                <li>VAT: </li>
                <li>Total:</li>
            </ul>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Delivery</th>
                                </tr>
                                @foreach($cart->products as $product)
                                    <tr>
                                        <td>{!! $product->product->name !!}</td>
                                        <td>&pound;{!! $product->price / 100 !!}</td>
                                        <td>&pound;{!! $product->delivery / 100 !!}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


    <h2>Tracking</h2>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Page ID</th>
                            <th>Forward ID</th>
                            <th>Referer</th>
                            <th>Timestamp</th>
                        </tr>
                        @foreach($customer->trackings as $tracking)
                            <tr>
                                <td>{{ $tracking->id }}</td>
                                <td>{{ $tracking->pageIdToName($tracking->pageId, $tracking->type_id) }}</td>
                                <td>{{ $tracking->forwardId }}</td>
                                <td>{{ substr($tracking->referer, 0 , 10) }}</td>
                                <td>{{ $tracking->created_at }}</td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    @if(count($tracking->trackingClicks) > 0)

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box">
                                                    <div class="box-body table-responsive no-padding">
                                                        <table class="table table-hover" style="background-color: #ccc;">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Action</th>
                                                                <th>Type</th>
                                                                <th>Name</th>
                                                                <th>When</th>
                                                            </tr>
                                                            @foreach($tracking->trackingClicks as $trackingClick)
                                                                <tr>
                                                                    <td>{{ $trackingClick->id }}</td>
                                                                    <td>{{ $trackingClick->action }}</td>
                                                                    <td>{{ $trackingClick->type }}</td>
                                                                    <td>{{ $trackingClick->name }}</td>
                                                                    <td>{{ $trackingClick->created_at }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
