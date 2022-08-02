@extends('layouts.backend.app')
@section('title', 'Jadwal Kegiatan')
@push('css')
<!-- DataTables -->
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
        <h3 class="mb-0">Edit Kegiatan</h3>
      </div>
      <form action="{{ route('kegiatan.update', $detailKegiatan->id) }}" method="post">
          {{ csrf_field() }}
        <div class="form-group mb-3">
            <label>Nama Kegiatan:</label>
          <div class="input-group input-group-alternative">
            <input class="form-control" placeholder="Nama Kegiatan" type="text" name="nama_kegiatan"  value="{{ $detailKegiatan->kegiatan->nama_kegiatan }}"required>
          </div>
        </div>
        <div class="form-group mb-3">
            <label>Tanggal Kegiatan:</label>
            <div class="input-group input-group-alternative">
              <input class="form-control" placeholder="Tanggal Kegiatan" type="date" name="tanggal_kegiatan" value="{{ $detailKegiatan->kegiatan->tanggal_kegiatan }}"required>
            </div>
          </div>
          <div class="form-group mb-3">
            <label>Jam Mulai:</label>
            <div class="input-group input-group-alternative">
                <input class="form-control" placeholder="Jam Mulai" type="time" name="jam_mulai" value="{{ $detailKegiatan->kegiatan->jam_mulai }}" required>
            </div>
          </div>
          <div class="form-group mb-3">
            <label>Jam Selesai:</label>
            <div class="input-group input-group-alternative">
                <input class="form-control" placeholder="Jam Selesai" type="time" name="jam_selesai" value="{{ $detailKegiatan->kegiatan->jam_selesai }}"required>
            </div>
          </div>
          <div class="form-group mb-3">
            <label>Lokasi:</label>
            <div class="input-group input-group-alternative">
                <textarea name="lokasi" class="form-control" placeholder="Lokasi" required>{{ $detailKegiatan->kegiatan->lokasi }}</textarea>
            </div>
          </div>
          {{-- <div class="form-group select2-purple">
            <label>Kelompok Tani:</label>
            <select class="select2" name="kelompoktani_id[]" multiple="multiple" data-dropdown-css-class="select2-purple" data-placeholder="Select a Permissions" style="width: 100%;">
              @foreach($kelompoktani as $row)
                  <option selected="" value="{{ $row->id }}">{{ $row->nama_kelompoktani }}</option>  
              @endforeach
            </select>
          </div> --}}
          <a href="{{ route('kegiatan.index') }}" class="btn btn-primary">Back</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
@stop
@push('js')
<!-- Select2 -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
</script>
@endpush