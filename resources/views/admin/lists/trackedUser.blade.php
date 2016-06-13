
@extends('admin.layouts.app')

@section('pageTitle', 'Tracked User')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('dashboard.page.analytics') }}"><i class="fa fa-sitemap"></i> Page Analytics</a></li>
    <li><a href="#"><i class="fa fa-user"></i> Tracked User</a></li>
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
                            <th>Page ID</th>
                            <th>Forward ID</th>
                            <th>Referer</th>
                            <th>Timestamp</th>
                        </tr>
                        @foreach($trackings as $tracking)
                            <tr>
                                <td>{{ $tracking->id }}</td>
                                <td>{{ $tracking->trackingId }}</td>
                                <td>{{ $tracking->pageIdToName($tracking->pageId) }}</td>
                                <td>{{ $tracking->forwardId }}</td>
                                <td>{{ $tracking->referer }}</td>
                                <td>{{ $tracking->created_at }}</td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    @if(count($tracking->trackingClicks) > 0)

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box">
                                                    <div class="box-body table-responsive no-padding">
                                                        <table class="table table-hover" style="background-color: #ccc;">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Action</th>
                                                                <th>Type</th>
                                                                <th>Name</th>
                                                                <th>When</th>
                                                            </tr>
                                                            @foreach($tracking->trackingClicks as $trackingClick)
                                                                <tr>
                                                                    <td>{{ $trackingClick->id }}</td>
                                                                    <td>{{ $trackingClick->action }}</td>
                                                                    <td>{{ $trackingClick->type }}</td>
                                                                    <td>{{ $trackingClick->name }}</td>
                                                                    <td>{{ $trackingClick->created_at }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
