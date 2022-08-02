<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produksi;
use App\Models\User;
use App\Models\Wkpp;
use App\Models\Anggota;
use App\Models\Pengajuan;

class Kelompoktani extends Model
{
    use HasFactory;
    protected $table = 'kelompoktani';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wkpp()
    {
        return $this->belongsTo(Wkpp::class);
    }

    public function produksi()
    {
        return $this->hasMany(Produksi::class);
    }

    public function detail()
    {
        return $this->hasMany(Detailkegiatan::class, 'kelompoktani_id', 'id');
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'kelompoktani_id', 'id' );
    }
}
