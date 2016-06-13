@extends('admin.layouts.app')

@section('pageTitle', 'Editing: '. $category->name )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.list.categories') }}"><i class="fa fa-folder-o"></i> Category List</a></li>
    <li><a href="#"><i class="fa fa-folder-o"></i> Editing: {{ $category->name }}</a></li>
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
                    <h3 class="box-title">Editing: {{ $category->name }}</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.update.category') }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <input type="hidden" name="oldName" value="{{ $category->name }}">
                    <div class="box-body">
                        <div class="form-group col-xs-6">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $category->name }}" name="name">
                        </div>

                        <div class="form-group col-xs-6">
                            <label for="parent_id">Parent</label>
                            <select class="form-control" name="parent_id">
                                <option value="{{ $category->parent_id }}" selected>- No Change -</option>
                                <option value="0">- No Parent -</option>
                                @foreach($categories as $listCategory)
                                    <option value="{{ $listCategory->id }}">{{ $listCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-xs-4">
                            <label for="live">Live</label>
                            <select class="form-control" name="live">
                                <option value="{{ $category->live }}" selected>- No Change -</option>
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </div>

                        <div class="form-group col-xs-4">
                            <label for="hidden">Hidden</label>
                            <select class="form-control" name="hidden">
                                <option value="{{ $category->hidden }}" selected>- No Change -</option>
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </div>

                        <div class="form-group col-xs-4">
                            <label for="sitemap">Sitemap</label>
                            <select class="form-control" name="sitemap">
                                <option value="{{ $category->sitemap }}" selected>- No Change -</option>
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="description">Category Description</label>
                          <textarea id="editor1" name="description">{{ $category->description }}
                          </textarea>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary col-xs-12">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
