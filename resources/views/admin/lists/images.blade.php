@extends('admin.layouts.app')

@section('pageTitle', 'Image List')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-file-image-o"></i> Image List</a></li>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <b>SUCCESS:</b> {{ session('success') }}!
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
            @foreach($images as $image)
                <div class="well col-xs-2"><a onclick="return confirm('Are you sure you want to delete the image?');" href="{{ route('dashboard.delete.image', ['id' => $image->id]) }}"><img src="/uploads/150/{{ $image->url }}" class="img-responsive"></a></div>
            @endforeach
            </div>
        </div>
    </div>
    <section class="content-header">
        <h1>
            Deleted Images
        </h1>
    </section>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            @foreach($trashedImages as $trashedImage)
            <div class="well col-xs-2"><a href="{{ route('dashboard.reanimate.image', ['id' => $trashedImage->id]) }}"><img src="/uploads/150/{{ $trashedImage->url }}" class="img-responsive"></a></div>
            @endforeach
            </div>
        </div>
    </div>
@endsection
