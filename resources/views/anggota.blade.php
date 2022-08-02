@extends('layouts.backend.app')
@section('title', 'Data Anggota')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content_title', 'Data Anggota')
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
            <th>Nama Anggota</th>
            <th>NIK</th>
            <th>No HP</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Luas Lahan(Ha)</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($anggota as $p)
            <tr>
              <td>{{ $loop->iteration }}.</td>
              <td>{{ $p->nama_anggota }}</td>
              <td>{{ $p->nik}}</td>
              <td>{{ $p->nohp }}</td>
              <td>{{ $p->jenis_kelamin }}</td>
              <td>{{ $p->jabatan }}</td>
              <td>{{ $p->luas_lahan }}</td>
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