<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelompoktani;

use App\Models\Wkpp;
use App\Models\Penyuluh;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\KelompokTaniDataTable;
use App\Models\Anggota;
use App\Models\Bpp;

class KelompoktaniController extends Controller
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
    public function index(Request $request, KelompoktaniDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        $kelompoktani = Kelompoktani::all();;
        $wkpp = Wkpp::all();
        $penyuluh = Penyuluh::all();
        $bpp = Bpp::all();

        return view('admin.kelompok-tani.index', compact('kelompoktani', 'wkpp', 'bpp', 'penyuluh'));
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
            'username' => 'required|unique:users',
            'id_kelompoktani' => 'required|unique:kelompoktani',
            'nama_kelompoktani' => 'required',
            'tanggal_terbentuk' =>'required',
            'wkpp_id' => 'required',
        ]);

        if ($validator->passes()) {
            DB::transaction(function() use($request){
                $user = User::create([
                    'username' => Str::lower($request->username),
                    'password' => Hash::make('password'),
                ]);

                $user->assignRole('kelompoktani');
            Kelompoktani::create([
                'user_id' => $user->id,
                'id_kelompoktani' =>$request->id_kelompoktani,
                'nama_kelompoktani' =>$request->nama_kelompoktani,
                'tanggal_terbentuk' =>$request->tanggal_terbentuk,
                'kelas_kelompok' =>$request->kelas_kelompok,
                'badan_hukum' =>$request->badan_hukum,
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
        $kelompoktani = Kelompoktani::with(['wkpp'])->findOrFail($id);
        return response()->json(['data' => $kelompoktani]);
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
            'nama_kelompoktani' => 'required',
            'tanggal_terbentuk' =>'required',
            'wkpp_id' => 'required',
            
        ]);

        if ($validator->passes()) {
            KelompokTani::findOrFail($id)->update([
                'nama_kelompoktani' =>$request->nama_kelompoktani,
                'tanggal_terbentuk' =>$request->tanggal_terbentuk,
                'kelas_kelompok' =>$request->kelas_kelompok,
                'badan_hukum' =>$request->badan_hukum,
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
        $kelompoktani = Kelompoktani::findOrFail($id);
        User::findOrFail($kelompoktani->user_id)->delete();
        $kelompoktani->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }

    public function datakelompoktani()
    {
        $wkpp_id = collect([]);
        $wkpp = Wkpp::where('penyuluh_id', Auth::user()->penyuluh->id)->get();
        foreach($wkpp as $new){
            $wkpp_id->push($new->id);
    }
        $kelompoktani = Kelompoktani::whereIn('wkpp_id', $wkpp_id)->get();
        return view('admin.kelompok-tani.datakelompoktani', compact('kelompoktani'));
    }
}
