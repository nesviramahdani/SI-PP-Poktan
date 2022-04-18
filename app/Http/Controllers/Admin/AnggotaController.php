<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\KelompokTani;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\AnggotaDataTable;

class AnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-anggota'])->only(['index', 'show']);
        $this->middleware(['permission:create-anggota'])->only(['create', 'store']);
        $this->middleware(['permission:update-anggota'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-anggota'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AnggotaDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        $anggota = Anggota::all();
        $kelompokTani = KelompokTani::all();

        return view('admin.anggota.index', compact('anggota','kelompokTani'));
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
            'id_anggota' => 'required|unique:anggotas',
            'nik' => 'required|unique:anggotas',
            'nama_anggota' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'jenis_usaha' => 'required',
            'luas_lahan' => 'required',
            'jenis_lahan' => 'required',
        ]);

        if ($validator->passes()) {

                Anggota::create([
                    'id_anggota' => $request->id_anggota,
                    'nik' => $request->nik,
                    'nama_anggota' => $request->nama_anggota,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'jabatan' => $request->jabatan,
                    'jenis_usaha' => $request->jenis_usaha,
                    'luas_lahan' => $request->luas_lahan,
                    'jenis_lahan' => $request->jenis_lahan,
                    'kelompok_tani_id' => $request->kelompok_tani_id,
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
        $anggota = Anggota::with(['kelompok_tanis'])->findOrFail($id);
        return response()->json(['data' => $anggota]);
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
        Anggota::findOrFail($id)->update([
            'nama_anggota' => $request->nama_anggota,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'jenis_usaha' => $request->jenis_usaha,
            'luas_lahan' => $request->luas_lahan,
            'jenis_lahan' => $request->jenis_lahan,
            'kelompok_tani_id' => $request->kelompok_tani_id,
        ]);
        return response()->json(['message' => 'Data berhasil diupdate!']);
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Anggota::findOrFail($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
