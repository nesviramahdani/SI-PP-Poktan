<?php

namespace App\Http\Controllers;

use App\Models\Detailkegiatan;
use App\Models\Kelompoktani;
use App\Models\Pengajuan;
use App\Models\Produksi;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        $kelompoktani = Kelompoktani::all();
        return view ('monitoring.index', compact('kelompoktani'));
    }

    public function show($id)
    {
       $kelompoktani = Kelompoktani::find($id);
       $detail = Detailkegiatan::where('kelompoktani_id', $kelompoktani->id)->get();
       $bantuan = Pengajuan::where('kelompoktani_id', $kelompoktani->id)->get();
       $produksi = Produksi::where('kelompoktani_id', $kelompoktani->id)->get();
        return view ('monitoring.show', compact('kelompoktani', 'detail', 'bantuan', 'produksi'));
    }
}
