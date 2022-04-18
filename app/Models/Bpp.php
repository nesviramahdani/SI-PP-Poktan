<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kecamatan;
use App\Models\Penyuluh;

class Bpp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function penyuluh()
    {
        return $this->hasMany(Penyuluh::class);
    }

   
}
