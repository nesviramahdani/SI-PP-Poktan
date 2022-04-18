@extends('layouts.backend.app')
@section('title', 'Jadwal Kegiatan')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Sweetalert 2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.css">
@endpush
@section('content_title', 'Jadwal Kegiatan')
@section('content')
<x-alert></x-alert>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">Pilih Tahun</div>
			<div class="card-body">
        		<table id="dataTable2" class="table table-bordered table-striped">
         		 <thead>
          		 <tr>
            		<th>No</th>
            		<th>Kelompok Tani</th>
            		<th>Kegiatan</th>
            		<th>Tanggal</th>
            		<th>Mulai</th>
            		<th>Selesai</th>
            		<th>Lokasi</th>
            		<th>Aksi</th>
          		</tr>
          		</thead>
          		<tbody>
          		<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				</tbody>
        	  </table>
      		</div>
		</div>
	</div>
</div>
@endsection

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Sweetalert 2 -->
<script type="text/javascript" src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
$(function () {
  var table = $("#dataTable2").DataTable({
      processing: true,
      serverSide: true,
      "responsive": true,
      ajax: "{{ route('kegiatan.index') }}",
      columns: [
          {data: 'DT_RowIndex' , name: 'id'},
          {data: 'kelompok_tani_id', name: 'kelompok_tani_id'},
          {data: 'nama_kegiatan', name: 'nama_kegiatan'},
          {data: 'tanggal_kegiatan', name: 'tanggaL_kegiatan'},
          {data: 'jam_mulai', name: 'jam_mulai'},
          {data: 'jam_selesai', name: 'jam_selesai'},
          {data: 'lokasi', name: 'lokasi'},
          {data: 'action', name: 'action', orderable: false, searchable: true},
      ]
  });
});
</script>
@endpush