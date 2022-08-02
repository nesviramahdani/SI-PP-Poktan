@extends('layouts.backend.app')
@section('title', 'Jadwal Kegiatan')
@push('css')
<!-- DataTables -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/daterangepicker/daterangepicker.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content_title', 'Jadwal Kegiatan')
@section('content')
<div class="col-xl-12 mb-12 mb-xl-12">
    <div class="card shadow p-4">
      <div class="card-header border-0 p-0 pb-3">
        <h3 class="mb-0">Laporkan Kegiatan</h3>
      </div>
      <form action="{{ route('laporan-kegiatan.store', $laporanKegiatan->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group mb-3">
            <label>Nama Kegiatan:</label>
          <div class="input-group input-group-alternative">
            <input class="form-control" placeholder="Nama Kegiatan" type="text" name="nama_kegiatan" value="{{ $laporanKegiatan->kegiatan->nama_kegiatan }}" required>
          </div>
        </div>
        <div class="form-group mb-3">
            <label>peserta:</label>
            <div class="input-group input-group-alternative">
              <input class="form-control" placeholder="Jumlah Peserta" type="number" name="peserta" required>
            </div>
          </div>
          <div class="form-group mb-3">
            <label>Hasil:</label>
            <div class="input-group input-group-alternative">
                <textarea name="hasil" class="form-control" placeholder="Hasil" required></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="status_edit">Status:</label>
            <select required="" name="status" id="status_edit" class="form-control">
                <option value="0">Tidak Terlaksana</option>
                <option value="1">Terlaksana</option>
            </select>
          </div>
          {{-- <div class="form-group">
            <label for="dokumentasi_create">Upload Dokumentasi:</label>
                    <div class="input-group">
                        <input type="text" name="dokumentasi" required="" id="dokumentasi_create" class="form-control">
                    </div>
          </div> --}}
          {{-- <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="dokumentasi" required="" id="exampleInputFile" class="custom-file-input">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div> --}}
          <div class="input-group control-group increment" >
            <input type="file" name="dokumentasi[]" class="form-control">
            <div class="input-group-btn"> 
              <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
            </div>
          </div>
          <div class="clone hide">
            <div class="control-group input-group" style="margin-top:10px">
              <input type="file" name="dokumentasi[]" class="form-control">
              <div class="input-group-btn"> 
                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
              </div>
            </div>
          </div>
          <br>
          <a href="#" class="btn btn-primary">Back</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
@stop

@push('js')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".btn-success").click(function(){ 
        var html = $(".clone").html();
        $(".increment").after(html);
    });
    $("body").on("click",".btn-danger",function(){ 
        $(this).parents(".control-group").remove();
    });
  });
</script>
@endpush

