@extends('layouts.backend.app')
@section('title', 'Profile')
@section('content_title', 'Profile')
@section('content')
<x-alert></x-alert>
@role('admin')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                Profil
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Kode Admin:</label>
                            <input type="" name="" value="{{ Universe::admin()->id_admin }}" readonly="" id=""
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nama Admin:</label>
                            <input type="" name="" value="{{ Universe::admin()->nama_admin }}" readonly="" id=""
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Username Login:</label>
                            <input type="" name="" value="{{ Auth::user()->username }}" readonly="" id=""
                                class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole

@role('penyuluh')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-header">
                Profil
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="username">Nama Penyuluh:</label>
                            <input type="" name="" value="{{ Universe::penyuluh()->nama_penyuluh }}" readonly="" id=""
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="username">BPP:</label>
                            <input type="" name="" value="{{ Universe::penyuluh()->bpp->nama_bpp }}" readonly="" id=""
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="username">NIP:</label>
                            <input type="" name="" value="{{ Universe::penyuluh()->nip }}" readonly="" id=""
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="username">Jabatan:</label>
                            <input type="" name="" value="{{ Universe::penyuluh()->jabatan }}" readonly="" id=""
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="username">Username Login:</label>
                            <input type="" name="" value="{{ Auth::user()->username }}" readonly="" id=""
                                class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole


@role('kelompoktani')
<div class="row">
        <div class="col-md-6">
			<div class="card">
            <div class="card-header">
                <h2>
                    {{ Universe::kelompoktani()->nama_kelompoktani }}
                </h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Kode Kelompok</dt>
                    <dd class="col-sm-8">{{ Universe::kelompoktani()->id_kelompoktani }}</dd>
                    <dt class="col-sm-4">Username Login</dt>
                    <dd class="col-sm-8">{{ Auth::user()->username }}</dd>
                    <dt class="col-sm-4">Tanggal Terbentuk</dt>
                    <dd class="col-sm-8">{{ Universe::kelompoktani()->tanggal_terbentuk }}</dd>
                    <dt class="col-sm-4">BPP</dt>
                    <dd class="col-sm-8">{{ Universe::kelompoktani()->wkpp->penyuluh->bpp->nama_bpp }}</dd>
                    <dt class="col-sm-4">WKPP</dt>
                    <dd class="col-sm-8">{{ Universe::kelompoktani()->wkpp->nama_wkpp }}</dd>
                    <dt class="col-sm-4">PPL</dt>
                    <dd class="col-sm-8">{{ Universe::kelompoktani()->wkpp->penyuluh->nama_penyuluh }}</dd>
                    <dt class="col-sm-4">Kelas Kelompok</dt>
                    <dd class="col-sm-8">{{ Universe::kelompoktani()->kelas_kelompok}}</dd>
                    <dt class="col-sm-4">Badan Hukum</dt>
                    <dd class="col-sm-8">{{ Universe::kelompoktani()->badan_hukum }}</dd>
                    <dt class="col-sm-4">Lokasi Sekretariat</dt>
                    <dd class="col-sm-8">{{ Universe::kelompoktani()->alamat_sekretariat }}</dd>
                </dl>
<a href="/kelompoktani/anggota"><button class="btn btn-primary btn-sm">Anggota</button></a>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </div>


    <!-- /.card-header -->

    <!-- /.card-body -->
</div>
@endrole


<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                Ubah Password Login
            </div>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="old_password">Password Sekarang:</label>
                        <input type="password" name="old_password" required="" id="old_password" class="form-control">
                        @error('old_password')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru:</label>
                        <input type="password" name="new_password" required="" id="new_password" class="form-control">
                        @error('new_password')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>
                            UBAH PASSWORD
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>

<div class="col-lg-7">
    <div class="callout callout-danger">
        <h5>Pemberitahuan!</h5>
        <p>Password default / Password bawaan dari WEB SIMO-POKTAN adalah : <b>password</b></p>
    </div>
</div>

</div>
@endsection

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
