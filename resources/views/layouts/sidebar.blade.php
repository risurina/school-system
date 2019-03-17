<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element text-center">
                    <span>
                        <img alt="image" class="img-circle"
                                src="{{ URL::to('storage/school/'. ((session('school_id')) ? \App\School::find( session('school_id') )->code : \App\School::find( Auth::user()->school_id )->code) .'-logo.png') }}"
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
                <div class="logo-element">
                    @if ( session('school_id') )
                        {{ \App\School::find( session('school_id') )->code }}
                    @else
                        {{ \App\School::find( Auth::user()->school_id )->code }}
                    @endif
                </div>
            </li>

            <li id="sidemenu_id">
                <a href="{{ route('id.index') }}">
                    <i class="fa fa-th-large"></i><span class="nav-label">Information</span>
                </a>
            </li>

            <li id="attendance_settings">
                <a href="{{ route('attendance.index') }}">
                    <i class="fa fa-calendar-check-o"></i><span class="nav-label">Attendance</span>
                </a>
            </li>

            <!-- Hide

            <li id="sidemenu_dashboard">
                <a href="{{ route('index') }}">
                    <i class="fa fa-th-large"></i><span class="nav-label">Dashboards</span>
                </a>
            </li>

            <li id="sidemenu_student">
                <a href="{{ route('student.index') }}">
                    <i class="fa fa-address-book"></i><span class="nav-label">Student</span>
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


            <li id="sidemenu_settings">
                <a href="{{ route('setting.index') }}">
                    <i class="fa fa-cogs"></i><span class="nav-label">Settings</span>
                </a>
            </li>
            -->

            <li id="textbrigade_settings">
                <a href="{{ route('textbrigade.index') }}">
                    <i class="fa fa-envelope"></i><span class="nav-label">Text Brigade</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
