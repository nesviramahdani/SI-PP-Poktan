<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KelompokTani;
use App\Models\Komoditas;

class Produksi extends Model
{
    use HasFactory;
    protected $table = 'produksi';
    protected $guarded = [];

    public function kelompoktani()
    {
        return $this->belongsTo(KelompokTani::class);
    }

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class);
    }
}
