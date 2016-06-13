@extends('admin.layouts.app')

@section('pageTitle', 'Image List')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-file-image-o"></i> Image List</a></li>
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
                @foreach($page->images as $pageImage)
                    <div class="well col-xs-3"><a href="{{ route('dashboard.detach.image.page', ['pageId' => $page->id, 'imageId' => $pageImage->id]) }}"><img src="/uploads/75/{{ $pageImage->url }}" class="img-responsive"></a></div>
                @endforeach
            </div>
        </div>
    </div>
    <section class="content-header">
        <h1>
            Select an image
        </h1>
    </section>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            @foreach($images as $image)
                <div class="well col-xs-3"><a href="{{ route('dashboard.attach.image.page', ['pageId' => $page->id, 'imageId' => $image->id]) }}"><img src="/uploads/75/{{ $image->url }}" class="img-responsive"></a></div>
            @endforeach
            </div>
        </div>
    </div>
@endsection
