<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\DataTables\AdminListDataTable;

class AdminListController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:read-admin'])->only(['index', 'show']);
        $this->middleware(['permission:create-admin'])->only(['create', 'store']);
        $this->middleware(['permission:update-admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-admin'])->only(['destroy']);
    }


    public function index(Request $request, AdminListDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

    	return view('admin.admin-list.index');
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'username' => 'required|unique:users',
    		'nama_admin' => 'required',
    	]);

    	if ($validator->passes()) {
            DB::transaction(function() use($request){
                $user = User::create([
                    'username' => Str::lower($request->username),
                    'password' => Hash::make('password'),
                ]);

                $user->assignRole('admin');

                Admin::create([
                    'user_id' => $user->id,
                    'id_admin' => 'ADMIN'.Str::upper(Str::random(5)),
                    'nama_admin' => $request->nama_admin,
                ]);
            });

            return response()->json(['message' => 'Data berhasil disimpan!']);
    	}

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function edit($id)
    {
    	$admin = Admin::findOrFail($id);
        return response()->json(['data' => $admin]);
    }

    public function update($id, Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'nama_admin' => 'required',
    	]);

    	if ($validator->passes()) {
            Admin::where('user_id', $id)->update([
                'nama_admin' => $request->nama_admin,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
    	}

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function destroy($id)
    {
    	$admin = Admin::findOrFail($id);
        User::findOrFail($admin->user_id)->delete();
        $admin->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
