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
			@page { 
				size: portrait; letter;  
				margin: 0mm 00mm 00mm 5mm;
			}

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

		    table tr td {
		    	padding-left: .1in;
		    	padding-right: .1in;
		    }

		    .school-name {
		      font-size: 20pt;
		    }
		}
	</style>
</head>

<body class="white-bg">
	@foreach( $dataList as $data )
	<div class="wrapper wrapper-content p-xl page">
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

			<div class="col-xs-12 text-center" style="margin-top: -20px;">
				<h2>STATEMENT OF ACCOUNT</h2>
			</div>

			<div class="col-xs-12 pull-left">
				<div class="pull-left" style="padding-left: 10px;">
					<h4>Student Name : {{ $data['studentProgress']->student->fullName }}
						<span class="pull-right">SAMPLE</span>
					</h4>
					<h4 >
						Level & Section : {{ $data['studentProgress']->level }} - {{ $data['studentProgress']->section }}
					</h4>
				</div>
	        </div>

			<div class="col-xs-12 pull-left">&nbsp;</div>

			<div class="col-xs-12 ">
				<table class="table table-condensed table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">Total Fees</th>
							<th class="text-center">Total Payment</th>
							<th class="text-center">Total Balance</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">
								{{ number_format($data['studentProgress']->total_fee,2,'.',',') }}
							</td>
							<td class="text-center">
								{{ number_format($data['studentProgress']->total_payment,2,'.',',') }}
							</td>
							<td class="text-center">
								{{ number_format($data['studentProgress']->total_balance,2,'.',',') }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			

			<div class="col-xs-12 pull-left">
				<h3>Break Down :</h3>
				<table class="table table-condensed table-bordered table-striped">
					<thead>
						<tr>
							<th width="3%">#</th>
							<th class="text-center">Description</th>
							<th class="text-center">Due Date</th>
							<th class="text-center">Trans. Date</th>
							<th class="text-center">Fee</th>
							<th class="text-center">Payment</th>
							<th class="text-center">Running Balance</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$runningBalnce = 0; 
							$amountDue = 0;
						?>
						@foreach( $data['fees'] as $feeCount => $fee )
							@if( strtotime($fee->dueDate) < strtotime(date( 'Y-m-d' )) && $fee->dueDate != '' )
								<?php $amountDue += $fee->balance; ?>
							@endif
							<tr>
								<td class="text-center">{{ $feeCount + 1 }}</td>
								<td>{{ $fee->fee->fee }}</td>
								<td class="text-center">{{ ($fee->dueDate) ? date('M d,Y', strtotime($fee->dueDate)) : ''}}</td>
								<td></td>
								<td class="text-right">
									{{ number_format($fee->total , 2, '.', ',') }}
								</td>
								<td></td>
								<td class="text-right">
									{{ number_format($runningBalnce +=  $fee->total , 2, '.', ',')}}
								</td>
							</tr>

							@foreach( $fee->student_payments as $payment )
								<tr>
									<td class="text-center"></td>
									<td class="text-right"><i>Payment - {{ $payment->fee }}</i></td>
									<td></td>
									<td class="text-center">{{ date('M d,Y', strtotime($payment->payment_date)) }}</td>
									<td></td>	
									<td class="text-right">
										{{ number_format($payment->amount , 2, '.', ',') }}
									</td>
									<td class="text-right text-danger">
										<span style="@media print { color: red;  }"">
										{{ number_format($runningBalnce -=  $payment->amount , 2, '.', ',')}}
										</span>
									</td>
								</tr>
							@endforeach
						@endforeach

						<tr>
							<th class="text-center"></th>
							<th class="text-center"></th>
							<th></th>
							<th></th>
							<th class="text-right">
								{{ number_format($data['studentProgress']->total_fee , 2, '.', ',') }}
							</th>
							<th class="text-right">
								{{ number_format($data['studentProgress']->total_payment , 2, '.', ',')}}
							</th>
							<th class="text-right">
								{{ number_format($data['studentProgress']->total_balance , 2, '.', ',')}}
							</th>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td class="text-center" colspan="7">
								Amount Due As Of {{ date('F d, Y') }}
								<br>
								<strong>P {{ number_format($amountDue, 2, '.', ',') }}</strong>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			
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
       	setTimeout(function(){ window.print();window.close(); }, 10);

       	$(document).ready(function() {
       		$('#amountDue').html( {{ $amountDue }} );
       	})
    </script>

</body>

</html>


