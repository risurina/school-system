@extends('layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Attendance</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('index') }}">Home</a>
            </li>
            <li class="active">
                <strong>Attendance</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <!-- Level Table -->
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Logs Table</h5>
                    <div class="ibox-tools pull-right">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>


                    </div>

                    <div>
                        <!-- Date Range -->
                        <form method="get" action="{{ route('attendance.index') }}" id="search_form">
                         <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                        <a class="label label-warning-light pull-right" id="submitBTN">
                            <i class="fa fa-search"></i>
                            Search
                        </a>


                        <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

                        <input type="date"
                            class="form-control input-sm pull-right"
                            name="dateTo"
                            value="{{ ($dateTo) ? $dateTo : date('Y-m-d') }}"
                            style="margin-top:-5px; width: 17%">
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                        <span class="pull-right">Date To : </span>
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>

                        <input type="date"
                            class="form-control input-sm pull-right"
                            name="dateFrom"
                            value="{{ ($dateFrom) ? $dateFrom : date('Y-m-1') }}"
                            style="margin-top:-5px; width: 17%">
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                        <span class="pull-right">Date From : </span>
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                        <!-- End Date Range -->

                        <select class="form-control input-sm pull-right"
                                name="type"
                                style="margin-top:-5px; width: 12%">
                            <option value="STAFF" >STAFF</option>
                            <option value="STUDENT" {{ ($type == 'STUDENT') ? 'selected' : '' }}>STUDENT</option>
                        </select>
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                        <span class="pull-right">Type : </span>
                        </form>
                    </div>
                </div>
                <!-- /.ibox-titel -->

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="attnTable">
                            <thead>
                                <th style="width: 1%" class="text-center">#</th>
                                <th >Name</th>
                                <th>Date</th>
                                <th>Time IN</th>
                                <th>Time OUT</th>
                            </thead>
                            <tbody>
                                @if ($logs)
                                    @foreach($logs as $logCount => $log)
                                        <tr>
                                            <td class="text-center">{{ $logCount + 1 }}</td>
                                            <td>
                                              {{ $log['log']->id()->first()->full_name }}
                                            </td>

                                            <td class="">
                                                <a onclick="showLogs(
                                                                '{{ collect($log['allLogs'])->toJson() }}',
                                                                '{{ $log['log']->id }}',
                                                                '{{ date('M d, Y', strtotime($log['date'])) }}'
                                                            )">
                                                    {{ date('M d, Y', strtotime($log['date'])) }}
                                                </a>
                                            </td>
                                            <td class="{{ ($log['isLate']) ? 'text-danger font-bold' : '' }}">
                                                {{ $log['IN'] }}
                                            </td>
                                            <td class="{{ ($log['earlyOut']) ? 'text-warning font-bold' : '' }}">
                                                {{ $log['OUT'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                              @if (!$logs)
                                <tr>
                                    <td class="text-center" colspan="5">
                                        No Logs!
                                    </td>
                                </tr>
                              @endif
                            </tbody>
                        </table>
                        <small>Click date to see logs!</small>
                    </div>
                </div>
                <!-- /.ibox-content -->
            </div>
        </div>
        <!-- End Level Table -->
    </div>
</div>

<div class="modal inmodal in" id="logs_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="ibox-title">
                <h5>Logs</h5>
            </div>
            <!-- /.ibox-title -->

            <div class="ibox-content">
                <div class="row">
                  <div class=" form-group col-lg-12">
                    <label class="m-t-none m-b">
                      Name : <span class="text-navy" id="fullName"></span>
                    </label>
                    <label class="m-t-none m-b">
                      Date : <span class="text-navy" id="date"></span>
                    </label>
                  </div>
                </div>
                <!-- /.row -->

                <table class="table table-striped table-bordered table-hover" style="padding-top: -30px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.ibox-content -->
            <div class="ibox-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-white btn-sm " data-dismiss="modal">
                  Close
                </button>
              </div>
              <div>&nbsp;<br>&nbsp;</div>
            </div>
            <!-- /.ibox-footer -->
        </div>
        <!-- /.modal-content animated flipInY -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal inmodal -->

@endsection

@section('js_script')

<script type="text/javascript">
/** Highlight Sidebard **/
$('#attendance_settings').addClass('active');
$('title').text('SIS | Attendance');
</script>

<script>
    function showLogs($logs, $name, $date) {
        var sliceLog = $logs.slice(1, -1);
        var splitLog = sliceLog.split(',')

        let tbody = '';
        $.each(splitLog, function(i, v) {
            let count = i + 1;
            tbody += '<tr>' +
                        '<td>'+ count +'</td>' +
                        '<td>'+ v.slice(1, -1) +'</td>' +
                    '</tr>';
        });

        $('#logs_modal #fullName').html( $name );
        $('#logs_modal #date').html( $date );
        $('#logs_modal .ibox-content table tbody').html( tbody );
        $('#logs_modal').modal('show');
    }

    $(document).ready(function(){
        $('#submitBTN').click(function (e) {
            e.preventDefault
            $('#search_form').submit();
        });

        $('#search_form').on('change',function() {
            $('#search_form').submit();
        })

        $('#attnTable').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'Time And Attendance'},
                {extend: 'pdf', title: 'Time And Attendance'},
            ]

        });
    });
</script>


@endsection
