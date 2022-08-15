<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Komoditas;
use App\Models\Kelompoktani;
use App\Models\Produksi;
use App\Models\Wkpp;
use App\Models\Penyuluh;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\ProduksiDataTable;
use App\Exports\ProduksiExport;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use \Yajra\Datatables\Datatables;

class ProduksiController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['permission:read-produksi'])->only(['index', 'show']);
    //     $this->middleware(['permission:create-produksi'])->only(['create', 'store']);
    //     $this->middleware(['permission:update-produksi'])->only(['edit', 'update']);
    //     $this->middleware(['permission:delete-produksi'])->only(['destroy']);
    // }
    
    public function index(Request $request, ProduksiDataTable $datatable)
    {
        if ($request->ajax()) {

            return $datatable->data();
        }

            $produksi = Produksi::all();
            $wkpp_id = collect([]);
            $wkpp = Wkpp::where('penyuluh_id', Auth::user()->penyuluh->id)->get();
            foreach($wkpp as $new){
                $wkpp_id->push($new->id);
        }
            $kelompoktani = Kelompoktani::whereIn('wkpp_id', $wkpp_id)->get();
            $komoditas = Komoditas::all();
           
        return view('produksi.indexx', compact('produksi',  'komoditas', 'kelompoktani'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_produksi' => 'required',
            'luas_tanam' => 'required',
            'tanggal_produksi' => 'required',
        ]);

        if ($validator->passes()) {
                Produksi::create([
                    'id_produksi' => 'SSWR'.Str::upper(Str::random(5)),
                    'kelompoktani_id' => $request->kelompoktani_id,
                    'komoditas_id' => $request->komoditas_id,
                    'jumlah_produksi' => $request->jumlah_produksi,
                    'luas_tanam' => $request->luas_tanam,
                    'tanggal_produksi' => $request->tanggal_produksi,
                ]);

            return response()->json(['message' => 'Data berhasil disimpan!']);   
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function edit($id)
    {
        $produksi = Produksi::with(['kelompoktani', 'komoditas'])->findOrFail($id);
        return response()->json(['data' => $produksi]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_produksi' => 'required',
            'luas_tanam' => 'required',
            'tanggal_produksi' => 'required',
        ]);

        if ($validator->passes()) {
            Produksi::findOrFail($id)->update([
                'kelompoktani_id' => $request->kelompoktani_id,
                'komoditas_id' => $request->komoditas_id,
                'jumlah_produksi' => $request->jumlah_produksi,
                'luas_tanam' => $request->luas_tanam,
                'tanggal_produksi' => $request->tanggal_produksi,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function destroy($id)
    {
        Produksi::findOrFail($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }

    
    public function exportpdf()
    {
        $data = Produksi::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('produksi.dataproduksi-pdf');
        return $pdf->stream('dataproduksi.pdf');
    }

    public function exportexcel()
    {
        return Excel::download(new ProduksiExport, 'produksi.xlsx');
    }

    public function laporan()
    {
        return view ('produksi.laporan');
    }


    public function cetaklaporan($tanggal_mulai, $tanggal_selesai)
    {
        $cetakproduksi = Produksi::with('kelompoktani', 'komoditas')
        ->whereBetween('tanggal_produksi', [$tanggal_mulai, $tanggal_selesai])
        ->orderBy('tanggal_produksi', 'asc')->get();
        $data = [
            'cetakproduksi' => $cetakproduksi,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
        ];
        $pdf = PDF::loadview('produksi.cetaklaporan', compact('data'));
        return $pdf->stream('dataproduksi.pdf');
      }

      public function dataproduksi(Request $request)
      {
            if ($request->ajax()) {
                $data = Produksi::with(['kelompoktani' => function($query){
                    $query->with(['wkpp' => function($query){
                        $query->with('penyuluh');}]);
                }, 'komoditas'])->latest();
                return DataTables::of($data)
                     ->addIndexColumn()
                     ->make(true);
            }
            return view('produksi.dataproduksi');
    
    }
}
