@extends('layouts.backend.app')
@section('title', 'Data Komoditas')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Sweetalert 2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.css">
@endpush
@section('content_title', 'Data Komoditas')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
      @can('create-komoditas')
      	<a href="javascript:void(0)" class="btn btn-primary btn-sm" 
        data-toggle="modal" data-target="#createModal">
          <i class="fas fa-plus fa-fw"></i> Tambah Data
        </a>
      @endcan
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="dataTable2" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama Komoditas</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
          <tr>
          	<td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
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

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="store">
      <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display: none;">
            <ul></ul>
          </div>
          <div class="form-group">
            <label for="nama_komoditas_create">Nama Komoditas:</label>
            <input required type="" name="nama_komoditas" id="nama_komoditas_create" class="form-control">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save fa-fw"></i> SIMPAN
        </button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Create Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="update">
      <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display: none;">
            <ul></ul>
          </div>
          <div class="form-group">
            <label for="id_komoditas_edit">ID Komoditas:</label>
            <input required type="hidden" readonly="" name="id" id="id_edit" class="form-control">
            <input type="" name="id_komoditas" readonly id="id_komoditas_edit" class="form-control">
          </div>
          <div class="form-group">
            <label for="nama_komoditas_edit">Nama Komoditas:</label>
            <input type="" name="nama_komoditas" id="nama_komoditas_edit" class="form-control">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save fa-fw"></i> UPDATE
        </button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Modal -->

@stop

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Sweetalert 2 -->
<script type="text/javascript" src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
@include('admin.komoditas.ajax')
@endpush