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
});

Route::prefix('admin')
->namespace('Admin')
->middleware(['auth'])
->group(function(){
	Route::middleware(['role:admin'])->group(function(){
		Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
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

		Route::resource('kecamatan', 'KecamatanController');
		Route::resource('wkpp', 'WkppController');
		Route::resource('bpp', 'BppController');
		Route::resource('bantuan', 'BantuanController');
		Route::resource('penyuluh', 'PenyuluhController');
		Route::resource('anggota', 'AnggotaController');
		Route::resource('kelompok-tani', 'KelompoktaniController');
		Route::resource('komoditas', 'KomoditasController');

	});
});


Route::prefix('penyuluh')
->middleware(['auth', 'role:penyuluh'])
->group(function(){

	Route::resource('produksi', 'ProduksiController');	
	Route::get('produksi-laporan', 'ProduksiController@laporan')->name('produksi.laporan');
	Route::get('produksi-cetaklaporan/{tanggal_mulai}/{tanggal_selesai}', 'ProduksiController@cetaklaporan')->name('produksi.cetaklaporan');
	Route::get('exportpdf', 'ProduksiController@exportpdf')->name('exportpdf');
	Route::get('exportexcel', 'ProduksiController@exportexcel')->name('exportexcel');
	Route::get('dataproduksi', 'ProduksiController@dataproduksi')->name('produksi.dataproduksi');

	Route::resource('jadwal', 'JadwalController');	
});

Route::prefix('kelompoktani')
->middleware(['auth', 'role:kelompok tani'])
->group(function(){
	Route::get('/pengajuan', 'PengajuanController@index')->name('pengajuan.index');
	Route::post('/pengajuan', 'PengajuanController@store')->name('pengajuan.store');
	Route::get('/pengajuan/history', 'PengajuanController@history')->name('pengajuan.history');
	
	Route::get('/jadwalKegiatan', 'KegiatanController@jadwal')->name('kegiatan.jadwal');
	Route::get('/LaporanKegiatan', 'KegiatanController@laporan')->name('kegiatan.laporan');
});

Route::prefix('profile')
->name('profile.')
->middleware(['auth'])
->group(function(){
	Route::get('/', 'ProfileController@index')->name('index');
	Route::patch('/', 'ProfileController@update')->name('update');
});



