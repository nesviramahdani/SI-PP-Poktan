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
                <a href="{{ route('exportpdf') }}" class="btn btn-danger btn-sm">Export PDF</a>
                <a href="{{ route('exportexcel') }}" class="btn btn-success btn-sm">Export Excel</a>
                
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('produksi.dataproduksi') }}" method="GET" >
                    <input type="search" name="search">
                    <button type="submit">Search</button>
                </form>
                <br>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelompok Tani</th>
                            <th>Komoditas</th>
                            <th>Jumlah Produksi</th>
                            <th>Luas Lahan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    @php
                    $no=1;
                    @endphp
                    <tbody>
                        @foreach($dataproduksi as $row)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $row->kelompoktani->nama_kelompoktani }}</td>
                            <td>{{ $row->komoditas->nama_komoditas }}</td>
                            <td>{{ $row->jumlah_produksi }}</td>
                            <td>{{ $row->luas_tanam }}</td>
                            <td>{{ $row->tanggal_produksi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                {{ $dataproduksi->links() }}
            </div>
            
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@stop
