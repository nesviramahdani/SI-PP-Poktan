<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bantuan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\DataTables\BantuanDataTable;

class BantuanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-bantuan'])->only(['index', 'show']);
        $this->middleware(['permission:create-bantuan'])->only(['create', 'store']);
        $this->middleware(['permission:update-bantuan'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-bantuan'])->only(['destroy']);
    }

    public function index(Request $request, BantuanDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();    
        }

        return view('admin.bantuan.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_bantuan' => 'required|unique:bantuans',
        ]);

        if ($validator->passes()) {

         Bantuan::create([
            'id_bantuan' => 'BTN'.Str::upper(Str::random(5)),
            'jenis_bantuan' => $request->jenis_bantuan,
            ]);

            return response()->json(['message' => 'Data berhasil disimpan!']);
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function edit($id)
    {
        $bantuan = Bantuan::findOrFail($id);

        return response()->json(['data' => $bantuan]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_bantuan' => 'required|unique:bantuans',
        ]);

        if ($validator->passes()) {
            Bantuan::findOrFail($id)->update($request->all());

            return response()->json(['message' => 'Data berhasil diupdate!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function destroy($id)
    {
        Bantuan::findOrFail($id)->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }

}
