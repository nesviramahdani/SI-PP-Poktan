<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bpp;
use App\Models\Kecamatan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\KecamatanDataTable;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-kecamatan'])->only(['index', 'show']);
        $this->middleware(['permission:create-kecamatan'])->only(['create', 'store']);
        $this->middleware(['permission:update-kecamatan'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-kecamatan'])->only(['destroy']);
    }

    public function index(Request $request, KecamatanDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();    
        }
        
        $kecamatan = Kecamatan::all();
        $bpp = Bpp::all();
        return view('admin.kecamatan.index',  compact('kecamatan', 'bpp'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kecamatan' => 'required|unique:kecamatans',
            'nama_kecamatan' => 'required',
        ],[

            'id_kecamatan.unique' => 'kecamatan sudah terdaftar!',
        ]);

        if ($validator->passes()) {
            
            Kecamatan::create([
                'id_kecamatan'=>$request->id_kecamatan,
                'nama_kecamatan'=>$request->nama_kecamatan,
                'bpp_id'=>$request->bpp_id,
            ]);

            return response()->json(['message' => 'Data berhasil disimpan!']);
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::with(['bpp'])->findOrFail($id);

        return response()->json(['data' => $kecamatan]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kecamatan' => 'required',
        ]);

        if ($validator->passes()) {
            Kecamatan::findOrFail($id)->update([
                'nama_kecamatan' => $request->nama_siswa,
                'kecamatan_id' => $request->kecamatan_id,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function destroy($id)
    {
        Kecamatan::findOrFail($id)->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
