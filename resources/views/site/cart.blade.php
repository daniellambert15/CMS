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
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->products as $product)
                        <tr>
                            <td>{!! $product->product->name !!}</td>
                            <td>&pound;{!! $product->price / 100 !!}</td>
                            <td>{!! $product->quantity !!}</td>
                            <td>&pound;{!! $product->price * $product->quantity / 100 !!}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            Product: &pound;{{ ($cart->products->sum(function($item) { return $item->price * $item->quantity; }) / 100) }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            Delivery: &pound;{{ ($cart->products->sum(function($item) { return $item->delivery * $item->quantity; }) / 100) }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Vat: &pound;{{
                    ($cart->products->sum(function($item) { return $item->price * $item->quantity; }) / 100 * 0.2) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total: &pound;{{
                    ($cart->products->sum(function($item) { return $item->price * $item->quantity; }) / 100  * 1.2) +
                    ($cart->products->sum(function($item) { return $item->delivery * $item->quantity; }) / 100) }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection


@section('contactForm')
@endsection