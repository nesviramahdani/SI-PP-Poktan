@extends('layouts.backend.app')
@section('title', 'Data Kelompoktani')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content_title', 'Data Kelompok Tani')
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
            <th>No</th>
            <th>Nama Kelompok</th>
            <th>Jumlah Anggota</th>
            <th>Luas Lahan(Ha)</th>
            <th>Kelas Kelompok</th>
            <th>Badan Hukum</th>
            <th>Penyuluh</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($kelompoktani as $p)
            <tr>
              <td>{{ $loop->iteration }}.</td>
              <td>{{ $p->nama_kelompoktani }}</td>
              <td align="center"><a href="{{ route('anggotas.dataanggota', $p->id) }}">{{ $p->anggota->count() }} </a></td>
              <td align="center">{{ $p->anggota->sum('luas_lahan') }}</td>
              <td>{{ $p->kelas_kelompok }}</td>
              <td>{{ $p->badan_hukum}}</td>
              <td>{{ $p->wkpp->penyuluh->nama_penyuluh }}</td>
              <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="{{ route('monitoring.show', $p->id) }}">
                    <i class="fas fa-folder">
                    </i>
                    View
                </a>
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