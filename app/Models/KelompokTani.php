<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produksi;
use App\Models\Jadwal;
use App\Models\Penyuluh;
use App\Models\Wkpp;
use App\Models\Bpp;
use App\Models\Kecamatan;
use App\Models\Anggota;
use App\Models\Pengajuan;

class Kelompoktani extends Model
{
    use HasFactory;
    protected $table = 'kelompoktani';
    protected $guarded = [];

    public function penyuluh()
    {
        return $this->belongsTo(Penyuluh::class);
    }

    public function wkpp()
    {
        return $this->belongsTo(Wkpp::class);
    }

    public function bpp()
    {
        return $this->belongsTo(Bpp::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function produksi()
    {
        return $this->hasMany(Produksi::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
