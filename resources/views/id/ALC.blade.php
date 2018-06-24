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
		margin-left: 6.13mm;
	}

	.id-picture-first {
		position: absolute;
		width: 25.2mm;
		height: 28.75mm;
		margin-top: 129.7mm;
		margin-left: -41.7mm;
		border-radius: 10%;
		border: solid white 3px;
	}

	.id-picture-second {
		position: absolute;
		width: 25.2mm;
		height: 28.75mm;
		margin-top: 129.7mm;
		margin-left: -40.7mm;
		border-radius: 10%;
		border: solid white 3px;
	}

	.id-name-first {
		font-weight: bold;
		font-size: 9pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 48.2mm;
		margin-top: 161.5mm;
		margin-left: -52.7mm;
		-webkit-print-color-adjust: exact;
	}

	.id-level-first {
		font-weight: bold;
		font-size: 10pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 48.2mm;
		margin-top: 166.4mm;
		margin-left: -53.0mm;
		-webkit-print-color-adjust: exact;

	}

	.id-number-first {
		font-weight: bold;
		font-size: 9pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 55.3mm;
		margin-top: 169.8mm;
		margin-left: -52.4mm;
		-webkit-print-color-adjust: exact;
	}

	.id-name-second {
		font-weight: bold;
		font-size: 9pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 48.2mm;
		margin-top: 161.5mm;
		margin-left: -51.7mm;
		-webkit-print-color-adjust: exact;
	}

	.id-level-second {
		font-weight: bold;
		font-size: 10pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 48.2mm;
		margin-top: 166.4mm;
		margin-left: -51.9mm;
		-webkit-print-color-adjust: exact;
	}

	.id-number-second {
		font-weight: bold;
		font-size: 9pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 48.2mm;
		margin-top: 169.8mm;
		margin-left: -51.6mm;
	}

	.idback-first {
		font-size: 8pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 45.2mm;
		margin-top: 102.8mm;
		margin-left: -51.2mm;
	}

	.idback-second {
		font-size: 8pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 45.2mm;
		margin-top: 102.8mm;
		margin-left: -50.2mm;
	}
</style>


@foreach( $dataList as $data )
	<div class="id-page">
		<img src="{{ URL::to('public/storage/ALC-FRONT.png') }}" class="id-layout id-layout-first">
		<img 
			src="{{ url("/public/storage/profile/student/".$data[0]->year."/" . $data[0]->student_id  .".jpg") }}"
			class="id-picture-first">
		<span class="id-name-first">
			{{ $data[0]->student->firstName }} 
			{{ ($data[0]->student->middleName) ? $data[0]->student->middleName[0].'. ' : ''}}
			{{ $data[0]->student->lastName }}
		</span>
		<span class="id-level-first">{{ $data[0]->level }} </span>
		<span class="id-number-first"></span>

		@if(isset($data[1]))
		<img src="{{ URL::to('public/storage/ALC-FRONT.png') }}"  class="id-layout id-layout-second">
		<img 
			src="{{ url("/public/storage/profile/student/".$data[1]->year."/" . $data[1]->student_id  .".jpg") }}"
			class="id-picture-second">
		<span class="id-name-second">
			{{ $data[1]->student->firstName }} 
			{{ ($data[1]->student->middleName) ? $data[1]->student->middleName[1].'. ' : ''}}
			{{ $data[1]->student->lastName }}
		</span>
		<span class="id-level-second">{{ $data[1]->level }}</span>
		<span class="id-number-second"></span>
		@endif
	</div>
@endforeach


