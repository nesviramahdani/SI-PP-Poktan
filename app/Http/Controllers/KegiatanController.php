<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\kegiatan;
use App\Models\KelompokTani;
use Illuminate\Http\Request;
use App\DataTables\KegiatanDataTable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-kegiatan'])->only(['index', 'show']);
        $this->middleware(['permission:create-kegiatan'])->only(['create', 'store']);
        $this->middleware(['permission:update-kegiatan'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-kegiatan'])->only(['destroy']);
    }

    public function index(Request $request, KegiatanDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        $kegiatan = kegiatan::all();
        $kelompokTani = KelompokTani::all();

        return view('penyuluh.kegiatan', compact('kegiatan', 'kelompokTani'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'lokasi' => 'required',
        ]);

        if ($validator->passes()) {
           
                kegiatan::create([
                    'id_kegiatan' => 'SSWR'.Str::upper(Str::random(5)),
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'tanggal_kegiatan' => $request->tanggal_kegiatan,
                    'jam_mulai' => $request->jam_mulai,
                    'jam_selesai' => $request->jam_selesai,
                    'lokasi' => $request->lokasi,
                    'kelompok_tani_id' => $request->kelompok_tani_id,
                ]);

            return response()->json(['message' => 'Data berhasil disimpan!']);   
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function edit($id)
    {
        $kegiatan = kegiatan::with(['kelompoktani'])->findOrFail($id);
        return response()->json(['data' => $kegiatan]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'lokasi' => 'required',
        ]);

        if ($validator->passes()) {
            kegiatan::findOrFail($id)->update([
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_kegiatan' => $request->tanggal_kegiatan,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'lokasi' => $request->lokasi,
                'kelompok_tani_id' => $request->kelompok_tani_id,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function destroy($id)
    {
        $kegiatan = kegiatan::findOrFail($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }

}
