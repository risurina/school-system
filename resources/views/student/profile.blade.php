@extends('layouts.master')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight" style="margin-top: -20px;">
    <div class="row m-b-lg m-t-lg">
        <div class="col-md-6">
            <div class="profile-image">
                <img src="{{ URL::to('assets/img/a4.jpg')}}" 
                     class="img-circle circle-border m-b-md" 
                     alt="profile">
            </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <a class="btn btn-success btn-xs pull-right"
                                    onClick="studentUpdateModal({{ $student }})">Edit Info</a>
                                <h2 class="no-margins">
                                    <strong class="text-navy">{{ $student->fullName() }}</strong>
                                </h2>
                                <h4>
                                    LRN NO : 
                                    <span class="text-danger">{{ $student->lrnNo }}</span>
                                </h4>
                                <h5>
                                    Date Of Birth : 
                                    <span class="text-warning">
                                        {{ date('M d, Y',strtotime($student->dateOfBirth)) }}
                                    </span>
                                </h5>
                                <h5>
                                    Current Age : 
                                    <span class="text-warning">
                                        {{ $student->currentAge($student->dateOfBirth) }}
                                    </span>
                                </h5>
                                <h5>
                                    Address :
                                    <span class="text-warning">
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form Ipsum available.
                                        </p>
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary dim btn-large-dim" type="button">
                <div class="row">
                    <div class="col-lg-12">
                    <i class="fa fa-money"></i>
                    </div>
                    <div class="col-lg-12">
                        <i style="font-size: 10pt; padding: 0">Payment</i>
                    </div>
                </div>
            </button>
            <button class="btn btn-warning dim btn-large-dim" type="button">
                <div><i class="fa fa-warning"></i></div>
                <div style="font-size: 10pt; margin-top: -10px;">TEST</div>
            </button>
        </div>
        <div class="col-md-3">
            <small>Sales in last 24h</small>
            <h2 class="no-margins">206 480</h2>
            <div id="sparkline1"></div>
        </div>
    </div>
    <!-- /.row m-b-lg -m-t-lg -->

    <div class="row">
        <div class="col-lg-9">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-title">
                        <h3>Student Progress</h3>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <a href="#" class="btn btn-white btn-xs pull-right">Edit Progress</a>
                                    <h2>School Year 2017</h2>
                                </div>
                                <dl class="dl-horizontal">
                                    <dt>Status:</dt> <dd><span class="label label-primary">Active</span></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Created by:</dt> <dd>Alex Smith</dd>
                                        <dt>Messages:</dt> <dd>  162</dd>
                                        <dt>Client:</dt> <dd><a href="#" class="text-navy"> Zender Company</a> </dd>
                                        <dt>Version:</dt> <dd>  v1.4.2 </dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >

                                        <dt>Last Updated:</dt> <dd>16.08.2014 12:15:57</dd>
                                        <dt>Created:</dt> <dd>  10.07.2014 23:36:57 </dd>
                                        <dt>Participants:</dt>
                                        <dd class="project-people">
                                        <a href="#"><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                        <a href="#"><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                                        <a href="#"><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                        <a href="#"><img alt="image" class="img-circle" src="img/a4.jpg"></a>
                                        <a href="#"><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                                        </dd>
                                    </dl>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt>Completed:</dt>
                                        <dd>
                                            <div class="progress progress-striped active m-b-sm">
                                                <div style="width: 60%;" class="progress-bar"></div>
                                            </div>
                                            <small>Project completed in <strong>60%</strong>. Remaining close the project, sign a contract and invoice.</small>
                                        </dd>
                                    </dl>
                                </div>
                        </div>
                        <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab-1" data-toggle="tab">Users messages</a></li>
                                            <li class=""><a href="#tab-2" data-toggle="tab">Last activity</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="feed-activity-list">
                                        <div class="feed-element">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="img/a2.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-right">2h ago</small>
                                                <strong>Mark Johnson</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                                <small class="text-muted">Today 2:10 pm - 12.06.2014</small>
                                                <div class="well">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                                    Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                </div>
                                            </div>
                                        </div>
                                        <div class="feed-element">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="img/a3.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-right">2h ago</small>
                                                <strong>Janet Rosowski</strong> add 1 photo on <strong>Monica Smith</strong>. <br>
                                                <small class="text-muted">2 days ago at 8:30am</small>
                                            </div>
                                        </div>
                                        <div class="feed-element">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="img/a4.jpg">
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
                                        <div class="feed-element">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="img/a5.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-right">2h ago</small>
                                                <strong>Kim Smith</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                                <small class="text-muted">Yesterday 5:20 pm - 12.06.2014</small>
                                                <div class="well">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                                    Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                </div>
                                            </div>
                                        </div>
                                        <div class="feed-element">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="img/profile.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-right">23h ago</small>
                                                <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                                <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                            </div>
                                        </div>
                                        <div class="feed-element">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="img/a7.jpg">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-right">46h ago</small>
                                                <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                                <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="tab-2">

                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Title</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Comments</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <span class="label label-primary"><i class="fa fa-check"></i> Completed</span>
                                            </td>
                                            <td>
                                               Create project in webapp
                                            </td>
                                            <td>
                                               12.07.2014 10:10:1
                                            </td>
                                            <td>
                                                14.07.2014 10:16:36
                                            </td>
                                            <td>
                                            <p class="small">
                                                Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable.
                                            </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="label label-primary"><i class="fa fa-check"></i> Accepted</span>
                                            </td>
                                            <td>
                                                Various versions
                                            </td>
                                            <td>
                                                12.07.2014 10:10:1
                                            </td>
                                            <td>
                                                14.07.2014 10:16:36
                                            </td>
                                            <td>
                                                <p class="small">
                                                    Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="label label-primary"><i class="fa fa-check"></i> Sent</span>
                                            </td>
                                            <td>
                                                There are many variations
                                            </td>
                                            <td>
                                                12.07.2014 10:10:1
                                            </td>
                                            <td>
                                                14.07.2014 10:16:36
                                            </td>
                                            <td>
                                                <p class="small">
                                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="label label-primary"><i class="fa fa-check"></i> Reported</span>
                                            </td>
                                            <td>
                                                Latin words
                                            </td>
                                            <td>
                                                12.07.2014 10:10:1
                                            </td>
                                            <td>
                                                14.07.2014 10:16:36
                                            </td>
                                            <td>
                                                <p class="small">
                                                    Latin words, combined with a handful of model sentence structures
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="label label-primary"><i class="fa fa-check"></i> Accepted</span>
                                            </td>
                                            <td>
                                                The generated Lorem
                                            </td>
                                            <td>
                                                12.07.2014 10:10:1
                                            </td>
                                            <td>
                                                14.07.2014 10:16:36
                                            </td>
                                            <td>
                                                <p class="small">
                                                    The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="label label-primary"><i class="fa fa-check"></i> Sent</span>
                                            </td>
                                            <td>
                                                The first line
                                            </td>
                                            <td>
                                                12.07.2014 10:10:1
                                            </td>
                                            <td>
                                                14.07.2014 10:16:36
                                            </td>
                                            <td>
                                                <p class="small">
                                                    The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="label label-primary"><i class="fa fa-check"></i> Reported</span>
                                            </td>
                                            <td>
                                                The standard chunk
                                            </td>
                                            <td>
                                                12.07.2014 10:10:1
                                            </td>
                                            <td>
                                                14.07.2014 10:16:36
                                            </td>
                                            <td>
                                                <p class="small">
                                                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="label label-primary"><i class="fa fa-check"></i> Completed</span>
                                            </td>
                                            <td>
                                                Lorem Ipsum is that
                                            </td>
                                            <td>
                                                12.07.2014 10:10:1
                                            </td>
                                            <td>
                                                14.07.2014 10:16:36
                                            </td>
                                            <td>
                                                <p class="small">
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable.
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="label label-primary"><i class="fa fa-check"></i> Sent</span>
                                            </td>
                                            <td>
                                                Contrary to popular
                                            </td>
                                            <td>
                                                12.07.2014 10:10:1
                                            </td>
                                            <td>
                                                14.07.2014 10:16:36
                                            </td>
                                            <td>
                                                <p class="small">
                                                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical
                                                </p>
                                            </td>

                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                                </div>

                                </div>

                                </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.wrapper wrapper-content animated fadeInRight -->

@include('student.modalForm')
@endsection

@section('js_script')

<script type="text/javascript"> 
/** Highlight Sidebard **/
$('#sidemenu_student').addClass('active');
</script>

@include('student.script')

<script type="text/javascript">
    $('#studentSave').click(function() {
        setTimeout(function(){ 
            window.print();window.close(); 
        }, 2000);
    });
</script>
@endsection
