@extends('layouts.backend.app')
@section('title', 'Data Produksi')
@push('css')
<!-- DataTables -->
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Sweetalert 2 -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.css">
@endpush
@section('content_title', 'Data Produksi')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('exportpdf')}}" class="btn btn-danger btn-sm">Export PDF</a>
                <a href="{{ route('exportexcel') }}" class="btn btn-success btn-sm">Export Excel</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kelompok Tani</th>
                    <th scope="col">Komoditas</th>
                    <th scope="col">Jumlah Produksi(ton)</th>
                    <th scope="col">Luas Lahan(Ha)</th>
                    <th scope="col">Tanggal Produksi</th>
                  
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
      searchable: true,
      ajax: "{{ route('produksi.dataproduksi') }}",
      columns: [
          {data: 'DT_RowIndex' , name: 'id'},
          {data: 'kelompoktani.nama_kelompoktani', name: 'kelompoktani.nama_kelompoktani'},
          {data: 'komoditas.nama_komoditas', name: 'komoditas.nama_komoditas'},
          {data: 'jumlah_produksi', name: 'jumlah_produksi'},
          {data: 'luas_tanam', name: 'luas_tanam'},
          {data: 'tanggal_produksi', name: 'tanggal_produksi'},
      ]
  });

});
</script>
@endpush