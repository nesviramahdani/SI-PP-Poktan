<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Kelompoktani;
use App\Models\User;
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
        $kelompoktani = Kelompoktani::all();

        return view('admin.anggota.index', compact('anggota','kelompoktani'));
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
            'nik' => 'required|unique:anggota',
            'nama_anggota' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'luas_lahan' => 'required',
        ]);

        if ($validator->passes()) {
                Anggota::create([
                    'id_anggota' =>'AGT'.Str::upper(Str::random(5)),
                    'nik' => $request->nik,
                    'nama_anggota' => $request->nama_anggota,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'nohp' => $request->nohp,
                    'jabatan' => $request->jabatan,
                    'luas_lahan' => $request->luas_lahan,
                    'kelompoktani_id' => $request->kelompoktani_id,
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
        $anggota = Anggota::with(['kelompoktani'])->findOrFail($id);
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
            'luas_lahan' => $request->luas_lahan,
            'kelompoktani_id' => $request->kelompoktani_id,
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
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
