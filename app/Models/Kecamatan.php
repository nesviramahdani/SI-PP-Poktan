<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bpp;

class Kecamatan extends Model
{
    use HasFactory;
    // protected $table = 'kecamatan';
    protected $guarded = [];

    public function bpp()
    {
        return $this->belongsTo(Bpp::class, 'bpp_id');
    }
}