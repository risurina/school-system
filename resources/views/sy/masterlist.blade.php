<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIS | Master List</title>

    <link href="{{ URL::to( 'assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to( 'assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ URL::to( 'assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::to( 'assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::to( 'assets/css/style-media-print.css') }}" rel="stylesheet">
	
	<style type="text/css">
		body {
			width: 8.5in;
		}

		@media print {
			body {
				width: 8.25in;
			}
		    .center-header {
				position: absolute;
			    top:0;
			    bottom: 0;
			    left: 0;
			    right: 0;
			    margin: auto;
		    }

		    .school-name {
		      font-size: 20pt;
		    }
		}
	</style>
</head>

<body class="white-bg">
	@foreach($dataList as $list)
		@foreach($list['sections'] as $section)

	    <div class="wrapper wrapper-content p-xl page"  >
		    <div class="row" >
		        <div class="col-xs-12 pull-left">
		        	<img alt="image" src="{{ URL::to('public/storage/school/logo.png') }}" 
	        			style="width: 50px; height: 50px;"
	        			class="pull-left" />
					
					<div class="pull-left" style="padding-left: 10px;">
						<span class="school-name">{{ $school->name }}</span>
			            <address> {{ $school->address }} </address>
					</div>
		        </div>
				
				<div class="col-xs-12 pull-left">&nbsp;</div>

		        <div class="col-xs-12 pull-left">
					<div class="pull-left" style="padding-left: 10px;">
						<h4 >Level & Section : {{ $list['level'] }} - {{ $section->section }}</h4>
						<h4 >Adviser : {{ $section->adviser }}</h4>
			            <h4 >Schedule : {{ $section->schedule_time }}</h4>
					</div>
		        </div>

		        <div class="col-xs-12 pull-left">&nbsp;</div>
		    </div>
			

		    <div class="row" id="pdf">
		    	<div class="col-xs-6">
			        <table class="table  table-condensed">
			            <thead>
				            <tr>
				                <th colspan="2">Boys</th>
				            </tr>
			            </thead>
			            <tbody>
			            	<?php $bCount = 1; ?>
			            	@foreach($section->student_progresses as $student)
				            	@if($student->student->sex == 'M')
					            <tr>
					                <td>{{ $bCount }}.</td>
					                <td>{{ $student->student->fullName }}</td>
					            </tr>
					            <?php $bCount++ ?>
					            @endif
				            @endforeach
			            </tbody>
			        </table>
			    </div>

			    <div class="col-xs-6">
			        <table class="table  table-condensed">
			            <thead>
				            <tr>
				                <th colspan="2">Girls</th>
				            </tr>
			            </thead>
			            <tbody>
			            	<?php $gCount = 1; ?>
			            	@foreach($section->student_progresses as $student)
				            	@if($student->student->sex == 'F')
					            <tr>
					                <td>{{ $gCount }}.</td>
					                <td>
					                	{{ $student->student->fullName }}
					                </td>
					            </tr>
					            <?php $gCount++ ?>
					            @endif
				            @endforeach
			            </tbody>
			        </table>
			    </div>
		    </div><!-- /row -->

	    </div>
		@endforeach
    @endforeach

    <!-- Mainly scripts -->
    <script src="{{ URL::to( 'assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ URL::to( 'assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to( 'assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
	
	<!-- JS PDF -->
	<script src="{{ URL::to( 'assets/js/plugins/jspdf/jspdf.js') }}"></script>
	<script src="{{ URL::to( 'assets/js/plugins/jspdf/html2pdf.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ URL::to( 'assets/js/inspinia.js') }}"></script>

    <script type="text/javascript">
       	setTimeout(function(){ window.print();window.close(); }, 10);
    </script>

</body>

</html>


