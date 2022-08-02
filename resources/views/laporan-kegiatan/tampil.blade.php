@extends('layouts.backend.app')
@section('title', 'Laporan Kegiatan')
@push('css')
<!-- DataTables -->
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Sweetalert 2 -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
 <!-- Ekko Lightbox -->
 <link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/ekko-lightbox/ekko-lightbox.css">
@endpush
@section('content_title', 'Laporan Kegiatan')
@section('content')
<x-alert></x-alert>


  <!-- general form elements -->
  <div class="card card-primary">
    <!-- /.card-header -->
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputBorder">Nama Kegiatan</label>
        <input type="text" class="form-control form-control-border" id="exampleInputBorder" placeholder="" name="nama_kegiatan" value="{{ $tampil->kegiatan->nama_kegiatan }}">
      </div>
      <div class="form-group">
        <label for="exampleInputBorderWidth2">Tanggal Kegiatan</label>
        <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="" name="tanggal_kegiatan" value="{{ $tampil->kegiatan->tanggal_kegiatan }}">
      </div>
      <div class="form-group">
        <label for="exampleInputBorder">Kehadiran</label>
        <input type="text" class="form-control form-control-border" id="exampleInputBorder" placeholder="" name="peserta" value="{{ $tampil->peserta }}">
      </div>
      <div class="form-group">
        <label for="exampleInputBorderWidth2">Hasil</label>
        <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="" name="hasil" value="{{ $tampil->hasil }}">
      </div>
      <div class="col-13">
        <div class="card card-primary">
          <div class="card-header">
            <h4 class="card-title">Dokumentasi</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6 row">
                {{-- <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery"> --}}

                  @foreach($tampil->foto as $foto)
                  <div class="col-sm-4">
                    <img src="{{ asset('storage/dokumentasi/'.$foto->image) }}" class="img-fluid mb-2" alt="white sample"/>
                  </div>
                  
                  @endforeach
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@stop

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
</script>
<script
    src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js">
</script>
<script
    src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
</script>
<!-- Sweetalert 2 -->
<script type="text/javascript"
    src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- Ekko Lightbox -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Filterizr-->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/filterizr/jquery.filterizr.min.js"></script>
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>
@endpush
