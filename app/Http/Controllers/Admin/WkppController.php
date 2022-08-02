<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wkpp;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\DataTables\WkppDataTable;
use App\Models\Penyuluh;

class WkppController extends Controller
{
   
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
            'nama_wkpp' => 'required|unique:wkpp',
        ]);

       if ($validator->passes()) {
        Wkpp::create([
            'id_wkpp' => 'WKPP'.Str::upper(Str::random(5)),
            'nama_wkpp' => $request->nama_wkpp,
            'penyuluh_id' => $request->penyuluh_id,
        ]);

            return response()->json(['message' => 'Data berhasil disimpan!']);  
        }
       
      return response()->json(['error' => $validator->errors()->all()]);   
    }

    public function edit($id)
    {
        $wkpp = Wkpp::findOrFail($id);
        return response()->json(['data' => $wkpp]);
    }

    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
             'nama_wkpp' => 'required|unique:wkpp',
         ]);

        if ($validator->passes()) {
            Wkpp::findOrFail($id)->update([
                'nama_wkpp' => $request->nama_wkpp,
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
