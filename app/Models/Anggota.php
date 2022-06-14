<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelompoktani;


class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $guarded = [];

    public function kelompoktani()
    {
        return $this->belongsTo(Kelompoktani::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
