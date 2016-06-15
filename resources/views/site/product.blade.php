@extends('site.layouts.app')

@section('pageTitle',$product->name)

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            {!! $product->name !!}<br />
            {!! $product->description !!}<br />
            {!! $product->price !!}
        </div>
    </div>
@endsection


@section('contactForm')
@endsection