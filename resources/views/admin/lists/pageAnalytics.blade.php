@extends('admin.layouts.app')

@section('pageTitle', 'List of Page Analytics')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-sitemap"></i> Page Analytics</a></li>
@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        <b>SUCCESS:</b> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger"   role="alert">
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
                            <th>Hits</th>
                            <th>Leads</th>
                            <th>Conversion Rate</th>
                            <th>Visitor Information</th>
                        </tr>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->parentName() }}</td>
                                <td>{{ count($page->tracking) }}</td>
                                <td>{{ count($page->leads) }}</td>
                                <td>
                                    @if(count($page->tracking)>0)
                                    {{ number_format(count($page->leads) / count($page->tracking) * 100, 1) }} &#37;
                                    @else
                                        0&#37;
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" title="View Users" href="{{ route('dashboard.page.users', ['id' => $page->id]) }}" role="button"><i class="fa fa-user"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
