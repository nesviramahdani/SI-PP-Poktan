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
      <div class="card-header">
      @can('create-kegiatan')
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
                  <label for="kelompok_tani_id">Nama Kelompok Tani:</label>
                  <select required="" name="kelompok_tani_id" id="kelompok_tani_id" class="form-control select2bs4">
                    <option disabled="" selected="">- PILIH KELOMPOK TANI -</option>
                    @foreach($kelompokTani as $row)
                    <option value="{{ $row->id }}">{{ $row->nama_kelompok }}</option>
                    @endforeach
                  </select>
          </div>
          <div class="form-group">
            <label for="nama_kegiatan">Nama Kegiatan:</label>
            <input required="" type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control">
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal Kegiatan:</label>
            <input required="" type="date" name="tanggal" id="tanggal" class="form-control">
          </div> 
          <div class="form-group">
            <label for="jam_mulai">Waktu Mulai:</label>
            <input required="" type="time" name="jam_mulai" id="jam_mulai" class="form-control">
          </div>
          <div class="form-group">
            <label for="jam_selesai">Waktu Selesai:</label>
            <input required="" type="time" name="jam_selesai" id="jam_selesai" class="form-control">
          </div>
          <div class="form-group">
            <label for="lokasi">Lokasi Kegiatan:</label>
            <input required="" type="text" name="lokasi" id="lokasi" class="form-control">
          </div>               
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save fa-fw"></i> 
          SIMPAN
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
                  <label for="kelompok_tani_id_edit">Nama Kelompok Tani:</label>
                  <select required="" name="kelompok_tani_id" id="kelompok_tani_id_edit" class="form-control select2bs4">
                    <option disabled="" selected="">- PILIH KELOMPOK TANI -</option>
                    @foreach($kelompokTani as $row)
                    <option value="{{ $row->id }}">{{ $row->nama_kelompok }}</option>
                    @endforeach
                  </select>
          </div>
          <div class="form-group">
            <label for="nama_kegiatan_edit">Nama Kegiatan:</label>
            <input required="" readonly="" type="hidden" name="id" id="id_edit" class="form-control">
            <input required="" type="text" name="nama_kegiatan" id="nama_kegiatan_edit" class="form-control">
          </div>
          <div class="form-group">
            <label for="tanggal_kegiatan_edit">Tanggal Kegiatan:</label>
            <input required="" readonly="" type="hidden" name="id" id="id_edit" class="form-control">
            <input required="" type="date" name="tanggal_kegiatan" id="tanggal_kegiatan_edit" class="form-control">
          </div>
          <div class="form-group">
            <label for="jam_mulai__edit">Waktu Mulai:</label>
            <input required="" readonly="" type="hidden" name="id" id="id_edit" class="form-control">
            <input required="" type="time" name="jam_mulai" id="jam_mulai_edit" class="form-control">
          </div>
          <div class="form-group">
            <label for="jama_selesai_edit">Waktu Selesai:</label>
            <input required="" readonly="" type="hidden" name="id" id="id_edit" class="form-control">
            <input required="" type="time" name="jam_selesai" id="jam_selesai_edit" class="form-control">
          </div>
          <div class="form-group">
            <label for="lokasi_edit">Nama Kegiatan:</label>
            <input required="" readonly="" type="hidden" name="id" id="id_edit" class="form-control">
            <input required="" type="text" name="lokasi" id="lokasi_edit" class="form-control">
          </div>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save fa-fw"></i> 
          UPDATE
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
          {data: 'tanggal', name: 'tanggal'},
          {data: 'jam_mulai', name: 'jam_mulai'},
          {data: 'jam_selesai', name: 'jam_selesai'},
          {data: 'lokasi', name: 'lokasi'},
          {data: 'action', name: 'action', orderable: false, searchable: true},
      ]
  });
});


  // Reset Form
  function resetForm(){
      $("[name='nama_kegiatan']").val("")
      $("[name='tanggal']").val("")
      $("[name='jam_mulai']").val("")
      $("[name='jam_selesai']").val("")
      $("[name='lokasi']").val("")
  }
  
  // Create 
  $("#store").on("submit",function(e){
    e.preventDefault()
    $.ajax({
        url: "{{ route('kegiatan.store') }}",
        method: "POST",
        data: $(this).serialize(),
        success:function(response){
            if ($.isEmptyObject(response.error)) {
              $("#createModal").modal("hide")
              $('#dataTable2').DataTable().ajax.reload()
              Swal.fire(
                '',
                response.message,
                'success'
              )
              resetForm()
            }else{
              printErrorMsg(response.error)
            }
        }
    })
  })
  
  // create-error-validation
  function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $.each(msg, function(key, value) {
      $(".print-error-msg").find("ul").append('<li>'+value+'</li>')
    });
  }
  
  // Edit 
  $('body').on("click",".btn-edit",function(){
    var id = $(this).attr("id")

    $.ajax({
       url: "/penyuluh/"+id+"/edit",
        method: "GET",
        success:function(response){
            $("#editModal").modal("show")
            $("#id_edit").val(response.data.id)
            $("#kelompok_tani_id_edit").val(response.data.kelompok_tani_id)
            $("#nama_kegiatan_edit").val(response.data.nama_kegiatan)
            $("#jam_mulai_edit").val(response.data.jam_mulai)
            $("#jam_selesai_edit").val(response.data.jam_selesai)
            $("#lokasi_edit").val(response.data.lokasi)
        }
    })
  });

  // update
  $("#update").on("submit",function(e){
    e.preventDefault()
    var id = $("#id_edit").val()
    $.ajax({
        url: "/penyuluh/"+id,
        method: "PATCH",
        data: $(this).serialize(),
        success:function(response){
          if ($.isEmptyObject(response.error)) {
              $('#dataTable2').DataTable().ajax.reload();
              $("#editModal").modal("hide")
              Swal.fire(
                '',
                response.message,
                'success'
              )
          }else{
            printErrorMsg(response.error)
          }
        }
    })
  })
  
  // delete
  $('body').on("click",".btn-delete",function(){
    var id = $(this).attr("id")
    Swal.fire({
      title: 'Yakin hapus data ini?',
      // text: "You won't be able to revert",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "/penyuluh/"+id,
          method: "DELETE",
          success: function(response) {
            $('#dataTable2').DataTable().ajax.reload()
            Swal.fire(
              '',
              response.message,
              'success'
            )
          }
        })
      }
    })
  });
</script>
@endpush