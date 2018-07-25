
<style type="text/css">
	.id-page {
		background: white;
		width: 297mm;
		height: 210mm;
		font-family: Arial;

	}

	.id-layout {
		width: 55.3mm;
		height: 87.15mm;
		margin-top: 90.5mm;
		border: 1px solid white;
	}

	.id-layout-first {
		margin-left: 7.4mm;
	}

	.id-layout-second {
		margin-left: 3.85mm;
	}

	.id-picture-first {
		position: absolute;
		width: 25mm;
		height: 25mm;
		margin-top: 119.0mm;
		margin-left: -55.0mm;
		border: solid black 3px;
	}

	.id-picture-second {
		position: absolute;
		width: 25mm;
		height: 25mm;
		margin-top: 119.0mm;
		margin-left: -53.8mm;
		border: solid black 3px;
	}

	.id-name-first {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 157.9mm;
		margin-left: -52.45mm;
	}

	.id-level-first {
		font-weight: bold;
		font-style: italic;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 164.3mm;
		margin-left: -52.5mm;
	}

	.id-lrn-first {
		font-weight: bold;
		font-size: 8pt;
		color: red;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 152.7mm;
		margin-left: -52.45mm;
	}

	.id-number-first {
		font-weight: bold;
		font-size: 8pt;
		color: red;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 171.8mm;
		margin-left: -52.45mm;
	}

	.id-lrn-second {
		font-weight: bold;
		font-size: 8pt;
		color: red;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 152.7mm;
		margin-left: -51.1mm;
	}

	.id-name-second {
		font-weight: bold;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 52.3mm;
		margin-top: 157.9mm;
		margin-left: -54.1mm;
	}

	.id-level-second {
		font-weight: bold;
		font-style: italic;
		font-size: 9pt;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 164.3mm;
		margin-left: -52.5mm;
	}

	.id-number-second {
		font-weight: bold;
		font-size: 8pt;
		color: red;
		text-align: center;
		position: absolute;
		width: 47.3mm;
		margin-top: 171.8mm;
		margin-left: -51.1mm;
	}

	.idback-first {
		font-size: 8pt;
		font-weight: bold;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.2mm;
		margin-top: 107mm;
		margin-left: -51.2mm;
		-webkit-print-color-adjust: exact;
	}

	.idback-second {
		font-size: 8pt;
		font-weight: bold;
		color: black;
		text-align: center;
		position: absolute;
		width: 47.2mm;
		margin-top: 107mm;
		margin-left: -52.0mm;
		-webkit-print-color-adjust: exact;
	}
</style>


@foreach( $dataList as $data )
	<div class="id-page">
		<img src="{{ URL::to('storage/SVIT-M-'.$data[0]->id_layout.'-FRONT.png') }}" class="id-layout id-layout-first">
		<img
			src="{{ url('/storage/profile/'. $data[0]->school->code . '/' . $data[0]->year_level .'/' .  $data[0]->id . '.jpg') }}"
			class="id-picture-first">

		<span class="id-lrn-first">
			{{ ($data[0]->lrn) ? 'LRN : ' . $data[0]->lrn : '' }}
		</span>

		<span class="id-name-first"  style="font-size:{{ ( strlen($data[0]->full_name) > 21 ) ? '7pt;' : '9pt;'}}">
			{{ $data[0]->full_name }}
		</span>
		<span class="id-level-first">{{ $data[0]->year_level }} </span>
		<span class="id-number-first">Student ID No. {{ $data[0]->student_id_no }}</span>

		@if(isset($data[1]))
		<img src="{{ URL::to('storage/SVIT-M-'.$data[1]->id_layout.'-FRONT.png') }}"  class="id-layout id-layout-second">
		<img
			src="{{ url('/storage/profile/'. $data[1]->school->code . '/' . $data[1]->year_level . '/' .  $data[1]->id . '.jpg') }}"
			class="id-picture-second">

		<span class="id-lrn-second">
			{{ ($data[1]->lrn) ? 'LRN : ' .  $data[1]->lrn : '' }}
		</span>

		<span class="id-name-second" style="font-size:{{ ( strlen($data[1]->full_name) > 21 ) ? '7pt;' : '9pt;'}}" >
			{{ $data[1]->full_name }}
		</span>
		<span class="id-level-second">{{ $data[1]->year_level }}</span>
		<span class="id-number-second">Student ID No. {{ $data[1]->student_id_no }}</span>

		@else

		@endif
	</div>

	<div class="id-page">
		<img src="{{ URL::to('storage/SVIT-BACK.png') }}" class="id-layout id-layout-first">
		<span class="idback-first">
			{{ $data[0]->guardian }}
			<br>
			{{ $data[0]->address }}
			<br>
			{{ $data[0]->phone_number }}
		</span>

		@if(isset($data[1]))
		<img src="{{ URL::to('storage/SVIT-BACK.png') }}"  class="id-layout id-layout-second">
		<span class="idback-second">
			{{ $data[1]->guardian }}
			<br>
			{{ $data[1]->address }}
			<br>
			{{ $data[1]->phone_number }}
		</span>

		@else

		@endif
	</div>
@endforeach


