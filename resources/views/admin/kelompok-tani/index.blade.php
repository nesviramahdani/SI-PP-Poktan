@extends('layouts.backend.app')
@section('title', 'Data Kelompok Tani')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Sweetalert 2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.css">
@endpush
@section('content_title', 'Data Kelompok Tani')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
      @can('create-kelompok-tani')
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
            <th>Nama Kelompok</th>
            <th>Kelas</th>
            <th>Badan Hukum</th>
            <th>Sekretariat</th>
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
  <div class="modal-dialog modal-xl" role="document">
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
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
              <label for="id_kelompok_create">ID Kelompok:</label>
              <input required type="" name="id_kelompok" id="id_kelompok_create" class="form-control">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
              <label for="nama_kelompok_create">Nama Kelompok:</label>
              <input required type="" name="nama_kelompok" id="nama_kelompok_create" class="form-control">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="username">Username:</label>
                <input required="" type="text" name="username" id="username" class="form-control">  
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                  <label for="wkpp_id">WKPP:</label>
                  <select required="" name="wkpp_id" id="wkpp_id" class="form-control select2bs4">
                    <option disabled="" selected="">- PILIH WKPP -</option>
                    @foreach($wkpp as $row)
                    <option value="{{ $row->id }}">{{ $row->nama_wkpp }}</option>
                    @endforeach
                  </select>
              </div>
            </div> 
            <div class="col-lg-3">
              <div class="form-group">
              <label for="jumlah_anggota_create">Jumlah Anggota:</label>
              <input required type="" name="jumlah_anggota" id="jumlah_anggota_create" class="form-control">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="luas_lahan">Luas Lahan:</label>
                <input required="" type="text" name="luas_lahan" id="luas_lahan" class="form-control">  
              </div>
            </div>  
          </div>
          <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                <label for="alamat_sekretariat_create">Alamat Sekretariat:</label>
                <input required type="" name="alamat_sekretariat" id="alamat_sekretariat_create" class="form-control">
                </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
              <label for="kelas_kelompok_create">Kelas Kelompok:</label>
              <input required type="" name="kelas_kelompok" id="kelas_kelompok_create" class="form-control">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
              <label for="tanggal_kelompok_create">Tanggal Terbentuk:</label>
              <input required type="date" name="tanggal_kelompok" id="tanggal_kelompok_create" class="form-control">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
              <label for="badan_hukum_create">Badan Hukum:</label>
              <input required type="" name="badan_hukum" id="badan_hukum_create" class="form-control">
              </div>
            </div>  
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
            <label for="id_kelompok_edit">ID Kelompok:</label>
            <input required type="hidden" readonly="" name="id" id="id_edit" class="form-control">
            <input type="" name="id_kelompok" readonly id="id_kelompok_edit" class="form-control">
          </div>
          <div class="form-group">
            <label for="nama_kelompok_edit">Nama Kelompok:</label>
            <input type="" name="nama_kelompok" id="nama_kelompok_edit" class="form-control">
          </div>
          <div class="form-group">
            <label for="kelas_kelompok_edit">Kelas Kelompok:</label>
            <input type="" name="kelas_kelompok" id="kelas_kelompok_edit" class="form-control">
          </div>
          <div class="form-group">
            <label for="badan_hukum_edit">Badan Hukum:</label>
            <input type="" name="badan_hukum" id="badan_hukum_edit" class="form-control">
          </div>
          <div class="form-group">
            <label for="alamat_sekretariat_edit">Alamat Sekretariat:</label>
            <input type="" name="alamat_sekretariat" id="alamat_sekretariat_edit" class="form-control">
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
@include('admin.kelompok-tani.ajax')
@endpush