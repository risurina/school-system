<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element text-center">
                    <span>
                        <img alt="image" class="img-circle" src="{{ URL::to('assets/img/a4.jpg') }}" 
                        style="width: 70px; height: 70px; border: 3px white solid;"/>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ Auth::user()->name }}</strong>
                                <b class="caret"></b>
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{  route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </li>
            <li id="sidemenu_dashboard">
                <a href="{{ url('/home') }}">
                    <i class="fa fa-home"></i><span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li id="sidemenu_student">
                <a href="{{ route('student.index') }}">
                    <i class="fa fa-address-book"></i><span class="nav-label">Student</span>
                </a>
            </li>
            <li id="sidemenu_lvl_sec">
                <a href="{{ route('lvl.index') }}">
                    <i class="fa fa-area-chart"></i><span class="nav-label">Level & Section</span>
                </a>
            </li>
            <li id="sidemenu_sy">
                <a href="{{ route('sy.index') }}">
                    <i class="fa fa-calendar"></i><span class="nav-label">School Year</span>
                </a>
            </li>
            <li id="sidemenu_employee">
                <a href="{{ route('emp.index') }}">
                    <i class="fa fa-user-o"></i><span class="nav-label">Employee</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
