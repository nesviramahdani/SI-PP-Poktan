<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/dist/img/logo-pertanian.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIMO-POKTAN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="my-auto ml-3">
                <i class="nav-icon fas fa-user-circle fa-2x text-light"></i>
            </div>
            <div class="info">
                <a href="javascript:void(0)" class="d-block">{{ Auth::user()->username }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @role('admin')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kelompok-tani.index') }}"
                                class="nav-link {{ Request::segment(2) == 'kelompok-tani' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Kelompok Tani
                                </p>
                            </a>
                        </li>
                        @role('admin|penyuluh')
                        <li class="nav-item">
                            <a href="{{ route('anggota.index') }}"
                                class="nav-link {{ Request::segment(2) == 'anggota' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-school"></i>
                                <p>
                                    Anggota
                                </p>
                            </a>
                        </li>
                        @endrole
                        <li class="nav-item">
                            <a href="{{ route('wkpp.index') }}"
                                class="nav-link {{ Request::segment(2) == 'wkpp' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    WKPP
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penyuluh.index') }}"
                                class="nav-link {{ Request::segment(2) == 'penyuluh' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Penyuluh
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bpp.index') }}"
                                class="nav-link {{ Request::segment(2) == 'bpp' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    BPP
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('komoditas.index') }}"
                                class="nav-link {{ Request::segment(2) == 'komoditas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Komoditas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-list.index') }}"
                                class="nav-link {{ Request::segment(2) == 'admin-list' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Admin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}"
                                class="nav-link {{ Request::segment(2) == 'user' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Kegiatan Poktan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kegiatan.laporanKegiatan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan-kegiatan.periode') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cetak Laporan</p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item">
                  <a href="{{ route('pengajuan.datapengajuan') }}" class="nav-link">
                    <i class="nav-icon fas fa-inbox"></i>
                    <p>
                      Pengajuan Bantuan
                      <?php 
                            $notifikasi_pengajuan = App\Models\Notifikasi::where('tipe', 1)->where('user_id', Auth::user()->id)->where('status', 2)->get();
                        ?>
                        @if($notifikasi_pengajuan->count() > 0)
                      <span class="right badge badge-danger">{{ $notifikasi_pengajuan->count() }}</span>
                      @endif
                    </p>
                  </a>
                </li>
                 @role('admin|penyuluh')
                 <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Produksi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('produksi.dataproduksi') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Produksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produksi.laporan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cetak Laporan</p>
                            </a>
                        </li>
                    </ul>
                 @endrole
                @endrole

                @role('penyuluh')
                @role('admin|penyuluh')
                <li class="nav-item">
                    <a href="{{ route('anggota.index') }}"
                        class="nav-link {{ Request::segment(2) == 'anggota' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Anggota
                        </p>
                    </a>
                </li>
                @endrole
                <li class="nav-item">
                    <a href="/penyuluh/data-kelompoktani"
                        class="nav-link {{ Request::segment(2) == 'kelompoktani' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Kelompoktani
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Kegiatan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kegiatan.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Input Jadwal</p>
                            </a>
                        </li>
                        @role('admin|penyuluh')
                        <li class="nav-item">
                            <a href="{{ route('laporan-kegiatan.p_laporankegiatan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kegiatan</p>
                            </a>
                        </li>
                        @endrole
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Produksi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('produksi.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Input Produksi</p>
                            </a>
                        </li>
                        @role('admin|penyuluh')
                        <li class="nav-item">
                            <a href="{{ route('produksi.dataproduksi') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Produksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produksi.laporan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cetak Laporan</p>
                            </a>
                        </li>
                        @endrole
                    </ul>
                </li>
                @endrole

                @role('admin')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Roles-Permissions
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}"
                                class="nav-link {{ Request::segment(2) == 'roles' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Roles List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}"
                                class="nav-link {{ Request::segment(2) == 'permissions' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permission-list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('role-permission.index') }}"
                                class="nav-link {{ Request::segment(2) == 'role-permission' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role-Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user-role.index') }}"
                                class="nav-link {{ Request::segment(2) == 'user-role' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User-Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user-permission.index') }}"
                                class="nav-link {{ Request::segment(2) == 'user-permission' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    User - Permission
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

                @role('kelompoktani')
                        <li class="nav-item">
                            <a href="{{ route('kegiatan.kegiatanpetani') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jadwal Kegiatan
                                <?php 
                                    $notifikasi_jadwal = App\Models\Notifikasi::where('tipe', 2)->where('user_id', Auth::user()->id)->where('status', 1)->get();
                                ?>
                                @if($notifikasi_jadwal->count() > 1)
                              <span class="right badge badge-danger">{{ $notifikasi_jadwal->count() }}</span>
                              @endif
                                </p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('laporan-kegiatan.laporan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pengajuan.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan Bantuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pengajuan.history') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>History Pengajuan</p>
                            </a>
                        </li>
                @endrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
