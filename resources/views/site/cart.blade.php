@extends('site.layouts.app')

@section('pageTitle','Your Shopping Cart')

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
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
@endsection


@section('contactForm')
@endsection