@extends('layouts.master')

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-4">
        <h2>
            {{ $req }} - School Year <strong class="text-navy">{{ $sy->year }} - {{ $sy->year + 1 }}</strong>
        </h2>
        <p>CODE : <strong class="text-navy">{{ $sy->code }}</strong></p>
        <p>
            Date : 
            <strong class="text-navy"> 
                {{ $sy->displayStartDate() . ' - ' . $sy->displayEndDate() }} 
            </strong>
        </p>

        <div id="tabs">
            <span>
                <button class="btn btn-sm btn-flat btn-info" 
                        onClick="syUpdateModal({{ $sy }})">
                        Edit
                </button>
            </span>
            <span >
                <a id="tab-1" data-toggle="tab" class="btn btn-sm btn-flat btn-primary"> 
                    Level & Section
                </a>
            </span>
            <span>
                <a id="tab-2" data-toggle="tab" class="btn btn-sm btn-flat btn-primary">
                    Student
                </a>
            </span>
        </div>
    </div>

    <div class="col-md-4">
        <ul class="list-group clear-list m-t">
            <li class="list-group-item fist-item">
                <strong>Grading Period</strong>
            </li>
            <li class=" row list-group-item">
                <div class="col-lg-6">
                   <span class="label label-primary">1st</span>
                   {{ $sy->displayDateFormat($sy->firstGrading) }} 
                </div>
                <div class="col-lg-6">
                    <span class="label label-success">2nd</span>
                    {{ $sy->displayDateFormat($sy->secondGrading) }}
                </div>
            </li>
            <li class=" row list-group-item">
                <div class="col-lg-6">
                   <span class="label label-warning">3rd</span>
                   {{ $sy->displayDateFormat($sy->thirdGrading) }} 
                </div>
                <div class="col-lg-6">
                    <span class="label label-danger">4th</span>
                    {{ $sy->displayDateFormat($sy->fourthGrading) }}
                </div>
            </li>
        </ul>
    </div>

    <div class="col-md-2">
        <ul class="list-group clear-list m-t">
            <li class="list-group-item fist-item">
                <strong>Monthly Schedule</strong>
            </li>
            <li class=" row list-group-item">
                <div class="col-lg-12">
                   <span class="label label-primary">{{ $sy->monthlyExam }}th</span>
                   Examination
                </div>
            </li>
            <li class=" row list-group-item">
                <div class="col-lg-12">
                   <span class="label label-warning">{{ $sy->monthlyDue }}th</span>
                   Payment Due
                </div>
            </li>
        </ul>
    </div>

    <div class="col-md-2">

        <div class="row m-t-xs">
            <div class="col-xs-12">
                <center>
                    <h4 class="m-b-xs">Enrolled Student</h4>
                    <h1 class="no-margins font-bold text-navy">{{ $sy->total_student }}</h1>
                    <h5>&nbsp;</h5>
                     <button class="btn btn-sm btn-flat btn-info" 
                            onClick="printMaterListModal( {{ $sy->year }} )">
                            Print Master List
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>
<!-- /.row  border-bottom white-bg dashboard-header -->

<div class="wrapper wrapper-content">
    <div class="row tab-pane active" id="content-tab-2">
        <!-- Level Table -->
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Students Table</h5>
                    <div class="ibox-tools pull-right">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <!-- Search and filter form -->
                    <div class="row">
                        <div class="col-lg-12">
                        <form id="search_form" method="post" accept-charset="utf-8">
                            <input type="hidden" name="school_year" value="{{ $sy->year }}">

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

                                <label>&nbsp;&nbsp;Levels
                                    <input type="hidden" name="level_id">
                                    <select name="level" 
                                            class="form-control input-sm" 
                                            style="width:120px;">
                                        <option value="">All levels</option>
                                        @foreach($schoolYearLevels as $level)
                                        <option 
                                            value='{ "level_id" : "{{ $level->id }}",
                                                    "sections":{{ $level->school_year_level_sections }} }'
                                        >
                                            {{ $level->level->level }}
                                        </option>
                                        @endforeach
                                    </select>
                                </label>

                                <label>&nbsp;&nbsp;Section
                                    <select name="section_id" 
                                            class="form-control input-sm" 
                                            style="width:130px;">
                                        <option value="">All sections!</option>
                                    </select>
                                </label>
                            </div>

                            <div class="pull-right form-inline">
                                <label>Search:
                                    <input type="text" 
                                            class="form-control input-sm" 
                                            placeholder="Student Name" 
                                            name="search_key">
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
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">STUDENT ID</th>
                                <th class="text-center">LEVEL</th>
                                <th class="text-center">SECTION</th>
                                <th class="text-center">STUDENT NAME</th>
                                <th class="text-center">TTL FEE</th>
                                <th class="text-center">TTL PYMNT</th>
                                <th class="text-center">TTL BALANCE</th>
                                <th>&nbsp;</th>
                              </tr>
                            </thead> 
                            <tbody id="table_body">
                                <!-- table row go here -->
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-lg-12" id="lvlTable_pagination">
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        <!-- End Level Table -->
    </div>

    <div class="row tab-pane" id="content-tab-1">
        <!-- Level Table -->
        <div class="col-lg-12" id="lvlTable">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>LEVEL TABLE</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">LEVEL</th>
                            <th class="text-center">FEE'S</th>
                            <th class="text-center"># OF SECTION</th>
                            <th class="text-center"># OF STUDENT</th>
                            <th class="text-center">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($schoolYearLevels as $lvlCount => $syLvl)
                            <tr>
                                <td class="text-center">{{ $lvlCount + 1 }}</td>
                                <td class="text-center font-bold text-navy">{{ $syLvl->level->level }}</td>
                                <td class="text-center">
                                    {{ number_format( $syLvl->total_fee, 2, '.', ',') }}
                                </td>
                                <td class="text-navy text-center">
                                    {{ $syLvl->school_year_level_sections()->count() }}
                                </td>
                                <td class="text-navy text-center">
                                    {{ $syLvl->total_student }}
                                </td>
                                <td class="text-center">
                                    <a onClick="lvlView( 
                                             '{{ $syLvl->level->level }}'
                                            ,{{ $syLvl->school_year_level_sections }} )">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Level Table -->

        <!-- Section Table -->
        <div class="col-lg-12" id="secTable" hidden>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>SECTION TABLE</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div>
                        <div class="feed-activity-list">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section Table -->
    </div>
</div>
<!-- /.wrapper wrapper-content -->

@include('sy.modalForm')
@include('syLevel.modalForm')
@include('syLevelFee.modalForm')
@include('section.modalForm')
@endsection

@section('js_script')

<script type="text/javascript"> 
/** Highlight Sidebard **/
$('#sidemenu_dashboard').addClass('active');
$('#sidemenu_dashboard ul li:first').addClass('active');

</script>

@include('sy.profileScript')
@include('syLevel.script')
@include('syLevelFee.script')
@include('section.script')

<script type="text/javascript"> 
    $(document).ready(function () {
        $('#content-tab-1').hide();
    });

    function lvlView($lvl,$sections) {
        var sectionRow = '';

        if ($sections.length <= 0) {
            sectionRow = '<div class="feed-element">' +
                            '<div class="media-body text-center">' +
                                '<span><strong class="text-navy">'+
                                    $lvl+
                                '</strong> has no Section!</span>' +
                            '</div>' +
                        '</div>';
        } else {
            $.each($sections, function(i, v) {

                sectionRow += '<div class="feed-element">' +
                                '<div class="media-body ">' +
                                    '<span class="pull-right badge badge-primary">'+(i+1)+'</span>' +
                                    'SECTION : <strong class="text-navy">'+v.section+'</strong><br>' +
                                    'ADVISER : <strong>'+v.adviser+'</strong><br>' +
                                    'TIME : <strong>'+v.schedule_time+'</strong><br>' +
                                    '# OF STUDENT : <strong>'+v.total_student+'</strong><br>' +
                                '</div>' +
                            '</div>';
            });
        }

        $( '#secTable .ibox-title h5' ).html(  
            '<span class="text-info">' + $lvl + '</span> - SECTION TABLE'
        );

        $( '#lvlTable' ).attr('class','col-lg-6');
        $( '#secTable' ).attr('class','col-lg-6').show();

        $( '#secTable .ibox .ibox-content .feed-activity-list' ).html( sectionRow );
    }
</script>
@endsection
