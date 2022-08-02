@extends('layouts.backend.app')
@section('title', 'Pengajuan Bantuan')
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
@section('content_title', 'Pengajuan Bantuan')
@section('content')

<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
               <h5> Isikan Data</h5>
            </div>
            <form method="POST" action="{{ route('pengajuan.store') }}" enctype="multipart/form-data">
                
                @csrf
                <div class="card-body">
					<label for="proposal_create">Upload File Proposal:</label>
                    <div class="form-group">
                        <input type="file" name="proposal" required="" id="proposal_create" class="form-control">
                    </div>
                    <label for="keterangan_create">Keterangan:</label>
                    <div class="from-group">
                
                       <textarea name="keterangan" id="keterangan" cols="140" rows="5" placeholder="Isikan nama dan no hp yang bisa dihubungi. "></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>
                            SUBMIT
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@stop

@include('sweetalert::alert')
