<?php

namespace App\Models;
use App\Models\Produksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    use HasFactory;

    protected $fillable = [
    	'id_komoditas',
    	'nama_komoditas',
    ];

    public function produksi()
    {
        return $this->hasMany(Produksi::class);
    }
}
