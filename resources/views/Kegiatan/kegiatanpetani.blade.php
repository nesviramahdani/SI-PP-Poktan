@extends('layouts.backend.app')
@section('title', 'Data Kegiatan')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content_title', 'Data Kegiatan')
@section('content')
<x-alert></x-alert>
<div class="row">
  <div class="col-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <table id="dataTable2" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th>No.</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Waktu</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Laporan</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($detail as $p)
            <tr>
              <td>{{ $loop->iteration }}.</td>
              <td>{{ $p->kegiatan->nama_kegiatan }}</td>
              <td>{{ $p->kegiatan->tanggal_kegiatan }}</td>
              <td>{{ $p->kegiatan->jam_mulai }}-{{ $p->kegiatan->jam_selesai }}</td>
              <td>{{ $p->kegiatan->lokasi }}</td>
              <td><label class="label {{ ($p->status == 0) ? 'badge badge-warning' : 'badge badge-success' }}">{{ ($p->status == 0) ? 'Belum Terlaksana' : 'Terlaksana' }}</label></td>
              <td>
            	<div class="row mx-auto">
                @if($p->status ==0)
            		<a href="{{ route('laporan-kegiatan.index', $p->id) }}" class="btn btn-primary btn-sm">
                  Laporkan
                </a>
                @else
                <a href="{{ route('laporan-kegiatan.lihat', $p->id) }}" class="btn btn-primary btn-sm">Lihat</a>
                @endif
            	</div>
            </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@stop
@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $(function () {
    $("#dataTable1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    });
    $('#dataTable2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush



