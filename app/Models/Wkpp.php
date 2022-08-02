<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penyuluh;
use App\Models\Kelompoktani;

class Wkpp extends Model
{
    use HasFactory;
    protected $table = 'wkpp';
    protected $guarded = [];

    public function kelompoktani()
    {
    	return $this->hasMany(Kelompoktani::class);
    }

    public function penyuluh()
    {
    	return $this->belongsTo(Penyuluh::class);
    }
}
