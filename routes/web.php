<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
	return view('auth.login');
})->middleware(['guest']);
Route::middleware(['auth'])->group(function(){
	Route::get('/home', 'HomeController@index')->name('home.index');
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
});
Route::prefix('monitoring')->middleware(['auth', 'role:admin'])->group(function(){
	Route::get('monitoring/index', 'MonitoringController@index')->name('monitoring.index');
	Route::get('monitoring/show/{id}', 'MonitoringController@show')->name('monitoring.show');
});

Route::prefix('produksi')->middleware(['auth', 'role:admin|penyuluh'])->group(function(){
	Route::get('produksi-laporan', 'ProduksiController@laporan')->name('produksi.laporan');
	Route::get('produksi-cetaklaporan/{tanggal_mulai}/{tanggal_selesai}', 
	'ProduksiController@cetaklaporan')->name('produksi.cetaklaporan');
	Route::get('exportpdf', 'ProduksiController@exportpdf')->name('exportpdf');
	Route::get('exportexcel', 'ProduksiController@exportexcel')->name('exportexcel');
	Route::get('dataproduksi', 'ProduksiController@dataproduksi')
	->name('produksi.dataproduksi');
});
Route::prefix('admin')
->middleware(['auth'])
->group(function(){
	Route::middleware(['role:admin'])->group(function(){
		Route::resource('kecamatan', 'KecamatanController');
		Route::resource('wkpp', 'WkppController');
		Route::resource('bpp', 'BppController');
		Route::resource('penyuluh', 'PenyuluhController');
		Route::resource('kelompok-tani', 'KelompoktaniController');
		Route::resource('komoditas', 'KomoditasController');
	});
	Route::middleware(['role:admin|penyuluh'])->group(function(){
	Route::resource('anggota', 'AnggotaController');
	Route::get('tampil-laporan/{id}', 'LaporanKegiatanController@tampil')->name('laporan-kegiatan.tampil');	
	Route::get('laporanKegiatan/filter', 'LaporanKegiatanController@filter')
	->name('laporan-kegiatan.filter');
	});
	//menampilkan seluruh kegiatan kelompoktani
	Route::get('laporanKegiatan', 'KegiatanController@laporanKegiatan')->name('kegiatan.laporanKegiatan');
	//cetak laporan kegiatan perkelompoktani
	Route::get('laporanKegiatan-laporan-perkelompoktani', 'LaporanKegiatanController@show')
	->name('laporan-kegiatan.show');
	Route::get('cetak-kegiatan', 'LaporanKegiatanController@print')
	->name('kegiatan.print');
	//mencetak laporan kegiatan per periode
	Route::get('laporanKegiatan-laporan', 'LaporanKegiatanController@periode')
	->name('laporan-kegiatan.periode');
	Route::get('laporanKegiatan-cetaklaporan/{tanggal_mulai}/{tanggal_selesai}', 
	'LaporanKegiatanController@cetaklaporan')->name('laporan-kegiatan.cetaklaporan');
	//export pdf
	Route::get('laporanKegiatan-exportpdf', 'LaporanKegiatanController@exportpdf')
	->name('laporanKegiatan.exportpdf');
	//export excel
	Route::get('laporanKegiatan-exportexcel', 'LaporanKegiatanController@exportexcel')
	->name('laporanKegiatan.exportexcel');

	//PENGAJUAN BANTUAN
	Route::get('pengajuan-bantuan', 'PengajuanController@datapengajuan')
	->name('pengajuan.datapengajuan');
	Route::post('/pengajuan-bantuan/hapus/{id}', 'PengajuanController@hapus')->name('pengajuan.hapus');
	Route::get('pengajuan-bantuan/{id}/download', 'PengajuanController@download')->name('pengajuan.download');
	Route::get('/pengajuan/edit/{id}', 'PengajuanController@edit')->name('pengajuan.edit');
	Route::post('/pengajuan/update/{id}', 'PengajuanController@update')->name('pengajuan.update');
	Route::post('/pengajuan/status', 'PengajuanController@status')->name('pengajuan.status');
});


Route::prefix('penyuluh')
->middleware(['auth', 'role:penyuluh'])
->group(function(){

	Route::get('anggotas', 'AnggotaController@dataanggota')->name('anggotas.dataanggota');
	Route::resource('produksi', 'ProduksiController');	
	//membuat jadwal Kegiatan
	Route::get('/kegiatan', 'KegiatanController@index')->name('kegiatan.index');
	Route::get('/kegiatan/tambah', 'KegiatanController@create')->name('kegiatan.create');
	Route::post('/kegiatan/store', 'KegiatanController@store')->name('kegiatan.store');
	Route::get('/kegiatan/ubah/{id}', 'KegiatanController@edit')->name('kegiatan.edit');
	Route::post('/kegiatan/update/{id}', 'KegiatanController@update')->name('kegiatan.update');
	Route::post('/kegiatan/hapus/{id}', 'KegiatanController@destroy')->name('kegiatan.destroy');
	//mencetak jadwal rencana kegiatan berdasarkan periode
	Route::get('kegiatan-cetakKegiatan/{tanggal_mulai}/{tanggal_selesai}', 'KegiatanController@cetakKegiatan')->name('kegiatan.cetakKegiatan');	
	//melihat laporan kegiatan kelompoktani 
	Route::get('laporan-kegiatan', 'LaporanKegiatanController@p_laporankegiatan')->name('laporan-kegiatan.p_laporankegiatan');
	//mencetak laporan kegiatan kelompoktani berdasarkan periode
	Route::get('laporan-kegiatan/{tanggal_mulai}/{tanggal_selesai}', 'LaporanKegiatanController@p_cetaklaporan_kegiatan')->name('laporan-kegiatan.p_cetaklaporan_kegiatan');
	//melihat data kelompok tani bimbingannya
	Route::get('data-kelompoktani', 'KelompoktaniController@datakelompoktani')->name('kelompoktani. datakelompoktani');
});

Route::prefix('kelompoktani')
->middleware(['auth', 'role:kelompoktani'])
->group(function(){

Route::get('/anggota', 'AnggotaController@anggota')->name('anggota.anggota');

//Pengajuan Bantuan
	//input pengajuan bantuan
	Route::get('/pengajuan', 'PengajuanController@index')->name('pengajuan.index');
	Route::post('/pengajuan', 'PengajuanController@store')->name('pengajuan.store');
	//lihat status pengajuan bantuan
	Route::get('/pengajuan/history', 'PengajuanController@history')->name('pengajuan.history');
	Route::post('/pengajuan-bantuan/destroy/{id}', 'PengajuanController@destroy')->name('pengajuan.destroy');

//Kegiatan
	//lihat jadwal kegiatan
	Route::get('/Kegiatan', 'KegiatanController@kegiatanpetani')->name('kegiatan.kegiatanpetani');
		//mencetak jadwal rencana kegiatan berdasarkan periode
		Route::get('cetak-rencana-kegiatan/{tanggal_mulai}/{tanggal_selesai}', 'KegiatanController@rencanakegiatan')->name('kegiatan.rencanakegiatan');	
	//input laporan kegiatan
	Route::get('/kegiatan/laporkan/{id}', 'LaporanKegiatanController@index')->name('laporan-kegiatan.index');
	Route::post('/kegiatan/laporan/{id}', 'LaporanKegiatanController@store')->name('laporan-kegiatan.store');
	//lihat laporan kegiatan
	Route::get('/LaporanKegiatan', 'LaporanKegiatanController@laporan')->name('laporan-kegiatan.laporan');
	
});

Route::get('/LaporanKegiatan/lihat/{id}', 'LaporanKegiatanController@lihat')->name('laporan-kegiatan.lihat');

Route::prefix('profile')
->name('profile.')
->middleware(['auth'])
->group(function(){
	Route::get('/', 'ProfileController@index')->name('index');
	Route::patch('/', 'ProfileController@update')->name('update');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function(){
	Route::get('admin-list', 'AdminListController@index')->name('admin-list.index');
		Route::get('admin-list/create', 'AdminListController@create')->name('admin-list.create');
		Route::post('admin-list', 'AdminListController@store')->name('admin-list.store');
		Route::get('admin-list/{id}/edit', 'AdminListController@edit')->name('admin-list.edit');
		Route::patch('admin-list/{id}', 'AdminListController@update')->name('admin-list.update');
		Route::delete('admin-list/{id}', 'AdminListController@destroy')->name('admin-list.destroy');
		Route::resource('user', 'UserController');
		Route::resource('petugas', 'PetugasController');
		Route::resource('permissions', 'PermissionController');
		Route::resource('roles', 'RoleController');
		Route::get('role-permission', 'RolePermissionController@index')->name('role-permission.index');
		Route::get('role-permission/create/{id}', 'RolePermissionController@create')->name('role-permission.create');
		Route::post('role-permission/create/{id}', 'RolePermissionController@store')->name('role-permission.store');
		Route::get('user-role', 'UserRoleController@index')->name('user-role.index');
		Route::get('user-role/create/{id}', 'UserRoleController@create')->name('user-role.create');
		Route::post('user-role/create/{id}', 'UserRoleController@store')->name('user-role.store');
		Route::get('user-permission', 'UserPermissionController@index')->name('user-permission.index');
		Route::get('user-permission/create/{id}', 'UserPermissionController@create')->name('user-permission.create');
		Route::post('user-permission/create/{id}', 'UserPermissionController@store')->name('user-permission.store');
		
	
});




