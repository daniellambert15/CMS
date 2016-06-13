@extends('admin.layouts.app')

@section('pageTitle', 'Create New Category' )

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.list.categories') }}"><i class="fa fa-folder-o"></i> Category List</a></li>
    <li><a href="#"><i class="fa fa-plus-o"></i> New Category</a></li>
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
                    <h3 class="box-title">Create New Category</h3>
                </div>
                <form role="form" action="{{ route('dashboard.save.category') }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group col-xs-6">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name">
                        </div>

                        <div class="form-group col-xs-6">
                            <label for="parent_id">Parent</label>
                            <select class="form-control" name="parent_id">
                                @if(old('parent_id'))
                                    <option value="{{old('parent_id')}}">-- {{old('parent_id')}} -- </option>
                                @endif
                                <option value="0">-- No Parent --</option>
                                @foreach($categories as $listCategory)
                                    <option value="{{ $listCategory->id }}">{{ $listCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-xs-4">
                            <label for="live">Live</label>
                            <select class="form-control" name="live">
                                @if(old('live'))
                                    <option value="{{old('live')}}">-- {{old('live')}} -- </option>
                                @endif
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </div>

                        <div class="form-group col-xs-4">
                            <label for="hidden">Hidden</label>
                            <select class="form-control" name="hidden">
                                @if(old('hidden'))
                                    <option value="{{old('hidden')}}">-- {{old('hidden')}} --</option>
                                @endif
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </div>

                        <div class="form-group col-xs-4">
                            <label for="sitemap">Sitemap</label>
                            <select class="form-control" name="sitemap">
                                @if(old('sitemap'))
                                    <option value="{{old('sitemap')}}">-- {{old('sitemap')}} --</option>
                                @endif
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="description">Category Description</label>
                          <textarea id="editor1" name="description">{{ old('description') }}
                          </textarea>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary col-xs-12">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
