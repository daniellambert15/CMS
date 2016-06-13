@extends('admin.layouts.app')

@section('pageTitle', 'Forward List')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><i class="fa fa-hand-o-right "></i> Forward List</a></li>
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
            <p>Please remember, when copying the URL's for emails, you can use something
                like <a href="http://www.gas-elec.co.uk/forward/?id=5&email=daniel.lambert@gas-elec.co.uk"
                >forward/?id=5&email=daniel.lambert@gas-elec.co.uk</a></p>
            <ul>
                <li>id</li>
                <li>email</li>
                <li>trackingId</li>
            </ul>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>URL</th>
                            <th>Description</th>
                            <th>Delete</th>
                        </tr>
                        @foreach($forwards as $forward)
                            <tr>
                                <td>{{ $forward->id }}</td>
                                <td>{{ $forward->url }}</td>
                                <td>{{ $forward->description }}</td>
                                <td>
                                    <a class="btn btn-danger btn-sm" title="delete Forward"  href="{{ route('dashboard.delete.forward', ['id' => $forward->id]) }}" onclick="return confirm('Are you sure you want to delete the forward?');" role="button"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
