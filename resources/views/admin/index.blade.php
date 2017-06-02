<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ID System</title>

    <link href="{{ URL::to('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ URL::to('assets/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
        <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <i class="fa fa-reorder"></i>
                </button>
                <a href="#" class="navbar-brand">IDMS</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a aria-expanded="false" role="button" href="#"> 
                            ID Management Systen
                        </a>
                    </li>

                </ul>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome! {{ Auth::user()->name }}</span>
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
            </div>
        </nav>
        </div>

        <!-- School Table -->
        <div class="wrapper wrapper-content">
            <div class="row">
              <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>School Table</h5>
                        <div class="ibox-tools">
                            <a href="#add-school" class="btn btn-primary btn-xs" onclick="schoolCreate()">
                                <i class="fa fa-plus"></i>
                            </a>
                            <a href="#refresh-table" onclick="schoolTable()">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.ibox-titel -->

                    <div class="ibox-content">
                        <!-- Search and filter form -->
                        <div class="row">
                            <div class="col-lg-12">
                            <form id="search_form" method="post" accept-charset="utf-8">
                                <div class="pull-left form-inline">
                                    <label>Show 
                                        <input type="number" name="show_row" 
                                                value="8" class="form-control input-sm" 
                                                style="width:60px;" min="1" max="1000">
                                    </label>


                                    <label>&nbsp;&nbsp;Limit
                                        <input type="number" name="limit" 
                                                value="250" class="form-control input-sm" 
                                                style="width:70px;" min="1" max="1000">
                                    </label>
                                </div>

                                <div class="pull-right form-inline">
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-sm">
                                            <span>Copy</span>
                                        </a>
                                        <a class="btn btn-default btn-sm">
                                            <span>CSV</span>
                                        </a>
                                        <a class="btn btn-default btn-sm">
                                            <span>Excel</span>
                                        </a>
                                        <a class="btn btn-default btn-sm">
                                            <span>PDF</span>
                                        </a>
                                        <a class="btn btn-default btn-sm" >
                                            <span>Print</span>
                                        </a>
                                </div>
                                </div>

                                <div class="pull-right form-inline">
                                    <label>Search:
                                        <input type="text" class="form-control input-sm" name="search_key">
                                    </label>&nbsp;
                                </div>
                            </form>
                            </div>

                            <div class="col-lg-12" id="table_pagination">
                            </div>
                        </div>
                        <!-- /.row -->

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>CODE</th>
                                    <th>NAME</th>
                                    <th>ADDRESS</th>
                                    <th>&nbsp;</th>
                                  </tr>
                                </thead> 
                                <tbody id="table_body">
                                    <!-- table row go here -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.ibox-content -->
                </div>
                <!-- /.ibox float-e-margins -->
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.wrapper wrapper-content animated fadeInRight -->
        <!-- End School Table -->

        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

        </div>
        </div>

    <!-- School View Form -->
    <form method="POST" action="{{ route( 'school.index') }}" id="schoolView_form">
        {{ csrf_field() }}
        <input type="hidden" name="school_id">
        <input type="submit" value="test">
    </form>
    <!-- End School View Form -->

    @include('school.schoolModal')

    <!-- Mainly scripts -->
    <script src="{{ URL::to('assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ URL::to('assets/js/inspinia.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins/pace/pace.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ URL::to('assets/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ URL::to('assets/js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- Peity -->
    <script src="{{ URL::to('assets/js/plugins/peity/jquery.peity.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ URL::to('assets/js/plugins/toastr/toastr.min.js') }}"></script>

    @include('school.schoolScript')

    <script type="text/javascript">
        function schoolView($school_id) {
            let schoolView_form = $( '#schoolView_form' );
            schoolView_form.find('input[name=school_id]').val( $school_id );
            schoolView_form.submit();
        }
    </script>
</body>
</html>
