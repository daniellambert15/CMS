@extends('site.layouts.app')

@section('pageTitle','Your Shopping Cart')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Shopping Cart</h3>
                </div>
                <div class="panel-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <td>Line Total</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->products as $product)
                                <tr>
                                    <td>{!! $product->product->name !!}</td>
                                    <td>&pound;{!! $product->price / 100 !!}</td>
                                    <td>{!! $product->quantity !!}</td>
                                    <td>&pound;{!! $product->price * $product->quantity / 100 !!}</td>
                                    <td>
                                        <a href="/Shop/increment/{!! $product->product_id !!}" class="btn btn-success" title="remove 1 item from quantity">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </a>
                                        <a href="/Shop/decrement/{!! $product->product_id !!}" class="btn btn-warning" title="remove 1 item from quantity">
                                            <i class="glyphicon glyphicon-minus"></i>
                                        </a>
                                        <a href="/Shop/trash/{!! $product->product_id !!}" class="btn btn-danger" title="delete item">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-xs-3 pull-right">
                        Product: &pound;{{ ($cart->products->sum(function($item) { return $item->price * $item->quantity; }) / 100) }}<br />
                        Delivery: &pound;{{ ($cart->products->sum(function($item) { return $item->delivery * $item->quantity; }) / 100) }}<br />
                        Vat: &pound;{{
                            ($cart->products->sum(function($item) { return $item->price * $item->quantity; }) / 100 * 0.2) }}<br />
                        Total: &pound;{{
                            ($cart->products->sum(function($item) { return $item->price * $item->quantity; }) / 100  * 1.2) +
                            ($cart->products->sum(function($item) { return $item->delivery * $item->quantity; }) / 100) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!Auth::guard('customer')->check())
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            To populate your delivery details and to save your basket, invoices and property details. Please take the time to <a href="/portal/login">login</a> or <a href="/portal/register">register now.</a>
                        </p>

                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Delivery Address</h3>
                    </div>
                    <div class="panel-body">
                        @foreach(Auth::guard('customer')->user()->deliveryAddresses as $address)
                            <div class="radio">
                                <label>
                                    <input type="radio" onclick='fillAddress("{{ $address->addressLine1 }}","{{ $address->addressLine2 }}","{{ $address->town }}","{{ $address->county }}","{{ $address->postcode }}")' name="address{{ $address->id }}" value="{{ $address->id }}">
                                    {{ $address->addressLine1 }},  {{ $address->addressLine2 }},  {{ $address->town }},  {{ $address->county }},  {{ $address->postcode }}
                                </label>
                            </div>
                        @endforeach
                        @if(Auth::guard('customer')->check())
                            <p>
                                By typing a new address in below will automatically add this to your known addresses for easier use next time.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Delivery Address</h3>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label for="addressLine1">Address Line 1</label>
                            <input type="text" class="form-control" name="addressLine1" id="addressLine1" placeholder="Address Line 1">
                        </div>
                        <div class="form-group">
                            <label for="addressLine2">Address Line 2</label>
                            <input type="text" class="form-control" name="addressLine2" id="addressLine2" placeholder="Address Line 2">
                        </div>
                        <div class="form-group">
                            <label for="town">Town</label>
                            <input type="text" class="form-control" name="town" id="town" placeholder="Town">
                        </div>
                        <div class="form-group">
                            <label for="county">County</label>
                            <input type="text" class="form-control" name="county" id="county" placeholder="County">
                        </div>
                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Payment Details</h3>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label for="cardNbr">Card Number</label>
                        <input type="text" class="form-control" name="cardNbr" id="cardNbr" placeholder="Card Number">
                    </div>
                    <div class="form-group">
                        <label for="cardNbr">Card Expiry Month</label>
                        <select  class="form-control">
                            @for($i = 1; $i < 13; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cardNbr">Card Expiry Year</label>
                        <select  class="form-control">
                            @for($i = date("Y"); $i < date("Y")+10; $i++)
                                <option>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cardNbr">Security Code</label>
                        <input type="text" class="form-control" name="cardNbr" id="cardNbr" placeholder="CVV Number">
                    </div>

                    <div class="form-group">
                        <label for="cardNbr">Name On Card</label>
                        <input type="text" class="form-control" name="cardNbr" id="cardNbr" placeholder="Name On Card">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Your Details</h3>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label for="cardNbr">First Name</label>
                        <input type="text" class="form-control" name="cardNbr" id="cardNbr" value="@if(Auth::guard('customer')->check()){{ Auth::guard('customer')->user()->firstName }}@endif" placeholder="First Name">
                    </div>

                    <div class="form-group">
                        <label for="cardNbr">Surname</label>
                        <input type="text" class="form-control" name="cardNbr" id="cardNbr" value="@if(Auth::guard('customer')->check()){{ Auth::guard('customer')->user()->surname }}@endif" placeholder="Surname">
                    </div>

                    <div class="form-group">
                        <label for="cardNbr">Email Address <small>(for emailed invoice)</small></label>
                        <input type="text" class="form-control" name="cardNbr" value="@if(Auth::guard('customer')->check()){{ Auth::guard('customer')->user()->email }}@endif" id="cardNbr" placeholder="Your Email Address">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <a href="#" class="btn btn-success col-xs-12">Pay Now!</a>
        </div>
    </div>
@endsection

<script>
    function fillAddress(addressLine1, addressLine2, town, county, postcode)
    {
        document.getElementById("addressLine1").value = addressLine1;
        document.getElementById("addressLine2").value = addressLine2;
        document.getElementById("town").value = town;
        document.getElementById("county").value = county;
        document.getElementById("postcode").value = postcode;
    }
</script>
@section('contactForm')
@endsection