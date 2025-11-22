<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Pelapor;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;


class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png|max:1024',
            'guest_id' => 'required|string' 
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $pelapor = Pelapor::firstOrCreate(
            ['guest_id' => $request->guest_id]
        );

        if ($pelapor->last_report_time && $pelapor->last_report_time->gt(Carbon::now()->subHour())) {
            return response()->json(['message' => 'Anda hanya dapat mengirim 1 laporan per jam.'], 429); // 429 maksud nya Too Many Requests
        }

        $fotoUrl = null;
        if ($request->hasFile('foto')) {
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => 'doanuwu94', 
                    'api_key'    => '344831262851575', 
                    'api_secret' => 'walbZptXW-wkdZg9LHyGUdo59cs',
                ],
                'url' => [
                    'secure' => true 
                ]
            ]);

            try {
                $upload = (new UploadApi())->upload($request->file('foto')->getRealPath(), [
                    'folder' => 'bisikkampus', 
                    'resource_type' => 'image'
                ]);

                $fotoUrl = $upload['secure_url'];
            } catch (\Exception $e) {
                return response()->json(['message' => 'Gagal upload gambar: ' . $e->getMessage()], 500);
            }
        }

        $laporan = Laporan::create([
            'pelapor_id' => $pelapor->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'foto_url' => $fotoUrl,
            'status' => 'Pending' 
        ]);

        $pelapor->last_report_time = Carbon::now();
        $pelapor->save();

        return redirect('/buat-laporan')->with('status', 'Laporan berhasil dikirim! Tunggu verifikasi admin ya.');
    }   
    
    public function index(Request $request)
    {
       
        $query = Laporan::whereIn('status', ['Ditanggapi', 'Selesai'])
                        ->with('pelapor', 'komentar');

    
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'LIKE', '%' . $search . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            });
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $laporanPublik = $query->orderBy('created_at', 'desc')->get();

        $trending = Laporan::whereIn('status', ['Ditanggapi', 'Selesai'])
                            ->withCount('komentar')
                            ->orderBy('komentar_count', 'desc')
                            ->take(5)
                            ->get();

        return view('beranda', [
            'semuaLaporan' => $laporanPublik,
            'trendingLaporan' => $trending
        ]);
    }

    public function show($id)
    {
        $laporan = Laporan::with([
            'pelapor', 
            'komentar.pelapor',         
            'komentar.balasan.pelapor'   
        ])->findOrFail($id);

        return view('detail_laporan', [
            'laporan' => $laporan
        ]);
    }

    public function storeKomentar(Request $request, $id)
    {
        $request->validate([
            'isi_komentar' => 'required|string|max:500',
            'guest_id' => 'required|string',
            'parent_komentar_id' => 'nullable|exists:komentar,id' 
        ]);

        $pelapor = Pelapor::firstOrCreate(
            ['guest_id' => $request->guest_id]
        );

        $laporan = Laporan::findOrFail($id);
        
        $laporan->komentar()->create([
            'pelapor_id' => $pelapor->id,
            'isi_komentar' => $request->isi_komentar,
            'parent_komentar_id' => $request->parent_komentar_id 
        ]);

        return redirect()->back()->with('status', 'Komentar berhasil ditambahkan!');
    }
}
