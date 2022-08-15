@extends('layouts.backend.app')
@section('title', 'Laporan')
@section('content_title', 'Laporan Kegiatan')
@section('content')
<x-alert></x-alert>

<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">Laporan Kegiatan</div>
			<div class="card-body">
				<form method="POST" action="#">
					@csrf
					{{-- <div class="form-group">
                        <label for="nama_kelompoktani">Kelompok Tani</label>
                        <select required="" name="nama_kelompoktani" id="nama_kelompoktani" class="form-control">
							<option value="">--Pilih Kelompok Tani--</option>
                            @foreach($kelompoktani as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_kelompoktani }}</option>
                            @endforeach
                        </select>
                    </div> --}}
					<div class="form-group">
						<label for="tanggal_mulai">Tanggal Mulai</label>
						<input type="date" name="tanggal_mulai" required="" class="form-control" id="tanggal_mulai">
					</div>
					<div class="form-group">
						<label for="tanggal_selesai">Tanggal Selesai</label>
						<input type="date" name="tanggal_selesai" required="" class="form-control" id="tanggal_selesai">
					</div>
					<div class="form-group">
						<a href="" onclick= "this.href='/admin/laporanKegiatan-cetaklaporan/' + document.getElementById('tanggal_mulai').value + '/'+ document.getElementById('tanggal_selesai').value" target="_blank"   class="btn btn-danger btn-sm"><i class="fas fa-print fa-fw"></i> PRINT</a>
						
					</div>
				</form>
			</div>
		</div>
	</div>	
</div>
@endsection

<!-- @push('js')
<script>
	$(document).on("click", "#preview", function(){
		var tanggal_mulai = $("#tanggal_mulai").val()
		var tanggal_selesai = $("#tanggal_selesai").val()

		$.ajax({
			url: "/produksi/laporan/preview-pdf",
			method: "GET",
			data: {
				tanggal_mulai: tanggal_mulai,
				tanggal_selesai: tanggal_selesai,
			},
			success:function(){
				window.open('/produksi/laporan/preview-pdf')
			}
		})
	})
</script>
@endpush -->