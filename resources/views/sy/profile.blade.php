@extends('layouts.master')

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-4">
        <h2>
            School Year <strong class="text-navy">{{ $sy->year }} - {{ $sy->year + 1 }}</strong>
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
                        <table class="table table-striped table-bordered">
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
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Levels & Sections Table</h5>
                    <div class="ibox-tools pull-right">
                        <a class="btn btn-primary btn-xs" 
                           onclick="sylvlCreateModal()">
                           <span class="font-bold
                           ">Add Level</span>
                        </a>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <!-- Table -->
                    <div class="table-responsive project-list">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th class="text-center">Level</th>
                                    <th>Sectio's & Schedule</th>
                                    <th>Fee's</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="lvlTable_body">
                            @foreach ($schoolYearLevels as $schoolYearLevel)
                            <tr>
                                <td class="text-center project-status">
                                    <h4 class="label label-primary">
                                        {{ $schoolYearLevel->level->level }}
                                    </h4>
                                    <center>Total Student : {{ $schoolYearLevel->total_student }}</center>
                                </td>
                                <td class="project-title">
                                    @foreach ($schoolYearLevel->school_year_level_sections 
                                            as $syLevelSectionCount => $schoolYearLevelSection)
                                        @if ($syLevelSectionCount != 0)
                                            <div class="border-top" style="margin-top: 4px;"></div>
                                        @endif
                                        
                                        <strong>
                                            {{ $schoolYearLevelSection->section }}
                                            <a class="text-success pull-right"
                                                onClick="sectionDelete({{ $schoolYearLevelSection->id }})">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <span class="pull-right">&nbsp;|&nbsp;</span> 
                                            <a class="text-success pull-right"
                                                onClick="sectionUpdateModal('{{ $schoolYearLevel->level->level                          }}',
                                                                            {{ $schoolYearLevelSection }}
                                                )">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </strong>
                                        <br>
                                        <small>
                                            Adviser : {{ $schoolYearLevelSection->adviser }} / 
                                            {{ $schoolYearLevelSection->level }}
                                        </small>
                                        <br>                                            
                                        <small>
                                            No. Of Student : 
                                            <span class="badge badge-primary">{{ $schoolYearLevelSection
                                                    ->total_student }}
                                            </span>
                                        </small> 
                                        <br>
                                        <small>
                                            Schedule : 
                                            <span class="label label-info"> 
                                                {{ $schoolYearLevelSection->schedule_time }}
                                            </span>
                                            <span>
                                        </small>          
                                    @endforeach
                                    @if( count($schoolYearLevel->school_year_level_sections) == 0 )
                                        <strong>
                                            No Section!
                                        </strong>
                                    @endif
                                </td>
                                <!-- End Sections And Schedule -->

                                <!-- Fee's -->
                                <td class="project-title border-left">
                                @foreach ($schoolYearLevel->school_year_level_fees()
                                                          ->oldest('fee_id')->get() 
                                            as $syLevelFeeCount => $schoolYearLevelFee)
                                    <div class="stream-small">
                                        <small>{{ $syLevelFeeCount + 1 }}.</small>
                                        <span class="font-bold">{{ $schoolYearLevelFee->fee->fee }}</span>
                                        <span class="pull-right">
                                            <a onClick="sylvlfeeUpdateModal(
                                                    '{{ $schoolYearLevel->level->level}}',
                                                    '{{ $schoolYearLevelFee->fee->fee }}',
                                                     {{ $schoolYearLevelFee }}
                                                )">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                             | 
                                            <a onClick="sylvlfeeDelete(
                                                {{ $schoolYearLevelFee->id }}
                                               )">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </span>
                                        <span class="pull-right">&nbsp;</span>
                                        <span class="label label-primary pull-right">
                                            P {{ number_format($schoolYearLevelFee->feeAmount,2,'.',',') }}
                                        </span>

                                    </div>
                                   
                                @endforeach

                                @if(count($schoolYearLevel->school_year_level_fees) == 0)
                                    <strong>
                                        No Fee!
                                    </strong>
                                @endif
                                </td>
                                <!-- End Fee's -->

                                <td class="text-center border-left project-action">
                                    <div class="dropdown">
                                        <button data-toggle="dropdown" 
                                                class="btn btn-primary btn-sm dropdown-toggle" >
                                                Actions <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a onClick="sectionCreateModal({{ $schoolYearLevel->id }},
                                                                                '{{ $schoolYearLevel->level->level }}'
                                                )">
                                                    <strong>Add Section</strong>
                                                </a>
                                            </li>
                                            <li>
                                                <a onClick="sylvlfeeCreateModal(
                                                        {{ $schoolYearLevel->id }},
                                                        '{{ $schoolYearLevel->level->level }}'
                                                )">
                                                    <strong>Add Fee</strong>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a onClick="syLevelDelete(
                                                                {{ $schoolYearLevel->id }})">
                                                    <strong>Remove Level</strong>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
$('#sidemenu_sy').addClass('active');
</script>

@include('sy.profileScript')
@include('syLevel.script')
@include('syLevelFee.script')
@include('section.script')
@endsection
