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
      <div class="card-header">
        <label for="">Cetak Rencana Kegiatan</label>
        <form method="POST" action="#">
            @csrf
            <div class="row">
                <div class="col-3">
                    <input type="date" name="tanggal_mulai" required="" class="form-control" id="tanggal_mulai"
                        placeholder="Dari">
                </div>
                <div class="col-3">
                    <input type="date" name="tanggal_selesai" required="" class="form-control"
                        id="tanggal_selesai" placeholder="Sampai">
                </div>
                <div class="col-3">
                    <a href=""
                        onclick="this.href='/kelompoktani/cetak-rencana-kegiatan/' + document.getElementById('tanggal_mulai').value + '/'+ document.getElementById('tanggal_selesai').value"
                        target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-print fa-fw"></i>
                        PRINT</a>
                </div>
            </div>
        </form>
    </div>
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



