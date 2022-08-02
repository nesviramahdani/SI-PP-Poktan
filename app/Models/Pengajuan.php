<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelompoktani;


class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuanbantuan';
    protected $guarded = [];

    public function kelompoktani()
    {
        return $this->hasOne(Kelompoktani::class, 'id', 'kelompoktani_id');
    }

}
