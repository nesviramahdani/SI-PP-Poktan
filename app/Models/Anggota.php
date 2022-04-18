<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KelompokTani;

class Anggota extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function kelompokTani()
    {
        return $this->belongsTo(KelompokTani::class);
    }
}
