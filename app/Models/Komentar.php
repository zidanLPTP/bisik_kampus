<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelapor;
use App\Models\Laporan;

class Komentar extends Model
{

    protected $table = 'komentar';
    
    // yang boleh di isi ini
    protected $fillable = [
        'laporan_id',
        'pelapor_id',
        'parent_komentar_id',
        'isi_komentar',
    ];

    // satu komen milik satu pelapor
    public function pelapor()
    {
        return $this->belongsTo(Pelapor::class, 'pelapor_id');
    }

    // satu komen bisa banyak balasan
    public function balasan()
    {
        return $this->hasMany(Komentar::class, 'parent_komentar_id');
    }

    // satu komen dimiliki 1 laporan
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    //satu komen (balas) punya satu komen induk
    public function induk()
    {
        return $this->belongsTo(Komentar::class, 'parent_komentar_id');
    }
}
