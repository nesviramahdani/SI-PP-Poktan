<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penyuluh;

class Wkpp extends Model
{
    use HasFactory;
    protected $table = 'wkpp';
    protected $guarded = [];

    public function kelompokTani()
    {
    	return $this->hasMany(KelompokTani::class);
    }
}
