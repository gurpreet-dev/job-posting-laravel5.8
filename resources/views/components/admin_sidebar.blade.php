<!-- Sidebar -->
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ \App\Hash::userImage('/images/users/', Auth::user()->image) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{url('admin/dashboard')}}">
                <i class="fa fa-globe"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>

            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ route('admin.users') }}"><i class="fa fa-circle-o"></i> All Users</a></li>
                    <li><a href="{{ route('admin.deleted-users') }}"><i class="fa fa-circle-o"></i> Deleted Users</a></li>
                </ul>
            </li> -->

            <li>
                <a href="{{ route('admin.users') }}">
                <i class="fa fa-users"></i> <span>Users</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.jobs') }}">
                <i class="fa fa-rss"></i> <span>Jobs</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.list_blog')}}">
                <i class="fa fa-american-sign-language-interpreting"></i> <span>Practice Growth Interviews</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.faq') }}">
                <i class="fa fa-book"></i> <span>Faq's</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.experiences')}}">
                <i class="fa fa-child"></i> <span>User Experiences</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>

            <li>
                <a href="{{ url('/') }}/admin/pages }}">
                <i class="fa fa-dedent"></i> <span>Pages</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.config') }}">
                <i class="fa fa-gear"></i> <span>Config</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.contacts') }}">
                <i class="fa fa-phone"></i> <span>Support</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.plans') }}">
                <i class="fa fa-pencil"></i> <span>Subscription Plans</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>

            <!-- <li>
                <a href="">
                <i class="fa fa-cube"></i> <span>Kitchen Categories</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li> -->


            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- Sidebar end -->