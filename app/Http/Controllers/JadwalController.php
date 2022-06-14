<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\DataTables\KegiatanDataTable;
use App\Models\Kelompoktani;
use App\Models\Kegiatan;


class JadwalController extends Controller
{
    public function index(Request $request, KegiatanDataTable $datatable){

        if ($request->ajax()){
            return $datatable->data();    
        }
        $kegiatan = Kegiatan::all();
        $kelompoktani = Kelompoktani::all();

        return view ('kegiatan-penyuluh.jadwal', compact('kegiatan', 'kelompoktani'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
        'nama_kegiatan' => 'required',
        'tanggal_kegiatan' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
        'lokasi' => 'required',
        ]);
        
        if($validator->passes()){
            $kegiatan = new Kegiatan;
            $kegiatan->id_kegiatan = 'SSWR'.Str::upper(Str::random(5));
            $kegiatan->kelompoktani_id = $request->kelompoktani_id;
            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
            $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;
            $kegiatan->jam_mulai = $request->jam_mulai;
            $kegiatan->jam_selesai = $request->jam_selesai;
            $kegiatan->lokasi = $request->lokasi;
            $kegiatan->save();

            return response()->json(['message' => 'Data berhasil disimpan!']);   
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::with(['kelompoktani'])->findOrFail($id);
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
            Kegiatan::findOrFail($id)->update([
                'kelompoktani_id' => $request->kelompoktani_id,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_kegiatan' => $request->tanggal_kegiatan,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'lokasi' => $request->lokasi,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function destroy($id)
    {
        Kegiatan::findOrFail($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
