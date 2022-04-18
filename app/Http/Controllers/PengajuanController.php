<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;


class PengajuanController extends Controller
{
    public function index()
    {
        return view('siswa.pengajuan-bantuan');
    }
 
   
}
