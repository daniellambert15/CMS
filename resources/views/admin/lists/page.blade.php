@extends('admin.layouts.app')

@section('pageTitle', 'Page List')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-user"></i> Page List</a></li>
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
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Live</th>
                            <th>Hidden</th>
                            <th></th>
                        </tr>
                        @foreach($Pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->name }}</td>
                                <td>@if($page->parentName()){{ $page->parentName() }}@else Heading @endif</td>
                                <td>{{ $page->created_at }}</td>
                                <td>{{ $page->updated_at }}</td>
                                <td>{{ $page->live }}</td>
                                <td>{{ $page->hidden }}</td>
                                <td>
                                    @can('editPage')
                                        <a class="btn btn-warning btn-sm" href="{{ route('dashboard.images.page', ['id' => $page->id]) }}" title="Page Images" role="button"><i class="fa fa-file-image-o"></i></a>
                                    <a class="btn btn-primary btn-sm" title="edit Page" href="{{ route('dashboard.edit.page', ['id' => $page->id]) }}" role="button"><i class="fa fa-pencil-square-o"></i></a>
                                    @endcan
                                    @can('deletePage')
                                    <a class="btn btn-danger btn-sm" title="delete Page" href="{{ route('dashboard.delete.page', ['id' => $page->id]) }}" onclick="return confirm('Are you sure you want to delete the {{ $page->name }} page?');" role="button"><i class="fa fa-trash-o"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <section class="content-header">
        <h1>
            Deleted pages
        </h1>
    </section>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Live</th>
                            <th>Hidden</th>
                            <th></th>
                        </tr>
                        @foreach($deletedPages as $deletedPage)
                            <tr>
                                <td>{{ $deletedPage->id }}</td>
                                <td>{{ $deletedPage->name }}</td>
                                <td>{{ $deletedPage->parentName() }}</td>
                                <td>{{ $deletedPage->created_at }}</td>
                                <td>{{ $deletedPage->updated_at }}</td>
                                <td>{{ $deletedPage->live }}</td>
                                <td>{{ $deletedPage->hidden }}</td>
                                <td>
                                    @can('restorePage')
                                        <a class="btn btn-warning btn-sm" title="delete Page" href="{{ route('dashboard.undelete.page', ['id' => $deletedPage->id]) }}" onclick="return confirm('Are you sure you want to undelete the {{ $deletedPage->name }} page?');" role="button"><i class="fa fa-plus"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
