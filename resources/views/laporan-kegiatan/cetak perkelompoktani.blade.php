@extends('layouts.backend.app')
@section('css')
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('templatesAdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('templatesAdminLTE/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('templatesAdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cetak Laporan Transaksi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Cetak Laporan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
               <form action="{{ route('laporan-kegiatan.print') }}" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cetak Laporan Transaksi
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Laporan Kegiatan Kelompok Tani : </label>
                            <select required="" name="nama_kelompoktani" id="nama_kelompoktani" class="form-control">
                                @foreach ($kelompoktani as $row)
                                        <option value="{{$row->id}}">{{$row->nama_kelompoktani}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" required="" class="form-control" id="tanggal_mulai">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" required="" class="form-control" id="tanggal_selesai">
                        </div>
                        <!-- <button type="submit" class="btn btn-primary"><i class='fas fa-eye' style='font-size:12px'></i> View</button> -->
                        <button type="submit" class="btn btn-primary"><i class='fas fa-download' style='font-size:12px'></i> View</button>

                    </div>
                </form>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</section>

@endsection
@section('script')
<!-- date-range-picker -->
<script src="{{ asset('templatesAdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('templatesAdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('templatesAdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        //Date range picker
        $('#reservation').daterangepicker()
    })
</script>
@endsection