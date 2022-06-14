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
@endpush
@section('content_title', 'Laporan Kegiatan')
@section('content')

<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                Isikan Data
            </div>
            <form method="POST" action="#">
                <div class="card-body">
                    <div class="form-group">
                        <label for="old_password">Nama:</label>
                        <input type="password" name="old_password" required="" id="old_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_password">No Hp:</label>
                        <input type="password" name="new_password" required="" id="new_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kelompoktani_id_create">Kelompok Tani:</label>
                        <select required="" name="kelompoktani_id" id="kelompoktani_id_create" class="form-control">
                            <option disabled="" selected="">- PILIH KELOMPOK TANI -</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelompoktani_id_create">Kelompok Tani:</label>
                        <select required="" name="kelompoktani_id" id="kelompoktani_id_create" class="form-control">
                            <option disabled="" selected="">- PILIH KELOMPOK TANI -</option>
                           
                        </select>
                    </div>
					<label for="new_password">Upload File:</label>
                    <div class="input-group">
                        <input type="file" name="new_password" required="" id="new_password" class="form-control">
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
