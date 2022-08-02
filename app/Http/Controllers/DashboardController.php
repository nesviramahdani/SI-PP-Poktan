<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $anggota_laki_laki = DB::table('anggota')->where('jenis_kelamin', 'Laki-laki')->count();
        $anggota_perempuan = DB::table('anggota')->where('jenis_kelamin', 'Perempuan')->count();
        $jumlah_produksi = DB::table('produksi')->sum('jumlah_produksi');

    	return view('admin.dashboard', [
    		'total_anggota' => DB::table('anggota')->count(),
    		'total_kelompoktani' => DB::table('kelompoktani')->count(),
    		'total_penyuluh' => DB::table('penyuluh')->count(),
            'anggota_laki_laki' => $anggota_laki_laki,
            'anggota_perempuan' => $anggota_perempuan,
            'jumlah_produksi' => $jumlah_produksi,
    	]);
    }
}
