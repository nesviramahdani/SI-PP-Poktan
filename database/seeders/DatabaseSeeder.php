<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\KelompokTani;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        // seed permission

        
        // users
        Permission::create([
            'name' => 'create-users',
        ]);

        Permission::create([
            'name' => 'read-users',
        ]);

        Permission::create([
            'name' => 'update-users',
        ]);

        Permission::create([
            'name' => 'delete-users',
        ]);
        
        // roles
        Permission::create([
            'name' => 'create-roles',
        ]);

        Permission::create([
            'name' => 'read-roles',
        ]);

        Permission::create([
            'name' => 'update-roles',
        ]);

        Permission::create([
            'name' => 'delete-roles',
        ]);

        // permissions
        Permission::create([
            'name' => 'create-permissions',
        ]);

        Permission::create([
            'name' => 'read-permissions',
        ]);

        Permission::create([
            'name' => 'update-permissions',
        ]);

        Permission::create([
            'name' => 'delete-permissions',
        ]);

        
        

        // seed role
        $role1 = Role::create([
            'name' => 'admin'
        ]);

        // kecamatan
        Permission::create([
            'name' => 'create-kecamatan',
        ]);

        Permission::create([
            'name' => 'read-kecamatan',
        ]);

        Permission::create([
            'name' => 'update-kecamatan',
        ]);

        Permission::create([
            'name' => 'delete-kecamatan',
        ]);

        // wkpp
        Permission::create([
            'name' => 'create-wkpp',
        ]);

        Permission::create([
            'name' => 'read-wkpp',
        ]);

        Permission::create([
            'name' => 'update-wkpp',
        ]);

        Permission::create([
            'name' => 'delete-wkpp',
        ]);

        // bpp
        Permission::create([
            'name' => 'create-bpp',
        ]);

        Permission::create([
            'name' => 'read-bpp',
        ]);

        Permission::create([
            'name' => 'update-bpp',
        ]);

        Permission::create([
            'name' => 'delete-bpp',
        ]);

        // bantuan
        Permission::create([
            'name' => 'create-bantuan',
        ]);

        Permission::create([
            'name' => 'read-bantuan',
        ]);

        Permission::create([
            'name' => 'update-bantuan',
        ]);

        Permission::create([
            'name' => 'delete-bantuan',
        ]);

        // anggota
        Permission::create([
            'name' => 'create-anggota',
        ]);

        Permission::create([
            'name' => 'read-anggota',
        ]);

        Permission::create([
            'name' => 'update-anggota',
        ]);

        Permission::create([
            'name' => 'delete-anggota',
        ]);

        // penyuluh
        Permission::create([
            'name' => 'create-penyuluh',
        ]);

        Permission::create([
            'name' => 'read-penyuluh',
        ]);

        Permission::create([
            'name' => 'update-penyuluh',
        ]);

        Permission::create([
            'name' => 'delete-penyuluh',
        ]);

        // kelompok tani
        Permission::create([
            'name' => 'create-kelompok-tani',
        ]);

        Permission::create([
            'name' => 'read-kelompok-tani',
        ]);

        Permission::create([
            'name' => 'update-kelompok-tani',
        ]);

        Permission::create([
            'name' => 'delete-kelompok-tani',
        ]);

        $role1->syncPermissions([
            'create-users', 'read-users', 'update-users', 'delete-users',
            'create-roles', 'read-roles', 'update-roles', 'delete-roles',
            'create-permissions', 'read-permissions', 'update-permissions', 'delete-permissions',
            'create-kecamatan', 'read-kecamatan', 'update-kecamatan', 'delete-kecamatan', 
            'create-wkpp', 'read-wkpp', 'update-wkpp', 'delete-wkpp', 
            'create-bpp', 'read-bpp', 'update-bpp', 'delete-bpp', 
            'create-bantuan', 'read-bantuan', 'update-bantuan', 'delete-bantuan', 
            'create-anggota', 'read-anggota', 'update-anggota', 'delete-anggota', 
            'create-penyuluh', 'read-penyuluh', 'update-penyuluh', 'delete-penyuluh', 
            'create-kelompok-tani', 'read-kelompok-tani', 'update-kelompok-tani', 'delete-kelompok-tani', 
        ]);

        $role2 = Role::create([
            'name' => 'admin'
        ]);

        $role2->syncPermissions([
            'create-users', 'read-users', 'update-users', 'delete-users',
            'create-roles', 'read-roles', 'update-roles', 'delete-roles',
            'create-permissions', 'read-permissions', 'update-permissions', 'delete-permissions',
            'create-kecamatan', 'read-kecamatan', 'update-kecamatan', 'delete-kecamatan', 
            'create-wkpp', 'read-wkpp', 'update-wkpp', 'delete-wkpp', 
        ]);

        $role3 = Role::create([
            'name' => 'kelompok tani'
        ]);

        

    	$user1 = User::create([
    		'username' => 'admin123',
    		'email' => 'admin@example.com',
    		'password' => Hash::make('password'),
    	]);

        $user1->assignRole('admin');

        // $petugas1 = Admin::create([
        //     'user_id' => $user1->id,
        //     'id_admin' => 'PTG'.Str::upper(Str::random(5)),
        //     'nama_admin' => 'Administrator',
        // ]);

		$user2 = User::create([
    		'username' => 'elaina123',
    		'email' => 'elaina@example.com',
    		'password' => Hash::make('password'),
    	]);

        $user2->assignRole('admin');

        // $petugas2 = Admin::create([
        //     'user_id' => $user2->id,
        //     'id_admin' => 'PTG'.Str::upper(Str::random(5)),
        //     'nama_admin' => 'Elaina San',
        // ]);

    	
        // \App\Models\User::factory(10)->create();
    }
}
