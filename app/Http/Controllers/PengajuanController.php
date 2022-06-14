<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Pengajuan;
use App\Models\Bantuan;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        $bantuan = Bantuan::all();
        $pengajuan = Pengajuan::all();
        //dd($bantuan);
        
        return view('pengajuan.index', compact('bantuan', 'anggota', 'pengajuan'));
    }

 
	public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proposal' => 'required',
        ]);

        
        if ($validator->passes()) {
                $dir = storage_path().'/app/public/file';
                $file = $request->file('proposal');

                if($file){
                    $fileName = Time().".".$file->getClientOriginalName();
                    $file->move($dir, $fileName);
                }

                $pengajuan = new Pengajuan;
                $pengajuan->id_pengajuan = 'SSWR'.Str::upper(Str::random(5));
                $pengajuan->bantuan_id = $request->bantuan_id;
                $pengajuan->proposal = $fileName;
                $pengajuan->status = 'Belum diverifikasi';

                $anggota = Anggota::where('user_id', Auth::user()->id)->first();

                $pengajuan->anggota_id = $anggota->id;
                $pengajuan->save();

            return response()->json(['message' => 'Data berhasil disimpan!']);   
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function history()
    {
        
        return view('pengajuan.history');
    }
}
