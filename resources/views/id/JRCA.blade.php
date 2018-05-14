
<style type="text/css">
	.id-page {
		background: white;
		width: 297mm;
		height: 210mm;
		border : solid 1px black;
	}

	.id-layout {
		width: 55.3mm; 
		height: 87.15mm;
		margin-top: 91.6mm;
	}

	.id-layout-first {
		margin-left: 9mm;
	}

	.id-layout-second {
		margin-left: 5.13mm;
	}

	.id-picture-first {
		position: absolute;
		width: 26.8mm;
		height: 31.0mm;
		margin-top: 119.7mm;
		margin-left: -33.0mm;
		border-radius: 10%;
		border: solid white 3px;
	}

	.id-picture-second {
		position: absolute;
		width: 26.8mm;
		height: 31.0mm;
		margin-top: 119.7mm;
		margin-left: -31.8mm;
		border-radius: 10%;
		border: solid white 3px;
	}

	.id-name-first {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 158.0mm;
		margin-left: -52.45mm;
	}

	.id-level-first {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 164.0mm;
		margin-left: -52.45mm;
	}

	.id-number-first {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 170.4mm;
		margin-left: -52.45mm;
	}

	.id-name-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 158.0mm;
		margin-left: -51.7mm;
	}

	.id-level-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 164.0mm;
		margin-left: -51.7mm;
	}

	.id-number-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 170.4mm;
		margin-left: -51.7mm;
	}

	.idback-first {
		font-size: 8pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 45.2mm;
		margin-top: 103mm;
		margin-left: -51.2mm;
		-webkit-print-color-adjust: exact;
	}

	.idback-second {
		font-size: 8pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 45.2mm;
		margin-top: 103mm;
		margin-left: -50.0mm;
		-webkit-print-color-adjust: exact;
	}
</style>


@foreach( $dataList as $data )
	<div class="id-page">
		<img src="{{ URL::to('public/storage/JRCA-FRONT.png') }}" class="id-layout id-layout-first">
		<img 
			src="{{ url("/public/storage/profile/student/".$data[0]->year."/" . $data[0]->student_id  .".jpg") }}"
			class="id-picture-first">
		<span class="id-name-first">
			{{ $data[0]->student->firstName }}
			{{ ($data[0]->student->middleName) ? $data[0]->student->middleName[0].'. ' : ''}}
			{{ $data[0]->student->lastName }}
		</span>
		<span class="id-level-first">{{ $data[0]->level }} </span>
		<span class="id-number-first">
			ID NO. {{ $data[0]->school_year_level_section->school_year_level->level->code }}-{{ ($data[0]->syStudentID < 100) ? 0 : ''}}{{ $data[0]->syStudentID }}-2017
		</span>

		@if(isset($data[1]))
		<img src="{{ URL::to('public/storage/JRCA-FRONT.png') }}"  class="id-layout id-layout-second">
		<img 
			src="{{ url("/public/storage/profile/student/".$data[1]->year."/" . $data[1]->student_id  .".jpg") }}"
			class="id-picture-second">
		<span class="id-name-second">
			{{ $data[1]->student->firstName }} 
			{{ ($data[1]->student->middleName) ? $data[1]->student->middleName[0].'. ' : ''}}
			{{ $data[1]->student->lastName }}
		</span>
		<span class="id-level-second">{{ $data[1]->school_year_level_section->school_year_level->level->level }}</span>
		<span class="id-number-second">
			ID NO. {{ $data[1]->school_year_level_section->school_year_level->level->code }}-{{ ($data[1]->syStudentID < 100) ? 0 : ''}}{{ $data[1]->syStudentID }}-2017
		</span>

		@else
			<img src="{{ URL::to('public/storage/blank.png') }}"  class="id-layout id-layout-second">
		@endif
	</div>

	<div class="id-page">
		<img src="{{ URL::to('public/storage/JRCA-BACK.png') }}" class="id-layout id-layout-first">
		<span class="idback-first">
			{{ $data[0]->guardianName }} 
			<br>
			{{ $data[0]->address }}
			<br> 
			{{ ($data[0]->mobileNo) ? $data[0]->mobileNo : '' }} 
		</span>

		@if(isset($data[1]))
		<img src="{{ URL::to('public/storage/JRCA-BACK.png') }}"  class="id-layout id-layout-second">
		<span class="idback-second">
			{{ $data[1]->guardianName }} 
			<br>
			{{ $data[1]->address }} 
			<br>
			{{ ($data[1]->mobileNo) ? $data[1]->mobileNo : '' }} 
		</span>

		@else
			<img src="{{ URL::to('public/storage/blank.png') }}"  class="id-layout id-layout-second">
		@endif
	</div>
@endforeach

 <script type="text/javascript">
        
       	setTimeout(function(){ 
       		window.print();
       		window.close(); 
       	}, 10);
        
    </script>


