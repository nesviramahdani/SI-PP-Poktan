<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wkpp;
use App\Models\Penyuluh;
use Illuminate\Support\Facades\Validator;
use App\DataTables\WkppDataTable;

class WkppController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-wkpp'])->only(['index', 'show']);
        $this->middleware(['permission:create-wkpp'])->only(['create', 'store']);
        $this->middleware(['permission:update-wkpp'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-wkpp'])->only(['destroy']);
    }

    public function index(Request $request, WkppDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();    
        }

        $wkpp = Wkpp::all();
        $penyuluh = Penyuluh::all();
        return view('admin.wkpp.index', compact('wkpp', 'penyuluh'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_wkpp' => 'required|unique:wkpps',
            'nama_wkpp' => 'required',
        ],[
            'id_wkpp.required' => 'ID WKPP tidak boleh kosong!',
            'id_wkpp.unique' => 'ID WKPP sudah terdaftar!',
            'nama_wkpp.required' => 'Nama WKPP tidak boleh kosong!',
        ]);

       if ($validator->passes()) {
            Wkpp::create($request->all());
            return response()->json(['message' => 'Data berhasil disimpan!']);  
        }
       
      return response()->json(['error' => $validator->errors()->all()]);   
    }

    public function edit($id)
    {
        $wkpp = Wkpp::with(['penyuluh'])->findOrFail($id);
        return response()->json(['data' => $wkpp]);
    }

    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
             'id_wkpp' => 'required',
             'nama_wkpp' => 'required',
         ],[
            'id_wkpp.required' => 'ID WKPP tidak boleh kosong!',
             'nama_wkpp.required' => 'Nama WKPP tidak boleh kosong!',
         ]);

        if ($validator->failed()) {
            Wkpp::findOrFail($id)->update([
                'nama_wkpp' => $request->nama_wkpp,
                'penyuluh_id' => $request->penyuluh_id,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
         }

    
        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function destroy($id)
    {
        Wkpp::findOrFail($id)->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
