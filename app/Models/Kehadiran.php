<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anggota;
use App\Models\Kegiatan;

class Kehadiran extends Model
{
    use HasFactory;
    protected $table = 'kehadiran';
    protected $guarded = [];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
