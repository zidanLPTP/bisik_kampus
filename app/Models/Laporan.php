<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelapor;
use App\Models\Komentar;
use App\Models\Moderasi;

class Laporan extends Model
{

    protected $table = 'laporan';

    // ini yang boleh di isi
    protected $fillable = 
    [
        'pelapor_id',
        'judul',
        'deskripsi',
        'kategori',
        'lokasi',
        'foto_url',
        'status',
    ];

    // satu laporan dimiliki oleh satu pelapor
    public function pelapor()
    {
        return $this->belongsTo(Pelapor::class, 'pelapor_id');
    }

    // satu laporan bisa banyak komentar
    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'laporan_id')
                    ->orderBy('created_at', 'desc');
    }

    // satu laporan bisa banyak log mod
    public function moderasi()
    {
        return $this->hasMany(Moderasi::class, 'laporan_id');
    }

}