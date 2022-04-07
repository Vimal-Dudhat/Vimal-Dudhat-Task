<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><span>Admin Dashboard</span></a>
        </div>

        <div class="clearfix"></div>


        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('company.list')}}"><i class="fa fa-plus-circle"></i> Companies <span class="fa fa-chevron-right"></span></a>
                        {{-- <ul class="nav child_menu">
                            <li><a href="{{ route('company.create') }}">Add</a></li>
                            <li><a href="{{ route('company.list') }}">View</a></li>
                        </ul> --}}
                    </li>
                </ul>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('employee.list')}}"><i class="fa fa-user"></i> Employees <span class="fa fa-chevron-right"></span></a>
                        {{-- <ul class="nav child_menu">
                            <li><a href="{{ route('employee.create') }}">Add</a></li>
                            <li><a href="{{ route('employee.list') }}">View</a></li>
                        </ul> --}}
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">

            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" style="width: 100%;">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
