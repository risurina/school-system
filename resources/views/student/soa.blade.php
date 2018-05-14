<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIS | SOA</title>

    <link href="{{ URL::to( 'assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to( 'assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ URL::to( 'assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::to( 'assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::to( 'assets/css/style-media-print.css') }}" rel="stylesheet">
	
	<style type="text/css">
		@media print {
			@page { 
				size: landscape letter;  
				margin: 5mm 00mm 00mm 5mm;
			}

			body {
				width: 11in
				height: 8.5in;
			}

			.soa-page {
				float: left;
				width: 5.1in;
				height: 3.8in;
				border: solid 1px black;
				padding: 0.1in;
				margin: 0.1in;
	           page-break-inside:avoid; page-break-after:auto;
			}

			.soa-page .center {
				width: 40%;
			    margin: 0 auto;
		    }

		    /** Table */
		    .table-breakdown > thead > tr > th,
		    .table-breakdown > tbody > tr > th,
		    .table-breakdown > tfoot > tr > th,
		    .table-breakdown > thead > tr > td,
		    .table-breakdown > tbody > tr > td,
		    .table-breakdown > tfoot > tr > td {
		        padding: 2px;
		    }
		}
	</style>
</head>

<body>
	@foreach( $dataList as $data )
	<div class="soa-page">
		<div class="center">
			<h3>Statement Of Account</h3>
		</div>

		<table class="table table-breakdown" style="margin-bottom: -10px;">
			<tr>
				<th width="35%">As Of Month Of :</th>
				<td class="text-center">{{ $data['inquiryDate'] }}</td>
			</tr>
			<tr>
				<th>Student Name :</th>
				<td class="text-center">{{ $data['name'] }}</td>
			</tr>
			<tr>
				<th>LEVEL & SECTION :</th>
				<td class="text-center">{{ $data['levelSection'] }}</td>
			</tr>
			<tr>
				<th>TOTAL BALANCE :</th>
				<td class="text-center">{{ $data['total_balance'] }}</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		
		<span>Dear Parent / Gaurdian,</span>
		<br>
		<span>Below is a current statement of your account.</span>
		<br>
		<span>The total amount due is </span>
		<u>
		<strong class="text-danger">{{ $data['total_amount_due'] }}</strong>
		<span><i>( {{ $data['dueCount'] }} Months Tuituion Fee Balance )</i></span>
		</u>
		<span>and is payable as soon as possible.</span>
		<br>
		<span>If you should have any questions regarding the amount descrepancy.</span>
		<br>
		<span>Please don't hesitate to discuss with us.</span>
		<br>
		<br>
		<span>Thank you in advance, SAPAMI.</span>
		<br>
		
		<div class="center" style="width: 50%; margin: 0 auto;">
			<br>
			<span  class="text-danger text-center">
				{{ ($data['next_due_date']) ? 'Next due will be on ' . $data['next_due_date'] : ''}}
			</span>
		</div>
	</div>
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
       	setTimeout(function(){ 
       		window.print();
       		window.close(); 
       	}, 10);
    </script>

</body>

</html>


