<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Pengajuan;
use App\Models\Bantuan;
use App\Models\Anggota;
use App\Models\Kelompoktani;
use App\Models\Notifikasi;
use Exception;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        $kelompoktani = Kelompoktani::all();
        $pengajuan = Pengajuan::all();
        //dd($bantuan);
        

        return view('pengajuan.index', compact('pengajuan'));
    }

 
	public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proposal' => 'required',
        ]);

        
        if ($validator->passes()) {
                $proposal = $request->file('proposal');
                $nama_proposal = 'Proposal'.date('Ymdhis').'.'.$request->file('proposal')->getClientOriginalExtension();
                $proposal->move(public_path().'/app/public/proposal', $nama_proposal);

                $pengajuan = new Pengajuan;
                $pengajuan->id_pengajuan = 'SSWR'.Str::upper(Str::random(5));
                $pengajuan->proposal = $nama_proposal;
                $pengajuan->keterangan = $request->keterangan;
              // dd(Auth::user()->id);
               $kelompoktani = Kelompoktani::where('user_id', Auth::user()->id)->first();
//dd($kelompoktani->id);
                $pengajuan->kelompoktani_id = $kelompoktani->id;
                $pengajuan->save();

                if($pengajuan){
                    $notifikasi = new Notifikasi;
                    $notifikasi->tipe = 1;
                    $notifikasi->user_id = 1;
                    $notifikasi->save();
                }

            // return response()->json(['message' => 'Data berhasil disimpan!']);   

            return redirect('/kelompoktani/pengajuan/history')->withSuccess('Kegiatan berhasil dihapus!');
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function history()
    {
        $kelompoktani = Kelompoktani::where('user_id', Auth::user()->id)->first();
        $pengajuan = Pengajuan::where('kelompoktani_id', $kelompoktani->id)->orderBy('created_at', 'desc')->get();
        return view('pengajuan.history', compact( 'kelompoktani', 'pengajuan'));
    }

    public function datapengajuan()
    {
        $pengajuan = Pengajuan::all();
        $notifikasis = Notifikasi::where('tipe', 1)->where('status',1)->get();
        foreach($notifikasis as $notifikasi){
            $notifikasi->status = 2;
            $notifikasi->save();
        }
        return view('pengajuan.datapengajuan', compact('pengajuan'));
    }

    public function hapus($id)
    {
        Pengajuan::findOrFail($id)->delete();

        return redirect('/admin/pengajuan-bantuan')->withSuccess('Data Pengajuan berhasil dihapus!');
    }

    public function destroy($id)
    {
        Pengajuan::findOrFail($id)->delete();

        return redirect('/kelompoktani/pengajuan/history')->withSuccess('Data Pengajuan berhasil dihapus!');
    }

    public function download($id)
{
    $pengajuan = Pengajuan::where('id', $id)->firstOrFail();
    $pathToFile = public_path().'/app/public/proposal'. $pengajuan->proposal;
    return response()->download($pathToFile);
}

public function edit($id)
{
    $pengajuan = Pengajuan::findOrFail($id);
    return response()->json(['data' => $pengajuan]);
}

public function update(Request $request, $id)
{
    dd($request);
    $validator = Validator::make($request->all(), [
        'status' => 'required',
    ]);
    if ($validator->passes()) {
        Pengajuan::findOrFail($id)->update([
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Data berhasil diupdate!']);
    }

    return response()->json(['error' => $validator->errors()->all()]);
}

public function status(Request $request)
{
    $validator = Validator::make($request->all(), [
        'status' => 'required',
  
    ]);
    if ($validator->passes()) 
    {
        if($request->status == 0){
         Pengajuan::findOrFail($request->id)->update([
            'status' => $request->status,
            'keterangan_status' => $request->keterangan_status,
        ]);
    }else{
        Pengajuan::findOrFail($request->id)->update([
        'status' => $request->status,
    ]);
    }

        return redirect()->back()->with(['message' => 'Status berhasil diupdate!']);
    }

    return response()->json(['error' => $validator->errors()->all()]);
}
}
