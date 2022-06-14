<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelompoktani;
use App\Models\Kecamatan;
use App\Models\Wkpp;
use App\Models\Penyuluh;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\KelompokTaniDataTable;
use App\Models\Bpp;

class KelompoktaniController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-kelompok-tani'])->only(['index', 'show']);
        $this->middleware(['permission:create-kelompok-tani'])->only(['create', 'store']);
        $this->middleware(['permission:update-kelompok-tani'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-kelompok-tani'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, KelompoktaniDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        $kelompoktani = Kelompoktani::all();
        $kecamatan = Kecamatan::all();
        $wkpp = Wkpp::all();
        $penyuluh = Penyuluh::all();
        $bpp = Bpp::all();

        return view('admin.kelompok-tani.index', compact('kelompoktani', 'wkpp', 'bpp', 'penyuluh', 'kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelompoktani' => 'required',
            'jumlah_anggota' =>'required',
            'luas_lahan' =>'required',
            'penyuluh_id' =>'required',
            'wkpp_id' => 'required',
            'bpp_id' => 'required',
            'kecamatan_id' => 'required',
        ]);

        if ($validator->passes()) {
            KelompokTani::create([
                'id_kelompoktani' =>'POKTAN'.Str::upper(Str::random(5)),
                'nama_kelompoktani' =>$request->nama_kelompoktani,
                'jumlah_anggota' =>$request->jumlah_anggota,
                'luas_lahan' =>$request->luas_lahan,
                'penyuluh_id' =>$request->penyuluh_id,
                'wkpp_id' => $request->wkpp_id,
                'bpp_id' => $request->bpp_id,
                'kecamatan_id' => $request->kecamatan_id,
            ]);
        
            return response()->json(['message' => 'Data berhasil disimpan!']);   
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelompoktani = KelompokTani::with(['wkpp', 'bpp', 'kecamatan', 'penyuluh'])->findOrFail($id);
        return response()->json(['data' => $kelompoktani]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelompoktani' => 'required',
            'jumlah_anggota' =>'required',
            'luas_lahan' =>'required',
            
        ]);

        if ($validator->passes()) {
            KelompokTani::findOrFail($id)->update([
                'nama_kelompoktani' => $request->nama_kelompoktani,
                'jumlah_anggota' => $request->jumlah_anggota,
                'luas_lahan' => $request->luas_lahan,
                'penyuluh_id' => $request->penyuluh_id,
                'wkpp_id' => $request->wkpp_id,
                'bpp_id' => $request->bpp_id,
                'kecamatan_id' => $request->kecamatan_id,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       KelompokTani::findOrFail($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
