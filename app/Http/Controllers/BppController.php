<?php
namespace App\Http\Controllers;

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
            'nama_bpp' => 'required|unique:bpp',
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
