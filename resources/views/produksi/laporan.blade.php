@extends('layouts.backend.app')
@section('title', 'Laporan Produksi')
@section('content_title', 'Laporan Produksi')
@section('content')
<x-alert></x-alert>

<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">Laporan Produksi</div>
			<div class="card-body">
				<form method="POST" action="#">
					@csrf
					<div class="form-group">
						<label for="tanggal_mulai">Tanggal Mulai</label>
						<input type="date" name="tanggal_mulai" required="" class="form-control" id="tanggal_mulai">
					</div>
					<div class="form-group">
						<label for="tanggal_selesai">Tanggal Selesai</label>
						<input type="date" name="tanggal_selesai" required="" class="form-control" id="tanggal_selesai">
					</div>
					<div class="form-group">
						<a href="" onclick= "this.href='/produksi/produksi-cetaklaporan/' + document.getElementById('tanggal_mulai').value + '/'+ document.getElementById('tanggal_selesai').value" target="_blank"   class="btn btn-danger btn-sm"><i class="fas fa-print fa-fw"></i> PRINT</a>
						
					</div>
				</form>
			</div>
		</div>
	</div>	
</div>
@endsection

