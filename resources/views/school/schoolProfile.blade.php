@extends('layouts.master')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight" style="margin-top: -30px;">

	<div class="row m-b-lg m-t-lg">
    	<div class="col-md-6">
            <div class="profile-image">
                <img src="{{ URL::to('assets/img/a4.jpg') }}" 
                    class="img-circle circle-border m-b-md" alt="profile">
            </div>
            <div class="profile-info">
                <div class="">
                    <div>
                        <h2 class="no-margins">
                        	{{ $school->name }}
                        </h2>
                        <h4>Add. : <span> {{ $school->address }} </span></h4>
                        <h4>Code : <span> {{ $school->code }} </span></h4>
                        <a onClick='schoolUpdate({{ $school }})'>Edit </a>
                    </div>
                </div>
            </div><!-- /.profile-info -->
        </div>
        <!-- /.col-md-6-->

        <!--
        <div class="col-md-3">
            <table class="table small m-b-xs">
                <tbody>
                    <tr>
                        <td>
                            <strong>142</strong> Projects
                        </td>
                        <td>
                            <strong>22</strong> Followers
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>61</strong> Comments
                        </td>
                        <td>
                            <strong>54</strong> Articles
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>154</strong> Tags
                        </td>
                        <td>
                            <strong>32</strong> Friends
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        col-md-3-->

        <!--
        <div class="col-md-3">
            <small>Sales in last 24h</small>
            <h2 class="no-margins">206 480</h2>
            <div id="sparkline1"></div>
        </div>
        col-md-3-->

	</div>
	<!-- /.row m-b-lg m-t-lg -->
	
</div>
<!-- /.wrapper wrapper-content animated fadeInRight -->

@include('school.schoolModal')
@endsection

@section('js_script')

<script type="text/javascript"> 
/** Highlight Sidebard **/
$('#sidemenu_dashboard').addClass('active');
</script>

@include('school.schoolScript')
@endsection
