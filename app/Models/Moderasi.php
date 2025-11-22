<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Moderasi extends Model
{
    // yang bisa di isi
    protected $fillable = [
        'laporan_id',
        'admin_id',
        'status_diubah',
        'catatan',
    ];

    // satu log mod punya satu 
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    // satu mod dibuat satu admin
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
