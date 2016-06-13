<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="padding: 0px 10px 0px 0px;" href="/home.html">
                <img data-name="gas-elec logo" data-type="image" class="hover" data-action="hover"
                     src="http://www.gas-elec.co.uk/images/logo.png"
                     alt="Gas, Electrical Safety Certificates, inspections and Services"/>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if ($pages->count() > 0)
                    @foreach ($pages as $page)
                        @include('site.layouts.partials_menu', $page)
                    @endforeach
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="form-inline" id="1" style="padding-top:8px;" name="1" method="post" action="postPostcode">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <span class="input-group-addon">Your Postcode</span>
                            <input type="text" name="postcode" class="form-control" placeholder="Postcode for office:">
                            <span class="input-group-btn">
                                <input class="btn btn-success" type="submit" value="Search">
                            </span>
                        </div>
                    </form>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

