@extends('admin.layouts.app')

@section('pageTitle', 'New Images' )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.list.images') }}"><i class="fa fa-file-image-o"></i> Image List</a></li>
    <li><a href="#"><i class="fa fa-plus"></i> New Images</a></li>
@endsection

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" role="alert">
        <b>ERROR:</b> {{ session('error') }}
    </div>
@endif

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">New Images</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.image') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-xs-12">
                            <label for="url">Images</label>
                            <input name="url[]" type="file" multiple="multiple" />
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
