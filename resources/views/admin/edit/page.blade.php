@extends('admin.layouts.app')

@section('pageTitle', 'Editing: '. $page->name )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.list.pages') }}"><i class="fa fa-user"></i> Page List</a></li>
    <li><a href="#"><i class="fa fa-user"></i> Editing: {{ $page->name }}</a></li>
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
                    <h3 class="box-title">Editing: {{ $page->name }}</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.update.page') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $page->id }}">
                <input type="hidden" name="oldurl" value="{{ $page->url }}">
                    <div class="box-body">
                        <div class="form-group col-xs-6">
                            <label for="name">Page Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $page->name }}">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="url">URL</label>
                            <input type="text" class="form-control" id="url" name="url" value="{{ $page->url }}">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="title">Link Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $page->title }}">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="title">Type <small>(coming soon)</small></label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ $page->type }}">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="metaDescription">Meta Description</label>
                            <input type="text" class="form-control" id="metaDescription" name="metaDescription" value="{{ $page->metaDescription }}">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="contactForm">Contact Form</label>
                            <input type="text" class="form-control" id="contactForm" name="contactForm" value="{{ $page->contactForm }}">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="blueBarTitle">Blue Bar Title</label>
                            <input type="text" class="form-control" id="blueBarTitle" name="blueBarTitle" value="{{ $page->blueBarTitle }}">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="page_id">Parent</label>
                            <select class="form-control" name="page_id">
                              <option value="{{ $page->page_id }}">- No Change -</option>
                              <option value="0">- No Parent -</option>
                              @foreach($pages as $child)
                                <option value="{{ $child->id }}">{{ $child->name }}</option>
                              @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="content">Page Content</label>
                            <textarea id="editor1" name="content">
                                            {{ $page->content }}
                            </textarea>
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="live">Live</label>
                            <select class="form-control" name="live">
                              <option value="{{ $page->live }}">- No Change -</option>
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="hidden">Hidden</label>
                            <select class="form-control" name="hidden">
                              <option value="{{ $page->hidden }}">- No Change -</option>
                                <option value="N">NO</option>
                                <option value="Y">YES</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="sitemap">Sitemap</label>
                            <select class="form-control" name="sitemap">
                              <option value="{{ $page->sitemap }}">- No Change -</option>
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
