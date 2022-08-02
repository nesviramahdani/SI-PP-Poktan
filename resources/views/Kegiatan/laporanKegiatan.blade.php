@extends('layouts.backend.app')
@section('title', 'Laporan Kegiatan')
@push('css')
<!-- DataTables -->
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content_title', 'Laporan Kegiatan')
@section('content')
<x-alert></x-alert>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('laporanKegiatan.exportpdf')}}" class="btn btn-danger btn-sm">Export PDF</a>
                <a href="{{ route('laporanKegiatan.exportexcel') }}" class="btn btn-success btn-sm">Export Excel</a>
            </div>
          <div class="card-header">
                  <form action="{{ route('laporan-kegiatan.filter') }}" method="GET" class="form-group" id="formFilter">
                    {{ csrf_field() }}
                  
                      <div class="row">
                    {{-- <div class="col-md-3">
                        <label for="">-Filter by Kelompok Tani</label>
                        <select name="" id="filter-kelompoktani" class="form-control select2bs4">
                            <option value="" disabled="" selected="">Pilih Kelompoktani</option>
                            @foreach($kelompoktani as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_kelompoktani }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col-md-3">
                      <label for="">-Filter by Bulan</label>
                        <select class="form-control" id="filter-bulan" name="month">
                            <option value="0" selected disabled> Pilih Bulan</option>
                            <option value="01"> Januari</option>
                            <option value="02"> Februari</option>
                            <option value="03"> Maret</option>
                            <option value="04"> April</option>
                            <option value="05"> Mei</option>
                            <option value="06"> Juni</option>
                            <option value="07"> Juli</option>
                            <option value="08"> Agustus</option>
                            <option value="09"> September</option>
                            <option value="10"> Oktober</option>
                            <option value="11"> November</option>
                            <option value="12"> Desember</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                      <label for="">-Filter by Tahun</label>
                        <select  class="form-control" id="filter-tahun" name="year">
                            <option value="0" selected disabled> Pilih Tahun</option>
                            <?php 
                                $year = date('Y');
                                $min = $year - 60;
                                $max = $year;
                                for( $i=$max; $i>=$min; $i-- ) {
                                echo '<option value='.$i.'>'.$i.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2"> <label for="" >-Filter-</label><button class="btn btn-info btn-block" type="submit" form="formFilter" value="Submit">Cari Data</button></div>
                  </div>
           
                </form>
                
                   
                  </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th>Nama Penyuluh</th>
                            <th scope="col">Nama Kelompok Tani</th>
                            <th scope="col">Nama Kegiatan</th>
                            <th scope="col">Tanggal Kegiatan</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporanKegiatan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $p->kelompoktani->wkpp->penyuluh->nama_penyuluh }}</td>
                            <td>{{ $p->kelompoktani->nama_kelompoktani}}</td>
                            <td>{{ $p->kegiatan->nama_kegiatan }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->kegiatan->tanggal_kegiatan)->format('d F Y')}}</td>
                            <td>{{ $p->kegiatan->jam_mulai }}-{{ $p->kegiatan->jam_selesai }}</td>
                            <td>{{ $p->kegiatan->lokasi }}</td>
                            <td><label
                                    class="label {{ ($p->status == 0) ? 'badge badge-warning' : 'badge badge-success' }}">{{ ($p->status == 0) ? 'Belum Terlaksana' : 'Terlaksana' }}</label>
                            </td>
                            <td><a href="{{ route('laporan-kegiatan.tampil', $p->id) }}"
                                    class="btn btn-primary btn-sm">Lihat</a></td>
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
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
</script>
<script
    src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js">
</script>
<script
    src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
</script>
<script>
    $(function () {
        $("#dataTable1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
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
