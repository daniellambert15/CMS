@extends('admin.layouts.app')

@section('pageTitle', 'New Page' )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.list.pages') }}"><i class="fa fa-file-text"></i> Page List</a></li>
    <li><a href="#"><i class="fa fa-plus"></i> New Page</a></li>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">New Page</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.page') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-xs-6">
                            <label for="name">Page Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="url">URL</label>
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="title">Link Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="title">Type <small>(coming soon)</small></label>
                            <input type="text" class="form-control" id="type" name="type">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="metaDescription">Meta Description</label>
                            <input type="text" class="form-control" id="metaDescription" name="metaDescription">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="contactForm">Contact Form</label>
                            <input type="text" class="form-control" id="contactForm" name="contactForm">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="blueBarTitle">Blue Bar Title</label>
                            <input type="text" class="form-control" id="blueBarTitle" name="blueBarTitle">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="page_id">Parent</label>
                            <select class="form-control" name="page_id">
                              <option value="0">- No Parent -</option>
                              @foreach($Pages as $child)
                                <option value="{{ $child->id }}">{{ $child->name }}</option>
                              @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="content">Page Content</label>
                            <textarea id="editor1" name="content">
                            </textarea>
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="live">Live</label>
                            <select class="form-control" name="live">
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="hidden">Hidden</label>
                            <select class="form-control" name="hidden">
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="sitemap">Sitemap</label>
                            <select class="form-control" name="sitemap">
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="affiliate_id">Affiliate</label>
                            <select class="form-control" name="affiliate_id">
                              <option value="0">- No Affiliate -</option>
                            </select>
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
