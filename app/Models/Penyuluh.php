<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Wkpp;


class Penyuluh extends Model
{
    use HasFactory;
    protected $table = 'penyuluh';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wkpp()
    {
        return $this->hasmany(Wkpp::class);
    }
   
    public function bpp()
    {
        return $this->belongsTo(Bpp::class);
    }


}
