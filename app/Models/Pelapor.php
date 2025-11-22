<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Laporan;
use App\Models\Komentar;

class Pelapor extends Model
{
    use HasFactory;

    protected $table = 'pelapor';

    protected $fillable = [
        'guest_id',
        'last_report_time',
    ];

    protected $casts = [
        'last_report_time' => 'datetime',
    ];
    // -----------------------------

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'pelapor_id');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'pelapor_id');
    }
}