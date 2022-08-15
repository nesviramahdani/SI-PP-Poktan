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

        return redirect('/kelompoktani/LaporanKegiatan')->withSuccess('Kegiatan berhasil dilaporkan!');
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

    public function cetaklaporan( $tanggal_mulai, $tanggal_selesai)
    {
        $laporankegiatan = DetailKegiatan::join('kegiatan', 'detailkegiatan.kegiatan_id', '=' ,'kegiatan.id',)
        ->whereBetween('kegiatan.tanggal_kegiatan', [$tanggal_mulai, $tanggal_selesai])
        ->orderBy('kegiatan.tanggal_kegiatan', 'asc')->get();
        $data = [
            'laporankegiatan' => $laporankegiatan,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
        ];
        $pdf = PDF::loadview('laporan-kegiatan.laporan-periode', compact('data'));
        return $pdf->stream('data-laporan-kegiatan.pdf');
      }

      public function filter(Request $request){
        $kelompoktani = Kelompoktani::select('nama_kelompoktani')->groupBy('nama_kelompoktani')->get();
        $month = $request->get('month');
        $year = $request->get('year');
        $laporanKegiatan = DetailKegiatan::join('kegiatan', 'detailkegiatan.kegiatan_id', '=' ,'kegiatan.id')
                  ->whereYear('kegiatan.tanggal_kegiatan', '=', $year)
                  ->whereMonth('kegiatan.tanggal_kegiatan', '=', $month)
                  ->orderBy('kegiatan.tanggal_kegiatan', 'asc')->get();       
            return view('kegiatan.laporanKegiatan', compact('laporanKegiatan', 'kelompoktani'));
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
    	return view('laporan-kegiatan.p_laporan-kegiatan', compact('detail', 'wkpp'));
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


      public function show()
    {
        //
        try{
            $kelompoktani = Kelompoktani::all();
            return view('laporan-kegiatan.cetak perkelompoktani', compact('kelompoktani'));
        }
        catch(\Exception $e){

            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function print( Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');
        $wkpp_id = $request->get('wkpp_id');
        $wkpp = Wkpp::where('penyuluh_id', Auth::user()->penyuluh->id)->get();
              $kelompoktani = Kelompoktani::where('wkpp_id', $wkpp_id)->get();
              $kelompoktani_id = collect([]);
              foreach($kelompoktani as $new){
                  $kelompoktani_id->push($new->id);
          }
              $detail = Detailkegiatan::whereIn('kelompoktani_id', $kelompoktani_id)
              ->join('kegiatan', 'detailkegiatan.kegiatan_id', '=' ,'kegiatan.id')
              ->whereYear('kegiatan.tanggal_kegiatan', '=', $year)
              ->whereMonth('kegiatan.tanggal_kegiatan', '=', $month)->get();

              $nama_wkpp = Wkpp::where('id',$wkpp_id)->select("nama_wkpp")->first();
              $data = [
                'detail' => $detail,
                'year' => $year,
                'month' => $month,
                'nama_wkpp' => $nama_wkpp->nama_wkpp,
            ];

             $pdf = PDF::loadview('laporan-kegiatan.p_cetak-laporan-kegiatan-bulan', compact('data'));
             return $pdf->stream('data-laporan-kegiatan-kegiatan.pdf');       
              
    }



}
