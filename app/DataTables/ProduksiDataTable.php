<?php 

namespace App\DataTables;

use App\Models\Kelompoktani;
use App\Models\Produksi;
use App\Models\Wkpp;
use App\Models\Penyuluh;
use \Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class ProduksiDataTable
{
	public function data()
	{
                 $id_kelompoktani = collect([]);
                 $wkpp_id = collect([]);
                $wkpp = Wkpp::where('penyuluh_id', Auth::user()->penyuluh->id)->get();
                foreach($wkpp as $new){
                        $wkpp_id->push($new->id);
                }
                $kelompok_tanis = Kelompoktani::whereIn('wkpp_id', $wkpp_id)->get();
                foreach($kelompok_tanis as $kelompok_tani){
                        $id_kelompoktani->push($kelompok_tani->id);
                }
                $data = Produksi::whereIn('kelompoktani_id', $id_kelompoktani)->with(['kelompoktani', 'komoditas'])->latest();
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