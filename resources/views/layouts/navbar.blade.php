<div class="row border-bottom">
    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                <i class="fa fa-bars"></i>
            </a>

            <a class="minimalize-styl-2 btn btn-default " href="/admin">
                Back To School List
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                @if (Auth::user()->school_id)
                    <span class="m-r-sm text-muted welcome-message">Welcome! {{ Auth::user()->name }}</span>
                @else
                    <strong class="m-r-sm welcome-message text-navy">
                        {{ \App\School::find( session('school_id') )->name }}
                    </strong>
                @endif
            </li>
            <li>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>

    </nav>
</div>
