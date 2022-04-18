<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyuluh;
use App\Models\User;
use App\Models\Bpp;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\PenyuluhDataTable;

class PenyuluhController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-penyuluh'])->only(['index', 'show']);
        $this->middleware(['permission:create-penyuluh'])->only(['create', 'store']);
        $this->middleware(['permission:update-penyuluh'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-penyuluh'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PenyuluhDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        $penyuluh = Penyuluh::all();
        $bpp = Bpp::all();

        return view('admin.penyuluh.index', compact('bpp', 'penyuluh'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           // 'id_penyuluh' => 'required|unique:penyuluhs',
            'nip' => 'required|unique:penyuluhs',
            'username' => 'required|unique:users',
            'nama_penyuluh' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
        ]);

        if ($validator->passes()) {
            DB::transaction(function() use($request){
                $user = User::create([
                    'username' => Str::lower($request->username),
                    'password' => Hash::make('penyuluh'),
                ]);

                $user->assignRole('penyuluh');

                Penyuluh::create([
                    'user_id' => $user->id,
                    'id_penyuluh' =>  'PPL'.Str::upper(Str::random(5)),
                    'nip' => $request->nip,
                    'nama_penyuluh' => $request->nama_penyuluh,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'jabatan' => $request->jabatan,
                    'bpp_id'=>$request->bpp_id,
                    
                ]);
             });

            return response()->json(['message' => 'Data berhasil disimpan!']);   
    }
    return response()->json(['error' => $validator->errors()->all()]);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penyuluh = Penyuluh::with(['bpp'])->findOrFail($id);
        return response()->json(['data' => $penyuluh]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_penyuluh' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
        ]);

        if ($validator->passes()) {
            Penyuluh::findOrFail($id)->update([
                'nama_penyuluh' => $request->nama_siswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'jabatan' => $request->alamat,
                'bpp_id' => $request->bpp_id,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penyuluh = Penyuluh::findOrFail($id);
        User::findOrFail($penyuluh->user_id)->delete();
        $penyuluh->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
