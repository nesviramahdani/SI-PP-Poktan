<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Bantuan;
use App\Models\Kelompoktani;
use App\Models\Bpp;
use App\Models\Kecamatan;
use App\Models\Wkpp;
use App\Models\Komoditas;
use App\Models\Penyuluh;
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

        $role2 = Role::create([
            'name' => 'admin'
        ]);

        $role1->syncPermissions([
            'create-users', 'read-users', 'update-users', 'delete-users',
            'create-roles', 'read-roles', 'update-roles', 'delete-roles',
            'create-permissions', 'read-permissions', 'update-permissions', 'delete-permissions',
            'create-kecamatan', 'read-kecamatan', 'update-kecamatan', 'delete-kecamatan', 
            'create-wkpp', 'read-wkpp', 'update-wkpp', 'delete-wkpp', 
            'create-bpp', 'read-bpp', 'update-bpp', 'delete-bpp', 
            'create-bantuan', 'read-bantuan', 'update-bantuan', 'delete-bantuan', 
            'create-komoditas', 'read-komoditas', 'update-komoditas', 'delete-komoditas', 
            'create-anggota', 'read-anggota', 'update-anggota', 'delete-anggota', 
            'create-penyuluh', 'read-penyuluh', 'update-penyuluh', 'delete-penyuluh', 
            'create-kelompok-tani', 'read-kelompok-tani', 'update-kelompok-tani', 'delete-kelompok-tani', 
        ]);

        $role2 = Role::create([
            'name' => 'penyuluh'
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

       
		$user2 = User::create([
    		'username' => 'penyuluh123',
    		'email' => 'penyuluh@example.com',
    		'password' => Hash::make('password'),
    	]);

        $user2->assignRole('penyuluh');

        Penyuluh::create([
            'user_id' => $user2->id,
            'nip' => '197503302003121001',
            'nama_penyuluh' => 'Penyuluh',
            'jenis_kelamin' => 'Perempuan',
            'jabatan' => 'Ketua',
        ]);

        // seed BPP
        Bpp::create([
            'id_bpp' => 'BPP01',
            'nama_bpp' => 'BPP Marapallam',
        ]);
        Bpp::create([
            'id_bpp' => 'BPP02',
            'nama_bpp' => 'BPP Nanggalo',
        ]);
        Bpp::create([
            'id_bpp' => 'BPP03',
            'nama_bpp' => 'BPP Koto Tangah',
        ]);
        Bpp::create([
            'id_bpp' => 'BPP04',
            'nama_bpp' => 'BPP 12',
        ]);

        // seed WKPP
        Wkpp::create([
            'id_wkpp' => 'WKPP'.Str::upper(Str::random(5)),
            'nama_wkpp' => 'Padang Timur',
        ]);
        Wkpp::create([
            'id_wkpp' => 'WKPP'.Str::upper(Str::random(5)),
            'nama_wkpp' => 'Padang Selatan',
        ]);
        Wkpp::create([
            'id_wkpp' => 'WKPP'.Str::upper(Str::random(5)),
            'nama_wkpp' => 'Batu Gadang',
        ]);
        Wkpp::create([
            'id_wkpp' => 'WKPP'.Str::upper(Str::random(5)),
            'nama_wkpp' => 'Indarung',
        ]);

        // seed Kecamatan
        Kecamatan::create([
            'id_kecamatan' => 'KEC01',
            'nama_kecamatan' => 'Padang Timur',
        ]);
        Kecamatan::create([
            'id_kecamatan' => 'KEC02',
            'nama_kecamatan' => 'Padang Selatan',
        ]);
        Kecamatan::create([
            'id_kecamatan' => 'KEC03',
            'nama_kecamatan' => 'Lubuk Begalung',
        ]);
        Kecamatan::create([
            'id_kecamatan' => 'KEC04',
            'nama_kecamatan' => 'Pauh',
        ]);

        // seed Komoditas
        komoditas::create([
            'id_komoditas' => 'KDT'.Str::upper(Str::random(5)),
            'nama_komoditas' => 'Padi',
        ]);
        Komoditas::create([
            'id_komoditas' => 'KDT'.Str::upper(Str::random(5)),
            'nama_komoditas' => 'Jagung',
        ]);
        Komoditas::create([
            'id_komoditas' => 'KDT'.Str::upper(Str::random(5)),
            'nama_komoditas' => 'Kedelai',
        ]);
        Komoditas::create([
            'id_komoditas' => 'KDT'.Str::upper(Str::random(5)),
            'nama_komoditas' => 'Kacang Tanah',
        ]);

        // seed Bantuan
        Bantuan::create([
            'id_bantuan' => 'BTN'.Str::upper(Str::random(5)),
            'jenis_bantuan' => 'lainnya..',
        ]);
        Bantuan::create([
            'id_bantuan' => 'BTN'.Str::upper(Str::random(5)),
            'jenis_bantuan' => 'Alat',
        ]);
        Bantuan::create([
            'id_bantuan' => 'BTN'.Str::upper(Str::random(5)),
            'jenis_bantuan' => 'Bibit',
        ]);
        Bantuan::create([
            'id_bantuan' => 'BTN'.Str::upper(Str::random(5)),
            'jenis_bantuan' => 'Pupuk',
        ]);

    }
}
