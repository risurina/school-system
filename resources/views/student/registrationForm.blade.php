<html>
<head>
	<script>
		//setTimeout(function(){ window.print();window.close(); }, 10);
	</script>
<style>
	body{
		width: 8.5in;height: 11in;
	}
	
	.image-wrapper { 
		position: relative; 
	}
	
	#bg {
		width: 8.5in;height: 11in;
	}

	span {
	position: absolute;
	color: black;
	font-family: "Arial Narrow";
	font-size: 10pt;
	margin: 5px;
	left: 234px;
	top: 155px;		/*border: 1px solid black;*/
	width: 160px;
	}
	
	#sy{
		width: 6.588cm;
		font-weight: bold;
		text-align: center;
		top: 1.25in;
		left: 2.906in;
	}
	
	#syStudentID{
		width: 6.588cm;
		font-weight: bold;
		text-align: left;
		color: red;
		top: 0.677in;
		left: 6.573in;
	}
	
	#lrn{
		width: 6.588cm;
		font-weight: bold;
		text-align: left;
		color: red;
		top: 0.885in;
		left: 6.625in;
	}
	
	#enrolledDate{
	width: 3.625cm;
	font-weight: bold;
	text-align: center;
	top: 1.6in;
	left: 2.5in;
	}
	
	#level{
	width: 1.879cm;
	font-weight: bold;
	text-align: center;
	top: 2.26in;
	left: 1.688in;
	}
	
	#shift{
	width: 3.784cm;
	font-weight: bold;
	text-align: center;
	top: 2.25in;
	left: 2.979in;
	}
	
	#timings{
	width: 4.445cm;
	font-weight: bold;
	text-align: center;
	top: 2.25in;
	left: 5.625in;
	}
	
	#adviser{
	width: 5.45cm;
	font-weight: bold;
	text-align: center;
	top: 2.646in;
	left: 1.708in;
	}
	
	#lastSy{
	width: 6.191cm;
	font-weight: bold;
	text-align: center;
	top: 2.646in;
	left: 4.958in;
	}
	
	#sex{
	width: 1.799cm;
	font-weight: bold;
	text-align: center;
	top: 2.99in;
	left: 1.688in;
	}
	
	#age{
	width: 3.942cm;
	font-weight: bold;
	text-align: center;
	top: 2.99in;
	left: 2.844in;
	}
	
	#dateOfBirth{
	width: 4.604cm;
	font-weight: bold;
	text-align: center;
	top: 3in;
	left: 5.604in;
	}
	
	#mobileNo{
	width: 4.233cm;
	font-weight: bold;
	text-align: center;
	top: 3.365in;
	left: 2.427in;
	}
	
	#landline{
	width: 4.763cm;
	font-weight: bold;
	text-align: center;
	top: 3.344in;
	left: 5.583in;
	}
	
	#address{
	width: 14.499cm;
	font-weight: bold;
	text-align: center;
	top: 3.719in;
	left: 1.698in;
	}
	
	#guardianName{
	width: 8.916cm;
	font-weight: bold;
	text-align: center;
	top: 3.99in;
	left: 3.896in;
	}
	
	#guardianRelationship{
	width: 8.837cm;
	font-weight: bold;
	text-align: center;
	top: 4.313in;
	left: 3.917in;
	}
	
	#healthProblem{
	width: 8.837cm;
	font-weight: bold;
	text-align: center;
	top: 4.615in;
	left: 3.917in;
	}
	
	#cash{
	width: 0.767cm;
	font-weight: bold;
	text-align: center;
	top: 5.333in;
	left: 1.76in;
	}
	
	#installment{
	width: 0.714cm;
	font-weight: bold;
	text-align: center;
	top: 5.333in;
	left: 3.719in;
	}
	
	#f137{
	width: 0.714cm;
	font-weight: bold;
	text-align: center;
	top: 9.531in;
	left: 1.406in;
	}
	
	#f138{
	width: 0.794cm;
	font-weight: bold;
	text-align: center;
	top: 9.531in;
	left: 2.115in;
	}
	
	#gmrc{
	width: 0.767cm;
	font-weight: bold;
	text-align: center;
	top: 9.531in;
	left: 2.813in;
	}
	
	#bc{
	width: 0.688cm;
	font-weight: bold;
	text-align: center;
	top: 9.531in;
	left: 3.469in;
	}
	
	
	#last_name   {
		width: 6.588cm;
		font-weight: bold;
		text-align: left;
		top: 1.823in;
		left: 2.417in;
	}
	
	#given_name  {
		width: 6.588cm;
		font-weight: bold;	
		text-align: left;
		top: 1.823in;
		left: 4.167in;
	}	
	
	#middle_name {
		width: 6.588cm;
		font-weight: bold;
		text-align: left;
		top: 1.833in;
		left: 5.823in;
	}
	
</style>
</head>
	<body>
		<div class="image-wrapper">
		  	<img src="{{ asset('storage/school/registrationForm.png') }}" id="bg" />
			<span id="sy">
				Pupil Personal Info - SY 
				{{ $student_progress->year .'-'. ($student_progress->year + 1) }}
			</span>
			<span id="syStudentID">{{ $student_progress->student_sy_id }}</span>
			<span id="lrn">{{ $student->lrnNo }}</span> 			
			<span id="enrolledDate">{{ date('M d, Y', strtotime($student_progress->enrolledDate)) }}</span> 			
			<span id="last_name">{{ $student->lastName }}</span> 			
			<span id="given_name">{{ $student->firstName }}</span> 			
			<span id="middle_name">{{ $student->middleName }}</span>
			
			<span id="level">{{ $student_progress->level }}</span>
	
			<span id="shift">{{ $student_progress->section }}</span>

			<span id="timings">{{ $student_progress->time }}</span>

			<span id="adviser">{{ $student_progress->adviser }}</span>
			
			<span id="lastSy">{{ $student_progress->last_year_attended }}</span>
			
			<span id="sex">{{ $student->gender }}</span>
			
			<span id="age">{{ $student->currentAge }}</span>

			<span id="dateOfBirth">{{ date('M d, Y', strtotime($student->dateOfBirth)) }}</span>

			<span id="mobileNo">{{ $student_progress->mobileNo }}</span>
			<span id="landline">{{ $student_progress->landlineNo }}</span>

			<span id="address">{{ $student_progress->address }}</span>

			<span id="guardianName">{{ $student_progress->guardianName }}</span>

			<span id="guardianRelationship">{{ $student_progress->guardianRelationship }}</span>

			<span id="healthProblem">{{ $student_progress->healthProblem }}</span>
			
			
			<span id="cash">{{ ( $student_progress->isCash ) ? 'X' : '' }}</span>
			<span id="installment">{{ ( $student_progress->isCash ) ? '' : 'X' }}</span>

			<span id="f137"></span>
			<span id="f138"></span>
			<span id="gmrc"></span>
			<span id="bc"></span>
    	</div>
	</body>
</html>
