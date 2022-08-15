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



<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{ $kelompoktani->nama_kelompoktani }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-book mr-1"></i> Tanggal Terbentuk</strong>
               <p>{{ $kelompoktani->tanggal_terbentuk }}</p>

            

              <strong><i class="fas fa-map-marker-alt mr-1">Sekretariat</i></strong>

              <p>{{ $kelompoktani->alamat_sekretariat }}</p>


              <strong><i class="fas fa-pencil-alt mr-1"></i>WKPP</strong>

              <p >{{  $kelompoktani->wkpp->nama_wkpp }}</p>


              <strong><i class="far fa-file-alt mr-1"></i>BPP</strong>

              <p>{{ $kelompoktani->wkpp->penyuluh->bpp->nama_bpp}}</p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Rencana Kegiatan</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Laporan Kegiatan</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Produksi</a></li>
                <li class="nav-item"><a class="nav-link" href="#pengajuan" data-toggle="tab">Pengajuan Bantuan</a></li>

              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>No.</th>
                          <th>Nama Kegiatan</th>
                          <th>Tanggal Kegiatan</th>
                          <th>Waktu</th>
                          <th>Lokasi</th>
                          <th>Status</th>
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
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                  <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kegiatan</th>
                      <th>Tanggal Kegiatan</th>
                      <th>Peserta</th>
                      <th>Hasil</th>
                      <th>Status</th>
                      <th>Dokumentasi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($detail as $p)
                      <tr>
                        @if($p->status != 0)
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $p->kegiatan->nama_kegiatan }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->kegiatan->tanggal_kegiatan)->format('l, d F Y')}}</td>
                        <td>{{ $p->peserta }}</td>
                        <td>{{ $p->hasil }}</td>
                        <td><label class="label {{ ($p->status == 0) ? 'badge badge-warning' : 'badge badge-success' }}">{{ ($p->status == 0) ? 'Belum Terlaksana' : 'Terlaksana' }}</label></td>
                        <td>
                          <a href="{{ route('laporan-kegiatan.lihat', $p->id) }}" class="btn btn-primary btn-sm">Lihat</a>
                        </td>
                        @endif
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                  <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Komoditas</th>
                      <th scope="col">Jumlah Produksi(ton)</th>
                      <th scope="col">Luas Lahan(Ha)</th>
                      <th scope="col">Tanggal Produksi</th>   
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      @foreach($produksi as $p)
                      <td>{{ $loop->iteration }}.</td>
                      <td>{{ $p->komoditas->nama_komoditas }}</td>
                      <td>{{ $p->jumlah_produksi }}</td>
                      <td>{{ $p->luas_tanam }}</td>
                      <td>{{ $p->tanggal_produksi }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="tab-pane" id="pengajuan">
                  <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>No.</th>
                          <th>Tanggal</th>
                          <th>Proposal</th>
                          <th>Keterangan</th>
                          <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($bantuan as $p)
                      <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $p->created_at}}</td>
                        <td><a href="{{ asset('app/public/proposal/'.$p->proposal) }}" stream="">{{ $p->proposal }}</a></td>
                        <td>{{ $p->keterangan }}</td>
                        <td>
                          @if ($p->status == 0)
                          <span class="float badge bg-info">Belum Diverifikasi</span>
                          @elseif ($p->status == 1)
                          <span class="float badge bg-primary">Diverifikasi</span>
                          @elseif ($p->status == 2)
                          <span class="float badge bg-success">Diterima</span>
                          @elseif ($p->status == 3)
                          <span class="float badge bg-danger">Ditolak</span>
                          @endif
                        </td>
                      </tr>
                    @endforeach 
                    </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>


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
