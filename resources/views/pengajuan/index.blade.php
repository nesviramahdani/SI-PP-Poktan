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
                Isikan Data
            </div>
            <form method="POST" action="{{ route('pengajuan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="bantuan_id_create">Jenis Bantuan:</label>
                        <select required="" name="bantuan_id" id="bantuan_id_create" class="form-control">
                            <option disabled="" selected="">- PILIH JENIS BANTUAN -</option>
                            @foreach($bantuan as $row)
                            <option value="{{ $row->id }}">{{ $row->jenis_bantuan}}</option>
                            @endforeach
                        </select>
                    </div>
					<label for="proposal_create">Upload File:</label>
                    <div class="input-group">
                        <input type="file" name="proposal" required="" id="proposal_create" class="form-control">
                    </div>
					<br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>
                            SUBMIT
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>


</div>




@stop
