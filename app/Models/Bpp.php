<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penyuluh;


class Bpp extends Model
{
    use HasFactory;
    protected $table = 'bpp';
    protected $guarded = [];

    public function penyuluh()
    {
        return $this->hasmany(Penyuluh::class);
    }
   
}
