@extends('layouts.backend.app')
@section('title', 'Data Kegiatan')
@push('css')
<!-- DataTables -->
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
<x-alert></x-alert>
<div class="row">
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
            <h1 class="card-title">
                {{ $lihatLaporan->kegiatan->nama_kegiatan }}
            </h1>
        </div>
        <div class="col-md-2">
            <label class="label {{ ($lihatLaporan->status == 0) ? 'badge badge-warning' : 'badge badge-success' }}">{{ ($lihatLaporan->status == 0) ? 'Belum Terlaksana' : 'Terlaksana' }}</label>
        </div>
        </div>
    </div>
        <!-- /.card-header -->
        <div class="card-body">
            <dl class="row">            
                <dt class="col-sm-4">Hari/Tanggal</dt>
                <dd class="col-sm-8">{{ \Carbon\Carbon::parse($lihatLaporan->kegiatan->tanggal_kegiatan)->format('l, d F Y')}}</dd>
                <dt class="col-sm-4">Waktu</dt>
                <dd class="col-sm-8">{{ $lihatLaporan->kegiatan->jam_mulai }}-{{ $lihatLaporan->kegiatan->jam_selesai }} WIB</dd>
                <dt class="col-sm-4">Lokasi</dt>
                <dd class="col-sm-8">{{ $lihatLaporan->kegiatan->lokasi }}</dd>
                <dt class="col-sm-4">Kehadiran</dt>
                <dd class="col-sm-8">{{ $lihatLaporan->peserta }} Orang</dd>
                <dt class="col-sm-4">Hasil</dt>
                <dd class="col-sm-8">{{ $lihatLaporan->hasil }}</dd>
                <dt class="col-sm-4">Penyuluh Lapangan</dt>
                <dd class="col-sm-8">{{ $lihatLaporan->kelompoktani->wkpp->penyuluh->nama_penyuluh }}</dd>
            </dl>
        </div>
        <!-- /.card-body -->
        <a href="{{ route('kegiatan.kegiatanpetani') }}" class="btn btn-primary btn-sm">Kembali</a>
    </div>
    <!-- /.card -->
 
</div>
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Dokumentasi
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="card-body">
                <div class="row">
                <div class="col-sm-12 row">
                    {{-- <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery"> --}}
    
                      @foreach($lihatLaporan->foto as $foto)
                      <div class="col-sm-6">
                        <img src="{{ asset('storage/dokumentasi/'.$foto->image) }}" class="img-fluid mb-2" alt="white sample"/>
                      </div>
                      
                      @endforeach
                    </a>
                  </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>
@stop
