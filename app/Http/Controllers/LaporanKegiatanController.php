<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\KelompokTani;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Validator;
use App\Helpers\Bulan;
use PDF;
use \Yajra\Datatables\Datatables;

class LaporanKegiatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = kegiatan::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<div class="row"><a href="'.route('home.index', $row->nisn).'"class="btn btn-primary btn-sm ml-2">
                    <i class="fas fa-money-check"></i> BAYAR
                    </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    	return view('LaporanKegiatan.index');
    }

    
}
