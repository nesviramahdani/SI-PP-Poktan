@extends('layouts.backend.app')
@section('title', 'Data Kelompok Tani')
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
@section('content_title', 'Data Kelompok Tani')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @can('create-kelompok-tani')
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#createModal">
                    <i class="fas fa-plus fa-fw"></i> Tambah Data
                </a>
                @endcan
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Kelompok</th>
                            <th scope="col">Nama Kelompok</th>
                            <th scope="col">Kelas Kelompok</th>
                            <th scope="col">Badan Hukum</th>
                            <th scope="col">Alamat Sekre</th>
                            <th scope="col">Penyuluh</th>
                            <th scope="col">Aksi</th>
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

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="store">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display: none;">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="id_kelompoktani">Kode Kelompoktani:</label>
                                <input required="" type="text" name="id_kelompoktani" id="id_kelompoktani" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nama_kelompoktani_create">Nama Kelompok:</label>
                                <input required type="text" name="nama_kelompoktani" id="nama_kelompoktani_create"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="tanggal_terbentuk_create">Tanggal Terbentuk:</label>
                                <input required type="date" name="tanggal_terbentuk" id="tanggal_terbentuk_create"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input required="" type="text" name="username" id="username" class="form-control">
                            </div>
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="wkpp_id_create">WKPP:</label>
                                <select required="" name="wkpp_id" id="wkpp_id_create" class="form-control select2bs4">
                                    <option disabled="" selected="">- PILIH WKPP -</option>
                                    @foreach($wkpp as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_wkpp }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="kelas_kelompok_create">Kelas Kelompok:</label>
                                <select required="" name="kelas_kelompok" id="kelas_kelompok_create"
                                    class="form-control select2bs4">
                                    <option disabled="" selected="">- PILIH KELAS KELOMPOK -</option>
                                    <option value="Pemula">Pemula</option>
                                    <option value="Lanjut">Lanjut</option>
                                    <option value="Madya">Madya</option>
                                    <option value="Utama">Utama</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="badan_hukum_create">Badan Hukum:</label>
                                <select required="" name="badan_hukum" id="badan_hukum_create"
                                    class="form-control select2bs4">
                                    <option disabled="" selected="">- PILIH BADAN HUKUM -</option>
                                    <option value="Badan Hukum">Badan Hukum</option>
                                    <option value="SK Lurah">SK Lurah</option>
                                    <option value="Belum Ada">Belum Ada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="alamat_sekretariat_create">Alamat Sekre:</label>
                                <input required="" type="text" name="alamat_sekretariat" id="alamat_sekretariat_create"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save fa-fw"></i> SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Create Modal -->


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display: none;">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="id_kelompoktani_edit">ID Kelompok:</label>
                                <input required type="hidden" readonly="" name="id" id="id_edit" class="form-control">
                                <input type="" name="id_kelompoktani" readonly id="id_kelompoktani_edit"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nama_kelompoktani_edit">Nama Kelompok:</label>
                                <input type="" name="nama_kelompoktani" id="nama_kelompoktani_edit"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="tanggal_terbentuk_edit">Tanggal Terbentuk:</label>
                                <input type="" name="tanggal_terbentuk" id="tanggal_terbentuk_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="wkpp_id_edit">WKPP:</label>
                                <select required="" name="wkpp_id" id="wkpp_id_edit" class="form-control select2bs4">
                                    <option disabled="" selected="">- PILIH WKPP -</option>
                                    @foreach($wkpp as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_wkpp }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="kelas_kelompok_edit">Kelas Kelompok:</label>
                                <select required="" name="kelas_kelompok" id="kelas_kelompok_edit"
                                    class="form-control select2bs4">
                                    <option disabled="" selected="">- PILIH KELAS KELOMPOK -</option>
                                    <option value="Pemula">Pemula</option>
                                    <option value="Lanjut">Lanjut</option>
                                    <option value="Madya">Madya</option>
                                    <option value="Utama">Utama</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="badan_hukum_edit">Badan Hukum:</label>
                                <select required="" name="badan_hukum" id="badan_hukum_edit"
                                    class="form-control select2bs4">
                                    <option disabled="" selected="">- PILIH BADAN HUKUM -</option>
                                    <option value="Badan Hukum">Badan Hukum</option>
                                    <option value="SK Lurah">SK Lurah</option>
                                    <option value="Belum Ada">Belum Ada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="alamat_sekretariat_edit">Alamat Sekre:</label>
                                <input required="" type="text" name="alamat_sekretariat" id="alamat_sekretariat_edit"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save fa-fw"></i> UPDATE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal -->

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
@include('admin.kelompok-tani.ajax')
@endpush
