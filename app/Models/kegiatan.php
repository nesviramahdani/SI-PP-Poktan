<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KelompokTani;

class kegiatan extends Model
{
    use HasFactory;
    protected $table = 'jadwal_kegiatans';
    protected $fillable = [
        'kelompok_tani_id',
    	'nama_kegiatan',
    	'tanggal',
    	'jam_mulai',
    	'jam_selesai',
        'lokasi',
    ];
    
    public function kelompoktani()
    {
        return $this->belongsTo(KelompokTani::class);
    }
}
