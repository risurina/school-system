<style type="text/css">
	.id-page {
		background: white;
		width: 297mm;
		height: 210mm;
	}

	.id-layout {
		width: 55.3mm;
		height: 87.15mm;
		margin-top: 90.5mm;
	}

	.id-layout-first {
		margin-left: 7.9mm;
	}

	.id-layout-second {
		margin-left: 4.5mm;
	}

	.id-picture-first {
		position: absolute;
		width: 26mm;
		height: 26mm;
		margin-top: 127.5mm;
		margin-left: -42.5mm;
		border-radius: 10%;
		border: solid white 3px;
	}

	.id-picture-second {
		position: absolute;
		width: 26mm;
		height: 26mm;
		margin-top: 127.5mm;
		margin-left: -41.5mm;
		border-radius: 10%;
		border: solid white 3px;
	}

	.id-name-first {
		font-size: 9pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 48.2mm;
		margin-top: 156.5mm;
		margin-left: -52.7mm;
		-webkit-print-color-adjust: exact;
	}
	.id-name-first span {
		font-size: 10pt;
		font-weight: bold;
	}

	.id-level-first {
		font-weight: bold;
		font-size: 10pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 48.2mm;
		margin-top: 168.4mm;
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
		font-size: 9pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 48.2mm;
		margin-top: 156.5mm;
		margin-left: -51.7mm;
		-webkit-print-color-adjust: exact;
	}
	.id-name-second span {
		font-size: 10pt;
		font-weight: bold;
	}

	.id-level-second {
		font-weight: bold;
		font-size: 10pt;
		color: white;
		text-align: center;
		position: absolute;
		width: 48.2mm;
		margin-top: 168.4mm;
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
		<img src="{{ URL::to('storage/ALC-FRONT.png') }}" class="id-layout id-layout-first">
		<img
			src="{{ url('/storage/profile/'. $data[0]->school->code . '/' . $data[0]->year_level .'/' .  $data[0]->id . '.jpg') }}"
			class="id-picture-first">
		<span class="id-name-first">
			<span>{{ $data[0]->full_name }}</span>
			<br>
			{{ $data[0]->year_level }}{{ ($data[0]->section) ? ' -' .  $data[0]->section : '' }}
			<br>
			{{ $data[0]->adviser }}
		</span>
		<span class="id-level-first"></span>
		<span class="id-number-first"></span>

		@if(isset($data[1]))
		<img src="{{ URL::to('storage/ALC-FRONT.png') }}"  class="id-layout id-layout-second">
		<img
			src="{{ url('/storage/profile/'. $data[1]->school->code . '/' . $data[1]->year_level .'/' .  $data[1]->id . '.jpg') }}"
			class="id-picture-second">
		<span class="id-name-second">
			<span>{{ $data[1]->full_name }}</span>
			<br>
			{{ $data[1]->year_level }}{{ ($data[1]->section) ? ' -' .  $data[1]->section : '' }}
			<br>
			{{ $data[1]->adviser }}
		</span>
		@endif
	</div>
@endforeach


