<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kelompoktani;
use App\Models\Wkpp;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Detailkegiatan;
use App\Models\Notifikasi;
use App\Models\Penyuluh;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class KegiatanController extends Controller
{
    public function index(){
        $wkpp_id = collect([]);
        $kelompoktani_id = collect([]);
        $wkpp = Wkpp::where('penyuluh_id', Auth::user()->penyuluh->id)->get();
        foreach($wkpp as $new){
            $wkpp_id->push($new->id);
    }
        $kelompoktani = Kelompoktani::whereIn('wkpp_id', $wkpp_id)->get();
        foreach($kelompoktani as $new){
            $kelompoktani_id->push($new->id);
    }
        $detail = Detailkegiatan::whereIn('kelompoktani_id', $kelompoktani_id)->get();
    	return view('kegiatan.index', compact('detail'));
    }

    public function create(){
        $wkpp_id = collect([]);
        $wkpp = Wkpp::where('penyuluh_id', Auth::user()->penyuluh->id)->get();
        foreach($wkpp as $new){
            $wkpp_id->push($new->id);
    }
        $kelompoktani = Kelompoktani::whereIn('wkpp_id', $wkpp_id)->get();
        return view('kegiatan.create', compact('kelompoktani'));
    }

    public function store(Request $request)
    {
        $kegiatan = new Kegiatan;
        $kegiatan->id_kegiatan = 'KGT'.Str::upper(Str::random(5));
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;
        $kegiatan->jam_mulai = $request->jam_mulai;
        $kegiatan->jam_selesai = $request->jam_selesai;
        $kegiatan->lokasi = $request->lokasi;
        $kegiatan->save();

        foreach($request->kelompoktani_id as $kelompoktani_id){
            $detailKegiatan = new Detailkegiatan;
            $detailKegiatan->kegiatan_id = $kegiatan->id;
            $detailKegiatan->kelompoktani_id = $kelompoktani_id;
            $detailKegiatan->save();
        }

        return redirect('/penyuluh/kegiatan')->withSuccess('Kegiatan berhasil ditambah!');
    }

    public function edit($id)
    {
        $detailKegiatan = Detailkegiatan::with('kelompoktani')->findOrFail($id);
        return view('kegiatan.edit', compact('detailKegiatan'));
    }

    public function update(Request $request, $id){
        try {
        $detailKegiatan = DetailKegiatan::findOrFail($id);
        $kegiatan = Kegiatan::find($detailKegiatan->kegiatan_id);
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;
        $kegiatan->jam_mulai = $request->jam_mulai;
        $kegiatan->jam_selesai = $request->jam_selesai;
        $kegiatan->lokasi = $request->lokasi;
        $kegiatan->save();

        // foreach($request->kelompoktani_id as $kelompoktani_id){
        //     $detailKegiatan = new Detailkegiatan;
        //     $detailKegiatan->kegiatan_id = $kegiatan->id;
        //     $detailKegiatan->kelompoktani_id = $kelompoktani_id;
        //     $detailKegiatan->save();
        // }

        foreach($kegiatan->detail as $detail){
            $notifikasi = new Notifikasi;
            $notifikasi->tipe = 2;
            $notifikasi->user_id = $detail->kelompoktani->user->id;
            $notifikasi->save();
        }
        return redirect('/penyuluh/kegiatan')->withSuccess('Kegiatan berhasil ditambah!');
        } catch (\Exception $e) {
            dd($e);
        }
    }
    
    public function destroy($id)
    {
        $kegiatan= Detailkegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect('/penyuluh/kegiatan')->withSuccess('Kegiatan berhasil dihapus!');
    }

   

    public function cetakKegiatan($tanggal_mulai, $tanggal_selesai)
    {
        // dd(["Tanggal awal :".$tanggal_mulai, "Tanggal selesai:".$tanggal_selesai]);
        $wkpp_id = collect([]);
        $kelompoktani_id = collect([]);
        $wkpp = Wkpp::where('penyuluh_id', Auth::user()->penyuluh->id)->get();
        foreach($wkpp as $new){
            $wkpp_id->push($new->id);
    }
        $kelompoktani = Kelompoktani::whereIn('wkpp_id', $wkpp_id)->get();
        foreach($kelompoktani as $new){
            $kelompoktani_id->push($new->id);
    }
        // $detail = Detailkegiatan::whereIn('kelompoktani_id', $kelompoktani_id)->get();

        $cetakkegiatan = Detailkegiatan::whereIn('kelompoktani_id', $kelompoktani_id)
    ->join('kegiatan', 'detailkegiatan.kegiatan_id', '=' ,'kegiatan.id')
        ->whereBetween('kegiatan.tanggal_kegiatan', [$tanggal_mulai, $tanggal_selesai])->get();
        $data = [
            'cetakkegiatan' => $cetakkegiatan,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
        ];
        $pdf = PDF::loadview('kegiatan.cetakkegiatan', compact('data'));
        return $pdf->stream('datakegiatan.pdf');
      }

    public function laporanKegiatan(){
        $kelompoktani = Kelompoktani::all();
        $penyuluh = Penyuluh::all();
        $laporanKegiatan = Detailkegiatan::orderBy('updated_at', 'desc')->get();
        return view ('kegiatan.laporanKegiatan', compact('laporanKegiatan', 'kelompoktani', 'penyuluh'));
    }

      public function kegiatanpetani(){
          
          $kelompoktani = Kelompoktani::where('user_id', Auth::user()->id)->first();
          $detail = Detailkegiatan::where('kelompoktani_id', $kelompoktani->id)->get();
    	return view('kegiatan.kegiatanpetani', compact('detail'));
      }
}
