@extends('admin.layouts.app')

@section('pageTitle', 'Page Visitors')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.page.analytics') }}"><i class="fa fa-sitemap"></i> Page Analytics</a></li>
    <li><a href="#"><i class="fa fa-sitemap"></i> Page Visitors</a></li>
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
                            <th>Tracking Id</th>
                            <th>Enquired</th>
                        </tr>
                        @foreach($leads as $lead)
                            <tr>
                                <td>{{ $lead->id }}</td>
                                <td>
                                    {{ $lead->firstName }} {{ $lead->surname }}
                                </td>
                                <td><a href="{{ route('dashboard.tracked.user', ['id' => $lead->trackingId]) }}">{{ $lead->trackingId }}</a></td>
                                <td>{{ $lead->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Tracking ID</th>
                            <th>Referer</th>
                            <th>First Seen</th>
                        </tr>
                        @foreach($trackings as $tracking)
                            <tr>
                                <td>{{ $tracking->id }}</td>
                                <td>
                                <a href="{{ route('dashboard.tracked.user', ['id' => $tracking->trackingId]) }}">{{ $tracking->trackingId }}</a>
                                </td>
                                <td>{{ $tracking->referer }}</td>
                                <td>{{ $tracking->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
