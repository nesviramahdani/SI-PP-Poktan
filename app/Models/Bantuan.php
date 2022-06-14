<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengajuan;

class Bantuan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
