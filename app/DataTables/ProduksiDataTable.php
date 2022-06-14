<?php 

namespace App\DataTables;

use App\Models\Kelompoktani;
use App\Models\Produksi;
use \Yajra\Datatables\Datatables;
use App\Models\Penyuluh;
use Illuminate\Support\Facades\Auth;

class ProduksiDataTable
{
	public function data()
	{
                $id_kelompoktani = collect([]);
                $kelompok_tanis = Kelompoktani::where('penyuluh_id', Auth::user()->penyuluh->id)->get();
                foreach($kelompok_tanis as $kelompok_tani){
                $id_kelompoktani->push($kelompok_tani->id);
                }
                $produksis = Produksi::whereIn('kelompoktani_id', $id_kelompoktani)->get();
                $data = Produksi::whereIn('kelompoktani_id', $id_kelompoktani)->with(['kelompoktani','komoditas'])->latest();
		return DataTables::of($data)
			->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<div class="row"><a href="javascript:void(0)" id="'.$row->id.
                        '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                $btn .= '<a href="javascript:void(0)" id="'.$row->id.
                        '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
	}
}