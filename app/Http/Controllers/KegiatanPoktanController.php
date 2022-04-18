<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\kegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DataTables;
use PDF;

class SiswaController extends Controller
{
    public function jadwalKegiatan()
    {
        $kegiatan = kegiatan::all();

        return view('kelompok-tani.jadwal-kegiatan', compact('kegiatan'));
    }

    
}
