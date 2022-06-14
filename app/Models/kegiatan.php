<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelompoktani;
use App\Models\Periode;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';

    protected $guarded = [];

    public function kelompoktani()
    {
        return $this->belongsTo(Kelompoktani::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

}
