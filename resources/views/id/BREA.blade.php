
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
		width: 28mm;
		height: 28mm;
		margin-top: 119.9mm;
		margin-left: -43.5mm;
		border: solid black 2px;
	}

	.id-picture-second {
		position: absolute;
		width: 28mm;
		height: 28mm;
		margin-top: 119.9mm;
		margin-left: -42.0mm;
		border: solid black 2px;
	}

	.id-name-first {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 153.5mm;
		margin-left: -52.0mm;
	}

	.id-level-first {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 161.7mm;
		margin-left: -52.0mm;
	}

	.id-number-first {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 169.5mm;
		margin-left: -52.0mm;
	}

	.id-name-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 153.5mm;
		margin-left: -51.0mm;
	}

	.id-level-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 161.7mm;
		margin-left: -51.0mm;
	}

	.id-number-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 169.5mm;
		margin-left: -51.0mm;
	}

	.idback-first {
		font-size: 8pt;
		text-align: center;
		position: absolute;
		width: 45.2mm;
		margin-top: 101mm;
		margin-left: -51.2mm;
		-webkit-print-color-adjust: exact;
	}

	.idback-second {
		font-size: 8pt;
		text-align: center;
		position: absolute;
		width: 45.2mm;
		margin-top: 101mm;
		margin-left: -50.0mm;
		-webkit-print-color-adjust: exact;
	}
</style>


@foreach( $dataList as $data )
	<div class="id-page">
		<img src="{{ URL::to('public/storage/BREA-FRONT.png') }}" class="id-layout id-layout-first">
		<img 
			src="{{ url("/public/storage/profile/student/".$data[0]->year."/" . $data[0]->student_id  .".jpg") }}"
			class="id-picture-first">
		<span class="id-name-first">
			{{ $data[0]->student->firstName }}
			{{ ($data[0]->student->middleName) ? $data[0]->student->middleName[0].'. ' : ''}}
			{{ $data[0]->student->lastName }}
		</span>
		<span class="id-level-first">{{ $data[0]->level }}  - {{ $data[0]->section }}</span>
		<span class="id-number-first">
			@if( $data[0]->student->lrnNo )
				LRN # : {{ $data[0]->student->lrnNo }}
			@else
				{{ $data[0]->school_year_level_section->employee->firstName }} 
				{{ ($data[0]->school_year_level_section->employee->middleName) ? $data[0]->school_year_level_section->employee->middleName[0].'. ' : ''}}
				{{ $data[0]->school_year_level_section->employee->lastName }}
			@endif
		</span>

		@if(isset($data[1]))
		<img src="{{ URL::to('public/storage/BREA-FRONT.png') }}"  class="id-layout id-layout-second">
		<img 
			src="{{ url("/public/storage/profile/student/".$data[1]->year."/" . $data[1]->student_id  .".jpg") }}"
			class="id-picture-second">
		<span class="id-name-second">
			{{ $data[1]->student->firstName }} 
			{{ ($data[1]->student->middleName) ? $data[1]->student->middleName[0].'. ' : ''}}
			{{ $data[1]->student->lastName }}
		</span>
		<span class="id-level-second">
			{{ $data[1]->level }}  - {{ $data[1]->section }}
		</span>
		<span class="id-number-second">
			@if( $data[1]->student->lrnNo )
				LRN # : {{ $data[1]->student->lrnNo }}
			@else
				{{ $data[1]->school_year_level_section->employee->firstName }} 
				{{ ($data[1]->school_year_level_section->employee->middleName) ? $data[1]->school_year_level_section->employee->middleName[0].'. ' : ''}}
				{{ $data[1]->school_year_level_section->employee->lastName }}
			@endif
		</span>

		@else
			<img src="{{ URL::to('public/storage/blank.png') }}"  class="id-layout id-layout-second">
		@endif
	</div>

	<div class="id-page">
		<img src="{{ URL::to('public/storage/BREA-BACK.png') }}" class="id-layout id-layout-first">
		<span class="idback-first">
			{{ $data[0]->guardianName }} 
			<br>
			{{ $data[0]->address }}
			<br> 
			{{ ($data[0]->mobileNo) ? $data[0]->mobileNo : '' }} 
		</span>

		@if(isset($data[1]))
		<img src="{{ URL::to('public/storage/BREA-BACK.png') }}"  class="id-layout id-layout-second">
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
       		//window.print();
       		//window.close(); 
       	}, 10);
        
    </script>


