@extends('site.layouts.app')

@section('pageTitle',$page->title)

@section('content')
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<div class="row"> 
			{!! $page->content !!}
		</div>
	</div>
@endsection


@section('contactForm')
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<div class="row">
			@include('site.forms.'.$page->contactForm)
		</div>
	</div>
@endsection