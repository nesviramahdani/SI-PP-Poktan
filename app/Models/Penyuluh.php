<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\kelompoktani;


class Penyuluh extends Model
{
    use HasFactory;
    protected $table = 'penyuluh';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelompoktani()
    {
        return $this->hasmany(kelompoktani::class);
    }
   


}
