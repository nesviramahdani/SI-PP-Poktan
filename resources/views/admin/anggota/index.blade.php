@extends('layouts.backend.app')
@section('title', 'Data Anggota')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Sweetalert 2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content_title', 'Data Anggota')
@section('content')
<x-alert></x-alert>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
      @can('create-anggota')
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
            <th>Nama Anggota</th>
            <th>NIK</th>
            <th>Jenis Kelamin</th>
            <th>Luas Lahan</th>
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
                <label for="id_anggota">ID Anggota:</label>
                <input required="" type="text" name="id_anggota" id="id_anggota" class="form-control">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="nama_anggota">Nama Anggota</label>
                <input required="" type="text" name="nama_anggota" id="nama_anggota" class="form-control">  
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="nik">NIK:</label>
                <input required="" type="text" name="nik" id="nik" class="form-control">
              </div>
            </div>  
          </div>
          <div class="row">
          <div class="col-lg-3">
              <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select required="" name="jenis_kelamin" id="jenis_kelamin" class="form-control select2bs4">
                    <option disabled="" selected="">- PILIH JENIS KELAMIN -</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="kelompok_tani_id">Kelompok Tani:</label>
                <select required="" name="kelompok_tani_id" id="kelompok_tani_id" class="form-control select2bs4">
                  <option disabled="" selected="">- PILIH KELOMPOK TANI -</option>
                  @foreach($kelompokTani as $row)
                    <option value="{{ $row->id }}">{{ $row->nama_kelompok }}</option>
                  @endforeach
                </select>
              </div>
            </div> 
            <div class="col-lg-3">
            <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <select required="" name="jabatan" id="jabatan" class="form-control select2bs4">
                    <option disabled="" selected="">- PILIH JABATAN -</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Anggota">Anggota</option>
                </select>
              </div>
            </div> 
          </div> 
            <div class="row">
            <div class="col-lg-3">
            <div class="form-group">
                <label for="jenis_lahan">Jenis Lahan:</label>
                <select required="" name="jenis_lahan" id="jenis_lahan" class="form-control select2bs4">
                    <option disabled="" selected="">- PILIH JABATAN -</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Anggota">Anggota</option>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="luas_lahan">Luas Lahan:</label>
                <input required="" type="text" name="luas_lahan" id="luas_lahan" class="form-control">
              </div>
            </div>
            <div class="col-lg-3">
            <div class="form-group">
                <label for="jenis_usaha">Jenis Usaha:</label>
                <select required="" name="jenis_usaha" id="jenis_usaha" class="form-control select2bs4">
                    <option disabled="" selected="">- PILIH JABATAN -</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Anggota">Anggota</option>
                </select>
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="update">
      <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display: none;">
            <ul></ul>
          </div>
          <div class="row">
          <div class="col-lg-4">
              <div class="form-group">
                <label for="id_anggota_edit">ID Anggota:</label>
                <input type="hidden" name="id_edit" id="id_edit" class="form-control" readonly="">
                <input required="" type="text" name="id_anggota" readonly id="id_anggota_edit" class="form-control">
              </div>
          </div> 
          <div class="col-lg-4">
              <div class="form-group">
                <label for="nama_anggota_edit">Nama Anggota:</label>
                <input required="" type="text" name="nama_anggota" id="nama_anggota_edit" class="form-control">
              </div>
          </div> 
          <div class="col-lg-4">
              <div class="form-group">
                <label for="nik_edit">NIK:</label>
                <input type="hidden" name="id_edit" id="id_edit" class="form-control" readonly="">
                <input required="" type="text" name="nik" readonly id="nik_edit" class="form-control">
              </div>
          </div>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label for="jenis_kelamin_edit">Jenis Kelamin:</label>
                <select required="" name="jenis_kelamin" id="jenis_kelamin_edit" class="form-control">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
              </div>
            </div>
             <div class="col-lg-4">
              <div class="form-group">
                <label for="jabatan_edit">Jabatan:</label>
                <select required="" name="jabatan" id="jabatan_edit" class="form-control">
                    <option disabled="" selected="">- PILIH JABATAN -</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Sekeretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Anggota">Anggota</option>
                </select>
              </div>
            </div> 
            <div class="col-lg-4">
              <div class="form-group">
                <label for="jenis_usaha_edit">Jenis Usaha:</label>
                <select required="" name="jenis_usaha" id="jenis_usaha_edit" class="form-control">
                    <option disabled="" selected="">- PILIH JENIS USAHA -</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Sekeretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Anggota">Anggota</option>
                </select>
              </div>
            </div> 
            <div class="col-lg-4">
              <div class="form-group">
                <label for="jenis_lahan_edit">Jenis Lahan:</label>
                <select required="" name="jenis_lahan" id="jenis_lahan_edit" class="form-control">
                    <option disabled="" selected="">-JENIS LAHAN -</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Sekeretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Anggota">Anggota</option>
                </select>
              </div>
            </div> 
            <div class="col-lg-4">
              <div class="form-group">
                <label for="luas_lahan_edit">Luas Lahan:</label>
                <input required="" type="text" name="luas_lahan" id="luas_lahan_edit" class="form-control">
              </div>
          </div>
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
<!-- Select2 -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2/js/select2.full.min.js"></script>
@include('admin.anggota.ajax')
@endpush