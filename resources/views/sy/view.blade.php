@extends('layouts.master')

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-4">
        <h2>
            Welcome to year <strong class="text-navy">{{ $sy->year }}</strong>
        </h2>
        <p>CODE : <strong class="text-navy">{{ $sy->code }}</strong></p>
        <p>
            Date : 
            <strong class="text-navy"> {{ $sy->displayStartDate() . ' - ' . $sy->displayEndDate() }} </strong>
        </p>

        <button class="btn btn-sm btn-flat btn-info" onClick="syUpdateModal({{ $sy }})">Edit</button>
        <button class="btn btn-sm btn-flat btn-info" onClick="lvlAndSec_show()">Level & Section</button>
        <button class="btn btn-sm btn-flat btn-primary">Student</button>
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

    <div class="col-md-4">
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
</div>
<!-- /.row  border-bottom white-bg dashboard-header -->

@include('sy.modalForm')
@endsection

@section('js_script')

<script type="text/javascript"> 
/** Highlight Sidebard **/
$('#sidemenu_sy').addClass('active');
</script>

@include('sy.script')
@endsection
