<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailkegiatan extends Model
{
    use HasFactory;
    protected $table = 'detailkegiatan';
    protected $guarded = []; 

    public function kelompoktani()
    {
        return $this->hasOne(Kelompoktani::class, 'id', 'kelompoktani_id');
    }

    public function kegiatan()
    {
        return $this->hasOne(Kegiatan::class, 'id', 'kegiatan_id', 'tanggal_kegiatan');
    }

    public function foto()
    {
        return $this->hasMany(Foto::class);
    }
}
