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
                <a href="#" class="navbar-brand">{{ $school->code }}</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a aria-expanded="false" role="button" href="#"> 
                            {{ $school->name }}
                        </a>
                    </li>

                </ul>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">
                            Profile
                        </span>
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

<div class="wrapper wrapper-content animated fadeInRight" style="margin-top: -25px;">
    <!-- Primary Info -->
    <div class="row m-b-lg m-t-lg">
        <div class="col-md-12">
            <div class="profile-image">
                <img src="{{ url("/public/storage/profile/student/".$student->currentProgress()->year."/" . $student->id  .".jpg") }}"
                     class="img-circle circle-border m-b-md" 
                     alt="profile">
            </div>
            <div class="profile-info">
                <div class="">
                    <div>
                        <h2 class="no-margins">
                            <strong class="text-navy">{{ $student->fullName }}</strong>
                        </h2>
                        <h4>
                            LRN NO : 
                            <span class="text-danger">{{ $student->lrnNo }}</span>
                        </h4>
                        <h5>
                            Gender : 
                            <span class="text-warning">{{ $student->gender }}</span>
                        </h5>
                        <h5>
                            Date Of Birth : 
                            <span class="text-warning">
                                {{ date('M d, Y',strtotime($student->dateOfBirth)) }}
                            </span>
                        </h5>
                        <h5>
                            Current Age : 
                            <span class="text-warning">
                                {{ $student->currentAge }}
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row m-b-lg -m-t-lg -->

    <div class="row" style="margin-top: -30px;">

        <!-- Progress Info -->
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    @if (isset($currentProgress))
                    <h5>Student Details - SY {{ $currentSchoolYear->code }}</h5>
                    @else
                    <h5>Student Details</h5>
                    @endif
                </div>

                @if (isset($currentProgress))
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <dl class="dl-horizontal">
                                <dt>Status:</dt> 
                                <dd><span class="label label-primary">{{ $currentProgress->status }}</span></dd>
                            </dl>
                        </div>
                        <div class="col-lg-6">
                            <dl class="dl-horizontal">
                                <dt>Last Year Attended:</dt> 
                                <dd>
                                    <span class="label label-primary">
                                        {{ $currentProgress->last_year_attended }}
                                    </span>       
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <dl class="dl-horizontal">
                                <dt>Date Enrolled:</dt> 
                                    <dd> {{ date('M d, Y', strtotime($currentProgress->enrolledDate)) }} </dd>
                                <dt><small>(when time of enrolled)</small> Age :</dt> 
                                    <dd>{{ $currentProgress->ageTimeOfEnrolled }}</dd>
                                <dt>StudentID:</dt> 
                                <dd><a href="#" class="text-navy">
                                    {{ $currentSchoolYear->code.'-'.$currentProgress->syStudentID }}
                                </a></dd>
                                <dt>Level & Section:</dt> 
                                    <dd>{{ $currentLevel->level->level }} - {{ $currentSection->section }}</dd>
                                <dt>Shift :</dt> 
                                    <dd >
                                        {{ $currentSection->schedule->time }}
                                    </dd> 
                                <dt>Adviser :</dt> 
                                    <dd>{{ $currentSection->employee->fullName }}</dd>
                                <dt>Address :</dt> 
                                    <dd class="text-warning">{{ $currentProgress->address }}</dd>
                            </dl>
                        </div>
                        <div class="col-lg-6">
                            <dl class="dl-horizontal" >
                                <dt>Payment :</dt>
                                    <dd> 
                                        <span class="label label-info"> 
                                        {{ ($currentProgress->isCash) ? 'CASH' : 'INSTALLMENT' }} 
                                        </span>
                                    </dd>
                                <dt>Mobile No. :</dt> <dd> {{ $currentProgress->mobileNo }} </dd>
                                <dt>Landline No. :</dt> <dd> {{ $currentProgress->landlineNo }} </dd>
                                <dt>Parent/Gaurdian Name :</dt> <dd>{{ $currentProgress->guardianName }}</dd>
                                <dt>Relationship :</dt> <dd>{{ $currentProgress->guardianRelationship }}</dd>
                                <dt>Health Problem :</dt> <dd>{{ $currentProgress->healthProblem }} </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="row m-t-sm">
                        <div class="col-lg-12">
                            <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs" id="tabs">
                                            <li class="active"><a id="tab-1" data-toggle="tab">Fee</a></li>
                                            <li><a id="tab-2" data-toggle="tab">Payment</a></li>
                                            <li ><a id="tab-3" data-toggle="tab">Academic</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.panel-heading -->

                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="row tab-pane active" id="content-tab-1">
                                            <div class="col-lg-12">
                                                <h4 class="pull-left">Fee/s :</h4>
                                                <a class="btn btn-xs btn-primary pull-right"
                                                    onClick="studentFeeCreateModal({{ $currentProgress->id }})"
                                                    >
                                                    ADD FEE
                                                </a>
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center">Due Date</th>
                                                            <th>Discription</th>
                                                            <th class="text-center">Amount</th>
                                                            <th class="text-center">Discount</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Payment</th>
                                                            <th class="text-center">Balance</th>
                                                            <th class="text-center">&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($currentFee as $feeCount => $fee)
                                                        <tr>
                                                            <td>{{ $feeCount + 1 }} </td>
                                                            <td class="text-center">{{ $fee->displayDueDate }}</td>
                                                            <th >
                                                                <span class="label 
                                                                {{ ($fee->balance <= 0) ? 'label-primary' 
                                                                                       : 'label-danger' 
                                                                }}">
                                                                    {{ $fee->fee->fee }}
                                                                </span>
                                                            </th>
                                                            <td class="text-right">
                                                                {{ number_format($fee->feeAmount,2,'.',',') }}
                                                            </td>
                                                            <td class="text-right">
                                                                {{ number_format($fee->discount,2,'.',',') }}
                                                            </td>
                                                            <td class="text-right">
                                                                {{ 
                                                                number_format($fee->total,2,'.',',') }}
                                                            </td>
                                                            <td class="text-right">
                                                                {{ 
                                                                number_format($fee->total_payment,2,'.',',') }}
                                                            </td>
                                                            <td class="text-right">
                                                                <span class="font-bold">
                                                                {{ 
                                                                number_format($fee->balance,2,'.',',') }}
                                                                </span>
                                                            </td>
                                                            <td class="text-center">
                                                                <a onClick="studentFeeUpdateModal({{
                                                                        $fee
                                                                    }})">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                 | 
                                                                <a onClick="studentFeeDelete({{
                                                                        $fee->id
                                                                    }})">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="5"></th>
                                                            <th class="text-right">
                                                                P {{ number_format($currentProgress->total_fee,2,'.',',') }}
                                                            </th>
                                                            <th class="text-right">
                                                                P {{ number_format($currentProgress->total_payment,2,'.',',') }}
                                                                </th>
                                                            <th class="text-right">
                                                                P {{ number_format($currentProgress->total_balance,2,'.',',') }}
                                                                </th>
                                                            <th class="text-right">&nbsp;</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /#tab1C -->
                                        
                                        <div class="tab-pane" id="content-tab-3">
                                            <div class="feed-activity-list">
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <img alt="image" 
                                                            class="img-circle" 
                                                            src="{{ URL::to('assets/img/a4.jpg') }}">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right text-navy">5h ago</small>
                                                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                                        <div class="actions">
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Love</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /#tab3C -->

                                        <div class="row tab-pane" id="content-tab-2">
                                            <div class="col-lg-12">
                                                <h4 class="pull-left">Payment/s :</h4>
                                                <a class="btn btn-xs btn-primary pull-right"
                                                    onClick="studentPaymentCreateModal( '{{ $currentProgress->guardianName }}' )">
                                                    ADD PAYMENT
                                                </a>
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Inv No.</th>
                                                            <th>Payment By</th>
                                                            <th>Discription</th>
                                                            <th>Amount</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($currentPayment as $paymentCount => $payment)
                                                        <tr>
                                                            <td>
                                                                {{ date('F d, Y',strtotime($payment->payment_date)) }}
                                                            </td>
                                                            <td>{{ $payment->invNo }}</td>
                                                            <td>{{ $payment->payment_by }}</td>
                                                            <th>
                                                                {{ $payment->fee }}
                                                            </th>
                                                            <td class="text-right">
                                                                <span class="label 
                                                                    label-{{ ( $payment->isCancel )? 'danger':'primary' }}">
                                                                    P {{ number_format($payment->amount
                                                                            ,2,'.','.') }}
                                                                </span>
                                                            </td>
                                                            <td class="text-center">
                                                                @if( !$payment->isCancel )
                                                                    <a onClick="studentPaymentUpdateModal(
                                                                                    {{ $payment }}
                                                                                )">
                                                                        Edit
                                                                    </a>
                                                                    |
                                                                    <a onClick="studentPaymentCancel({{$payment->id}})">
                                                                        Cancel
                                                                    </a> 
                                                                @else
                                                                    <span class="label label-danger">
                                                                        Cancelled
                                                                    </span>
                                                                    &nbsp;| 
                                                                    <a onClick="studentPaymentRestore({{$payment->id}})">
                                                                        Restore!
                                                                    </a> 
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /#tab2C -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                    </div>
                </div>
                @else

                <!-- New Student View -->
                <div class="ibox-content">
                    <div class="m-b-md">
                        <h3>
                            New student!
                        </h3>
                        <h4>
                            <a class="font-italic" 
                                onClick="progressCreateModal(
                                            {{ $student }},
                                            '{{ $student->fullName }}',
                                            '{{ $student->currentAge }}'
                                )">
                                Click here to enroll.
                            </a>
                        </h4>
                    </div>
                </div>
                @endif

            </div>
        </div>

        <!-- HISTORY TABLE -->
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>History</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div>
                        <div class="feed-activity-list">
                            @foreach($student->student_history()->latest('year')->get() as $history)
                            <div class="feed-element">
                                <a href="#" class="pull-left">
                                    <img alt="image" class="img-thumbnail" 
                                            src="{{ URL::to('assets/img/a4.jpg') }}"
                                            style="width: 100px; height: 100px;">
                                </a>
                                <div class="media-body ">
                                    <!--
                                    <small class="pull-right text-navy">1m ago</small>
                                    -->
                                    Student ID :    
                                        <strong class="label label-success">
                                            {{ $history->sy_code.'-'. $history->syStudentID }}
                                        </strong>
                                    <br>
                                    School Year : <strong>{{ $history->year }}</strong>
                                    <br>
                                    Level & Section : 
                                        <strong>{{ $history->level }} - {{ $history->section }}</strong>
                                    <br>
                                    Adviser : 
                                    <strong>
                                        {{ $history->empFirstName }} {{ $history->empLastName }}
                                    </strong>
                                    <div class="actions">
                                        <a class="btn btn-xs btn-success"
                                            href="{{ route('student.profile',[
                                                'id' => $student->id,
                                                'year' => $history->year
                                            ]) }}">
                                            View 
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HISTORY TABLE -->
    </div>
</div>
<!-- /.wrapper wrapper-content animated fadeInRight -->

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
