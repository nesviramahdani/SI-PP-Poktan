<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kecamatan;
use App\Models\Penyuluh;
use App\Models\Wkpp;
use App\Models\Anggota;
use App\Models\kegiatan;

class KelompokTani extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $fillable = [
    //     'user_id',
    // 	'id_kelompok',
    // 	'nama_kelompok',
    // 	'kelas_kelompok',
    // 	'badan_hukum',
    //     'alamat_sekretariat',
    // 	'wkpp_id',
    // 	'kecamatan_id',
    // 	'penyuluh_id',
    // ];


   

    public function wkpp()
    {
        return $this->belongsTo(Wkpp::class);
    }
   

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    public function kegiatan()
    {
        return $this->hasMany(kegiatan::class);
    }
}
