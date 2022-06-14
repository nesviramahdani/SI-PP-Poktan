<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Komoditas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\DataTables\KomoditasDataTable;

class KomoditasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-komoditas'])->only(['index', 'show']);
        $this->middleware(['permission:create-komoditas'])->only(['create', 'store']);
        $this->middleware(['permission:update-komoditas'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-komoditas'])->only(['destroy']);
    }

    public function index(Request $request, KomoditasDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();    
        }

        $komoditas = Komoditas::all();
        return view('admin.komoditas.index', compact('komoditas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_komoditas' => 'required|unique:komoditas',
        ]);

       if ($validator->passes()) {
        Komoditas::create([
            'id_komoditas' => 'KDT'.Str::upper(Str::random(5)),
            'nama_komoditas' => $request->nama_komoditas,
        ]);
            return response()->json(['message' => 'Data berhasil disimpan!']);  
        }
       
      return response()->json(['error' => $validator->errors()->all()]);   
    }

    public function edit($id)
    {
        $komoditas = Komoditas::findOrFail($id);
        return response()->json(['data' => $komoditas]);
    }

    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'nama_komoditas' => 'required|unique:komoditas',
         ]);

        if ($validator->passes()) {
            Komoditas::findOrFail($id)->update([
                'nama_komoditas' => $request->nama_komoditas,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
         }

    
        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function destroy($id)
    {
        Komoditas::findOrFail($id)->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
