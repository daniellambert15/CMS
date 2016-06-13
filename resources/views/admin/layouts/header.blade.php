<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('dashboard.home') }}" class="logo">gas-<em>elec</em></a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">

        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle hidden-lg hidden-md hidden-sm" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                @if (Auth::guest())
                    <li><a href="{{ url('/dashboard/login') }}">Login</a></li>
                    <li><a href="{{ url('/dashboard/register') }}">Register</a></li>
                @else



                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->fullName }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <!-- <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" /> -->
                                <p>
                                    {{ Auth::user()->fullName }}
                                    <small>{{ Auth::user()->email }}</small>
                                </p>
                            </li>
                            <!-- Menu Body
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li> -->
                            @can('usersTab')
                            <li class="user-body col-xs-6">
                                <i class="fa fa-user"></i> Users
                                <ul>
                                    @can('addUser')
                                    <li><a href="{{ route('dashboard.new.user') }}">Create</a></li>
                                    @endcan
                                    @can('editUser')
                                    <li><a href="{{ route('dashboard.user.list') }}">Edit</a></li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @can('viewSecurity')
                            <li class="user-body col-xs-6">
                                <i class="fa fa-lock"></i> Security
                                <ul>
                                    @can('viewRoles')
                                    <li><a href="{{ route('dashboard.roles') }}">Roles</a></li>
                                    @endcan
                                    @can('viewPermissions')
                                    <li><a href="{{ route('dashboard.permissions') }}">Permissions</a></li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat"><i class="fa fa-lock"></i> My Settings</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/dashboard/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>

                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>