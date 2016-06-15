@if (Auth::user())
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <!-- @can('usersTab')
                <li class="treeview">
                    <a href="#"><i class="fa fa-user"></i> Users <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
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
            <li class="treeview">
                <a href="#"><i class="fa fa-lock"></i> Security <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                @can('viewRoles')
                    <li><a href="{{ route('dashboard.roles') }}">Roles</a></li>
                @endcan
                @can('viewPermissions')
                    <li><a href="{{ route('dashboard.permissions') }}">Permissions</a></li>
                @endcan
                </ul>
            </li>
            @endcan -->
            @can('pagesTab')
                <li class="treeview">
                    <a href="#"><i class="fa fa-file-text"></i> Pages <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                    @can('createPage')
                        <li><a href="{{ route('dashboard.new.page') }}">Create</a></li>
                    @endcan
                    @can('editPage')
                        <li><a href="{{ route('dashboard.list.pages') }}">Edit</a></li>
                    @endcan
                    </ul>
                </li>
            @endcan
            @can('imagesTab')
                <li class="treeview">
                    <a href="#"><i class="fa fa-file-image-o"></i> Images <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                    @can('addImage')
                        <li><a href="{{ route('dashboard.new.image') }}">Add</a></li>
                    @endcan
                    @can('removeImage')
                        <li><a href="{{ route('dashboard.list.images') }}">Edit</a></li>
                    @endcan
                    </ul>
                </li>
            @endcan
            @can('analytics')
                <li class="treeview">
                    <a href="#"><i class="fa fa-sitemap"></i> Analytics <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('dashboard.page.analytics') }}">Page Analytics</a></li>
                        <li><a href="{{ route('dashboard.list.images') }}">Edit</a></li>
                    </ul>
                </li>
            @endcan
            @can('forward')
            <li class="treeview">
                <a href="#"><i class="fa fa-hand-o-right"></i> Forwards <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('dashboard.add.forward') }}">Create Forward</a></li>
                    <li><a href="{{ route('dashboard.list.forwards') }}">Edit</a></li>
                </ul>
            </li>
            @endcan
            @can('products')
            <li class="treeview">
                <a href="#"><i class="fa fa-product-hunt" aria-hidden="true"></i> Products <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @can('addProduct')
                        <li><a href="{{ route('dashboard.add.product') }}">Add Product</a></li>
                        @endcan
                        @can('editProduct')
                        <li><a href="{{ route('dashboard.list.products') }}">Edit Products</a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('category')
                <li class="treeview">
                    <a href="#"><i class="fa fa-folder-o" aria-hidden="true"></i>Product Categories <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        @can('addCategory')
                            <li><a href="{{ route('dashboard.add.category') }}">Add Category</a></li>
                        @endcan
                        @can('editCategories')
                            <li><a href="{{ route('dashboard.list.categories') }}">Edit Categories</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('customers')
                <li class="treeview">
                    <a href="#"><i class="fa fa-user" aria-hidden="true"></i>Customers <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        @can('listCustomers')
                            <li><a href="{{ route('dashboard.list.customers') }}">Customers</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

@endif