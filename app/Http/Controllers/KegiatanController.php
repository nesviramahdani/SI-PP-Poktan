<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function jadwal()
    {
        return view ('kegiatan-kelompoktani.jadwal');
    }

    public function laporan()
    {
        return view ('kegiatan-kelompoktani.laporan');
    }
}
