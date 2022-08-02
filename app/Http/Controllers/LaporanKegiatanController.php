<?php

namespace App\Http\Controllers;

use App\Models\Kelompoktani;
use App\Models\Detailkegiatan;
use App\Models\Kegiatan;
use App\Models\Penyuluh;
use App\Models\Foto;
use App\Models\Wkpp;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\LaporanKegiatanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKegiatanController extends Controller
{
    public function index($id)
    {
       $laporanKegiatan = Detailkegiatan::with(['kegiatan'])->findOrFail($id);
        return view('laporan-kegiatan.index', compact('laporanKegiatan'));
    }

    public function store(Request $request, $id)
    {
        $laporanKegiatan = Detailkegiatan::findOrFail($id);
        $laporanKegiatan->id_detailkegiatan = 'LPR'.Str::upper(Str::random(5));
        $laporanKegiatan->status = $request->status;
        $laporanKegiatan->peserta = $request->peserta;
        $laporanKegiatan->hasil = $request->hasil;
        $laporanKegiatan->save();

        $dir = storage_path().'/app/public/dokumentasi';
        foreach($request->file('dokumentasi') as $file){

            if($file){
                $fileName = Time().".".$file->getClientOriginalName();
                $file->move($dir, $fileName);
                
                $foto = new Foto;
                $foto->image = $fileName;
                $foto->detailkegiatan_id = $laporanKegiatan->id;
                $foto->save();
            }
        }

        return redirect('/kelompoktani/Kegiatan')->withSuccess('Kegiatan berhasil ditambah!');
    }

    public function tampil($id){

        $tampil = Detailkegiatan::findOrFail($id);
        return view ('laporan-kegiatan.tampil', compact('tampil'));
    }

    public function laporan()
    {
        $kelompoktani = Kelompoktani::where('user_id', Auth::user()->id)->first();
        $laporan = Detailkegiatan::where('kelompoktani_id', $kelompoktani->id)->get();
        return view ('laporan-kegiatan.laporan', compact('laporan'));
    }

    public function periode()
    {
        return view ('laporan-kegiatan.periode');
    }

    public function cetaklaporan($tanggal_mulai, $tanggal_selesai)
    {
        // dd(["Tanggal awal :".$tanggal_mulai, "Tanggal selesai:".$tanggal_selesai]);
        
        $laporankegiatan = DetailKegiatan::with('kegiatan')
        ->whereBetween('created_at', [$tanggal_mulai, $tanggal_selesai])->orderBy('updated_at', 'asc')->get();
        //view()->share('cetakkegiatan', $cetakkegiatan);
        $pdf = PDF::loadview('laporan-kegiatan.laporan-periode', compact('laporankegiatan'));
        return $pdf->stream('data-laporan-kegiatan.pdf');
      }

      public function filter(Request $request){
        $month = $request->get('month');
        $year = $request->get('year');
        $laporanKegiatan = DetailKegiatan::whereYear('created_at', '=', $year)
                  ->whereMonth('created_at', '=', $month)
                  ->get();
                  $kelompoktani = Kelompoktani::all();
                  $penyuluh = Penyuluh::all();  
            
            return view('kegiatan.laporanKegiatan', compact('laporanKegiatan', 'penyuluh', 'kelompoktani'));
        }

        public function lihat($id)
        {
            $lihatLaporan = Detailkegiatan::findOrFail($id);
            return view('laporan-kegiatan.lihat-laporan-kegiatan', compact('lihatLaporan'));
        }

        public function exportpdf()
    {
        $data = Detailkegiatan::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('laporan-kegiatan.export-pdf');
        return $pdf->stream('data-laporan-kegiatan.pdf');
    }

    public function exportexcel()
    {
        return Excel::download(new LaporanKegiatanExport, 'laporan-kegiatan.xlsx');
    }

    public function p_laporankegiatan(){
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
    	return view('laporan-kegiatan.p_laporan-kegiatan', compact('detail'));
    }

    public function p_cetaklaporan_kegiatan($tanggal_mulai, $tanggal_selesai)
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

        $cetaklaporan = Detailkegiatan::whereIn('kelompoktani_id', $kelompoktani_id)
        ->join('kegiatan', 'detailkegiatan.kegiatan_id', '=' ,'kegiatan.id')
        ->whereBetween('kegiatan.tanggal_kegiatan',  [$tanggal_mulai, $tanggal_selesai])->get();
        $data = [
            'cetaklaporan' => $cetaklaporan,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
        ];
        $pdf = PDF::loadview('laporan-kegiatan.p_cetak-laporan-kegiatan', compact('data'));
        return $pdf->stream('data-laporan-kegiatan-kegiatan.pdf');
      }

}
