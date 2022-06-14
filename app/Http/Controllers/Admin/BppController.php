<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bpp;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Validator;
use App\DataTables\BppDataTable;

class BppController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-bpp'])->only(['index', 'show']);
        $this->middleware(['permission:create-bpp'])->only(['create', 'store']);
        $this->middleware(['permission:update-bpp'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-bpp'])->only(['destroy']);
    }

    public function index(Request $request, BppDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();    
        }
        $bpp = Bpp::all();
        
        return view('admin.bpp.index', compact('bpp'));
    }

    // public function index(Request $request){
    //     // panggil model artikel dan relasi dengan model kategori
    //     $bpps = Bpp::with('kecamatan')->get();
        
    //     // buat variabel array
    //     $data = [];

    //     // looping $artikels dan masukkan data ke dalam $data
    //     foreach($bpps as $key => $bpp){
    //         $data[$key]['nama_bpp'] = $bpp->nama_bpp;
    //         $data[$key]['nama_kecamatan'] =  $bpp->kecamatans->nama_kecamatan;
    //         //$data[$key]['konten'] = Str::limit($artikel->content,100);
    //        // $data[$key]['created_at'] = Carbon::parse($artikel->created_at)->isoFormat('D MMMM Y');
    //     }

    //         return datatables()->of($data)->make();
    //     }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_bpp' => 'required|unique:bpp',
            'nama_bpp' => 'required|unique:bpp',
        ]);

       if ($validator->passes()) {
            Bpp::create($request->all());
            return response()->json(['message' => 'Data berhasil disimpan!']);  
        }
       
      return response()->json(['error' => $validator->errors()->all()]);   
    }

    public function edit($id)
    {
        $wkpp = Bpp::findOrFail($id);
        return response()->json(['data' => $wkpp]);
    }

    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
             'nama_bpp' => 'required',
         ]);

        if ($validator->passes()) {
            Bpp::findOrFail($id)->update([
                'nama_bpp' => $request->nama_bpp,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
         }

    
        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function destroy($id)
    {
        Bpp::findOrFail($id)->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
