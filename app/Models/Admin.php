<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembayaran;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = [
    	'user_id',
    	'id_admin',
    	'nama_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
