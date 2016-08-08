@extends('site.layouts.app')

@section('pageTitle',$product->name)

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            Name: {!! $product->name !!}<br />
            Description: {!! $product->description !!}<br />
            Price: {!! $product->price !!}<br />
            <form method="post" action="/Shop/addToBasket">
                {{ csrf_field() }}
                <input value="{!! $product->id !!}" name="id" type="hidden" />
                <input value="1" name="quantity" type="text" />
                <button class="btn btn-default" type="submit">Buy Me!</button>
            </form>
        </div>
    </div>
@endsection


@section('contactForm')
@endsection