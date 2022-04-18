<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KelompokTani;
use App\Models\Kecamatan;
use App\Models\Wkpp;
use App\Models\Penyuluh;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\KelompokTaniDataTable;
use App\Models\Kelas;

class KelompokTaniController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-kelompok-tani'])->only(['index', 'show']);
        $this->middleware(['permission:create-kelompok-tani'])->only(['create', 'store']);
        $this->middleware(['permission:update-kelompok-tani'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-kelompok-tani'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, KelompokTaniDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        $kelompokTani = KelompokTani::all();
       // $kecamatan = Kecamatan::all();
        $wkpp = Wkpp::all();
        //$penyuluh = Penyuluh::all();

        return view('admin.kelompok-tani.index', compact('kelompokTani', 'wkpp'));
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
            'nama_kelompok' => 'required',
            'username' => 'required|unique:users',
            'jumlah_anggota' =>'required',
            'luas_lahan' =>'required',
            'tanggal_kelompok' =>'required',
            'kelas_kelompok' => 'required',
            'badan_hukum' => 'required',
            'alamat_sekretariat' => 'required',
        ]);

        if ($validator->passes()) {
            DB::transaction(function() use($request){
                $user = User::create([
                    'username' => Str::lower($request->username),
                    'password' => Hash::make('kelompoktani'),
                ]);

                $user->assignRole('kelompok tani');

            KelompokTani::create([
                'user_id' => $user->id,
                'id_kelompok' => $request->id_kelompok,
                'nama_kelompok' =>$request->nama_kelompok,
                'jumlah_anggota' =>$request->jumlah_anggota,
                'luas_lahan' =>$request->luas_lahan,
                'tanggal_kelompok' =>$request->tanggal_kelompok,
                'kelas_kelompok' => $request->kelas_kelompok,
                'badan_hukum' => $request->badan_hukum,
                'alamat_sekretariat' => $request->alamat_sekretariat,
                'wkpp_id' => $request->wkpp_id,
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
        $kelompokTani = KelompokTani::with(['wkpp'])->findOrFail($id);
        return response()->json(['data' => $kelompokTani]);
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
            'nama_kelompok' => 'required',
            'username' => 'required|unique:users',
            'jumlah_anggota' =>'required',
            'luas_lahan' =>'required',
            'tanggal_kelompok' =>'required',
            'kelas_kelompok' => 'required',
            'badan_hukum' => 'required',
            'alamat_sekretariat' => 'required',
            
        ]);

        if ($validator->passes()) {
            KelompokTani::findOrFail($id)->update([
                'nama_kelompok' => $request->nama_kelompok,
                'jumlah_anggota' => $request->jumlah_anggota,
                'luas_lahan' => $request->luas_lahan,
                'tanggal_kelompok' => $request->kelas_kelompok,
                'kelas_kelompok' => $request->kelas_kelompok,
                'badan_hukum' => $request->badan_hukum,
                'alamat_sekretariat' => $request->alamat_sekretariat,
                'wkpp_id' => $request->wkpp_id,
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
        $kelompokTani = KelompokTani::findOrFail($id);
        User::findOrFail($kelompokTani->user_id)->delete();
        $kelompokTani->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
