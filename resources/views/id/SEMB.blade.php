
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
		width: 26.8mm;
		height: 32.5mm;
		margin-top: 92.4mm;
		margin-left: -43.6mm;
		border-radius: 10%;
		border: solid white 3px;
		transform: rotate(-90deg);
	}

	.id-picture-second {
		position: absolute;
		width: 26.8mm;
		height: 32.5mm;
		margin-top: 92.4mm;
		margin-left: -42.6mm;
		border-radius: 10%;
		border: solid white 3px;
		transform: rotate(-90deg);
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
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 51mm;
		margin-top: 145mm;
		margin-left: -40.8mm;
		transform: rotate(-90deg);
	}

	.id-level-first {
		
		font-size: 8.8pt;
		
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


	.id-name-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 51mm;
		margin-top: 145mm;
		margin-left: -40.8mm;
		transform: rotate(-90deg);
	}

	.id-level-second {
		font-size: 8.8pt;
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
		width: 66.2mm;
		margin-top: 128.6mm;
		margin-left: -72.0mm;
		-webkit-print-color-adjust: exact;
		transform: rotate(-90deg);
	}

	.idback-second {
		font-size: 8pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 66.2mm;
		margin-top: 128.6mm;
		margin-left: -70.5mm;
		-webkit-print-color-adjust: exact;
		transform: rotate(-90deg);
	}
</style>


@foreach( $dataList as $data )
	<div class="id-page">
		<img src="{{ URL::to('public/storage/SEMB-FRONT.png') }}" class="id-layout id-layout-first">
		<img 
			src="{{ url("/public/storage/profile/student/".$data[0]->year."/" . $data[0]->student_id  .".jpg") }}"
			class="id-picture-first">

			<span class="id-name-first">
				{{ strtoupper( $data[0]->student->firstName ) }}
				{{ strtoupper( ($data[0]->student->middleName) ? $data[0]->student->middleName[0].'. ' : '' )}}
				{{ strtoupper( $data[0]->student->lastName  )}}
				<br>
				<span class="id-level-first">
					{{ $data[0]->level }} 
					@if ( $data[0]->section != 'ONE') 
						- {{ $data[0]->section }}
					@endif
				</span>
			</span>
			

		@if(isset($data[1]))
		<img src="{{ URL::to('public/storage/SEMB-FRONT.png') }}"  class="id-layout id-layout-second">
		<img 
			src="{{ url("/public/storage/profile/student/".$data[1]->year."/" . $data[1]->student_id  .".jpg") }}"
			class="id-picture-second">

			<span class="id-name-second">
				{{ strtoupper( $data[1]->student->firstName  )}} 
				{{ strtoupper( ($data[1]->student->middleName) ? $data[1]->student->middleName[0].'. ' : '' )}}
				{{ strtoupper( $data[1]->student->lastName  )}}

				<br>
				<span class="id-level-second">
					{{ $data[1]->school_year_level_section->school_year_level->level->level }} 
					@if ( $data[1]->section != 'ONE') 
						- {{ $data[1]->section }}
					@endif
				</span>
			</span>

		@else
			<img src="{{ URL::to('public/storage/blank.png') }}"  class="id-layout id-layout-second">
		@endif
	</div>

	<div class="id-page">
		<img src="{{ URL::to('public/storage/SEMB-BACK.png') }}" class="id-layout id-layout-first">
		<span class="idback-first">
			{{ $data[0]->guardianName }} 
			<br>
			{{ strtoupper($data[0]->address) }}
			<br> 
			{{ ($data[0]->mobileNo) ? $data[0]->mobileNo : '' }} 
			{{ ($data[0]->landlineNo) ? ' / ' . $data[0]->landlineNo : '' }}
		</span>

		@if(isset($data[1]))
		<img src="{{ URL::to('public/storage/SEMB-BACK.png') }}"  class="id-layout id-layout-second">
		<span class="idback-second">
			{{ $data[1]->guardianName }} 
			<br>
			{{ strtoupper($data[1]->address) }} 
			<br>
			{{ ($data[1]->mobileNo) ? $data[1]->mobileNo : '' }} 
			{{ ($data[1]->landlineNo) ? ' / ' . $data[1]->landlineNo : '' }}
		</span>

		@else
			<img src="{{ URL::to('public/storage/blank.png') }}"  class="id-layout id-layout-second">
		@endif
	</div>
@endforeach


 