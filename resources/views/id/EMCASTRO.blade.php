
<style type="text/css">
	.id-page {
		background: white;	
		width: 297mm;
		height: 210mm;	}

	.id-layout {
		width: 55.3mm; 
		height: 87.15mm;
		margin-top: 91.6mm;
	}

	.id-layout-first {
		margin-left: 10mm;
	}

	.id-layout-second {
		margin-left: 4.13mm;
	}

	.id-picture-first {
		position: absolute;
		width: 26.2mm;
		height: 31.0mm;
		margin-top: 117.2mm;
		margin-left: -54.1mm;
		border-radius: 10%;
		border: solid white 3px;
	}

	.id-picture-second {
		position: absolute;
		width: 26.2mm;
		height: 31.0mm;
		margin-top: 117.2mm;
		margin-left: -52.8mm;
		border-radius: 10%;
		border: solid white 3px;
	}

	.id-idNum-first {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 18.6mm;
		margin-top: 143.5mm;
		margin-left: -24mm;
	}
	.id-idNum-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 18.6mm;
		margin-top: 143.5mm;
		margin-left: -23mm;
	}


	.id-name-first {
		font-weight: bold;
		font-size: 8.8pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 50.3mm;
		margin-top: 154.7mm;
		margin-left: -54.3mm;
	}

	.id-level-first {
		font-weight: bold;
		font-size: 8.8pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 50.3mm;
		margin-top: 161.7mm;
		margin-left: -54.3mm;
	}

	.id-lrn-first {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 50.3mm;
		margin-top: 168.9mm;
		margin-left: -54.3mm;
	}

	.id-name-first {
		font-weight: bold;
		font-size: 8.8pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 50.3mm;
		margin-top: 154.7mm;
		margin-left: -54.3mm;
	}

	.id-name-second {
		font-weight: bold;
		font-size: 8.8pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 50.3mm;
		margin-top: 154.6mm;
		margin-left: -53.0mm;
	}

	.id-level-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 50.3mm;
		margin-top: 161.6mm;
		margin-left: -53.0mm;
	}

	.id-lrn-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 50.3mm;
		margin-top: 168.9mm;
		margin-left: -53.0mm;
	}

	.id-adviser-first {
		font-weight: bold;
		font-size: 8pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 50.3mm;
		margin-top: 173.7mm;
		margin-left: -54.3mm;
	}

	.id-adviser-second {
		font-weight: bold;
		font-size: 8pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 50.3mm;
		margin-top: 173.7mm;
		margin-left: -53.0mm;
	}

	.idback-first {
		font-size: 8pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 45.2mm;
		margin-top: 102mm;
		margin-left: -51.2mm;
		-webkit-print-color-adjust: exact;
	}

	.idback-second {
		font-size: 8pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 45.2mm;
		margin-top: 102mm;
		margin-left: -50.0mm;
		-webkit-print-color-adjust: exact;
	}
</style>


@foreach( $dataList as $data )
	<div class="id-page">
		<img src="{{ URL::to('public/storage/EMCASTRO-FRONT.png') }}" class="id-layout id-layout-first">
		<img 
			src="{{ url("/public/storage/profile/student/".$data[0]->year."/" . $data[0]->student_id  .".jpg") }}"
			class="id-picture-first">
		<span class="id-idNum-first">
			ID NO. {{ $data[0]->syStudentID }}
		</span>

		<span class="id-name-first">
			{{ $data[0]->student->firstName }}
			{{ ($data[0]->student->middleName) ? $data[0]->student->middleName[0].'. ' : ''}}
			{{ $data[0]->student->lastName }}
		</span>
		<span class="id-level-first">
			{{ $data[0]->level }} 
			@if ( $data[0]->section != 'ONE') 
				- {{ $data[0]->section }}
			@endif
		</span>
		<span class="id-lrn-first">
			@if( $data[0]->student->lrnNo )
				LRN # : {{ $data[0]->student->lrnNo }}
			@else
				{{ $data[0]->school_year_level_section->employee->firstName }} 
				{{ ($data[0]->school_year_level_section->employee->middleName) ? $data[0]->school_year_level_section->employee->middleName[0].'. ' : ''}}
				{{ $data[0]->school_year_level_section->employee->lastName }}
			@endif
		</span>

		@if( !$data[0]->student->lrnNo )
			<span class="id-adviser-first">
				ADVISER
			</span>
		@endif

		@if(isset($data[1]))
		<img src="{{ URL::to('public/storage/EMCASTRO-FRONT.png') }}"  class="id-layout id-layout-second">
		<img 
			src="{{ url("/public/storage/profile/student/".$data[1]->year."/" . $data[1]->student_id  .".jpg") }}"
			class="id-picture-second">
		<span class="id-idNum-second">
			ID NO. {{ $data[1]->syStudentID }}
		</span>
		<span class="id-name-second">
			{{ $data[1]->student->firstName }} 
			{{ ($data[1]->student->middleName) ? $data[1]->student->middleName[0].'. ' : ''}}
			{{ $data[1]->student->lastName }}
		</span>
		<span class="id-level-second">
			{{ $data[1]->school_year_level_section->school_year_level->level->level }} 
			@if ( $data[1]->section != 'ONE') 
				- {{ $data[1]->section }}
			@endif
			</span>
		<span class="id-lrn-second">
			@if( $data[1]->student->lrnNo )
				LRN # : {{ $data[1]->student->lrnNo }}
			@else
				{{ $data[1]->school_year_level_section->employee->firstName }} 
				{{ ($data[1]->school_year_level_section->employee->middleName) ? $data[1]->school_year_level_section->employee->middleName[0].'. ' : ''}}
				{{ $data[1]->school_year_level_section->employee->lastName }}
			@endif
		</span>

		@if( !$data[1]->student->lrnNo )
			<span class="id-adviser-second">
				ADVISER
			</span>
		@endif

		@else
			<img src="{{ URL::to('public/storage/blank.png') }}"  class="id-layout id-layout-second">
		@endif
	</div>

	<div class="id-page">
		<img src="{{ URL::to('public/storage/EMCASTRO-BACK.png') }}" class="id-layout id-layout-first">
		<span class="idback-first">
			{{ $data[0]->guardianName }} 
			<br>
			{{ $data[0]->address }}
			<br> 
			{{ ($data[0]->mobileNo) ? $data[0]->mobileNo : '' }} 
			{{ ($data[0]->landlineNo) ? ' / ' . $data[0]->landlineNo : '' }}
		</span>

		@if(isset($data[1]))
		<img src="{{ URL::to('public/storage/EMCASTRO-BACK.png') }}"  class="id-layout id-layout-second">
		<span class="idback-second">
			{{ $data[1]->guardianName }} 
			<br>
			{{ $data[1]->address }} 
			<br>
			{{ ($data[1]->mobileNo) ? $data[1]->mobileNo : '' }} 
			{{ ($data[1]->landlineNo) ? ' / ' . $data[1]->landlineNo : '' }}
		</span>

		@else
			<img src="{{ URL::to('public/storage/blank.png') }}"  class="id-layout id-layout-second">
		@endif
	</div>
@endforeach


 