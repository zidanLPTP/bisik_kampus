<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan; 

class AdminController extends Controller
{

    public function dashboard()
    {
        $laporanPending = Laporan::where('status', 'Pending')
                                 ->with('pelapor')
                                 ->orderBy('created_at', 'asc')
                                 ->get();

        $laporanArsip = Laporan::whereIn('status', ['Ditanggapi', 'Selesai'])
                               ->with('pelapor')
                               ->orderBy('updated_at', 'desc') 
                               ->get();

        return view('dashboard', [
            'laporanButuhVerifikasi' => $laporanPending,
            'laporanArsip' => $laporanArsip 
        ]);
    }

    public function verifikasi($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'Ditanggapi';
        $laporan->save();
        
        return redirect()->back()->with('success', 'Laporan berhasil diverifikasi dan tayang di publik!');
    }
    
    public function hapusKomentar($id)
    {
        $komentar = \App\Models\Komentar::findOrFail($id);

        $komentar->delete();

        return redirect()->back()->with('status', 'Komentar berhasil dihapus dari muka bumi!');
    }

    public function selesai($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'Selesai';
        $laporan->save();

        return redirect()->back()->with('status', 'Kasus ditutup! Laporan ditandai Selesai.');
    }
}