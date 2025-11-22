<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 group">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px; width: auto;">
                
                <span style="color: #6C63FF; font-weight: 800; font-size: 20px;">
                    BisikKampus Admin
                </span>
            </a>
            
            <a href="/" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-bold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150 gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Ke Beranda Publik
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 mb-10">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <div class="p-2 bg-gray-100 rounded-lg text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Laporan Baru Masuk</h3>
                            <p class="text-sm text-gray-500">Daftar laporan yang menunggu verifikasi.</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200 table-fixed">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-1/6">Tanggal</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-1/6">Pelapor</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-2/6">Isi Laporan</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-1/6">Bukti</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-1/6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse ($laporanButuhVerifikasi as $laporan)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-600 text-center align-middle">
                                            <div class="font-medium">{{ $laporan->created_at->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-400">{{ $laporan->created_at->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-center align-middle">
                                            <div class="text-sm font-bold text-gray-800">{{ $laporan->pelapor->guest_id }}</div>
                                            <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-bold text-gray-500 bg-gray-100 rounded border border-gray-200 uppercase">
                                                {{ $laporan->kategori }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center align-middle">
                                            <div class="text-sm font-bold text-gray-900 mb-1">{{ $laporan->judul }}</div>
                                            <div class="text-sm text-gray-500 line-clamp-2 leading-relaxed">{{ $laporan->deskripsi }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-center align-middle">
                                            @if($laporan->foto_url)
                                                <a href="{{ $laporan->foto_url }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline">
                                                    Lihat Foto
                                                </a>
                                            @else
                                                <span class="text-gray-300">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center align-middle">
                                            <form action="/laporan/{{ $laporan->id }}/verifikasi" method="POST" onsubmit="return confirm('Verifikasi laporan ini agar tampil di publik?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" style="background-color: #2563eb; color: white;" class="w-full py-2 px-4 rounded-lg text-xs font-bold shadow-sm transition hover:opacity-90">
                                                    ✓ Verifikasi
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic bg-gray-50 rounded-lg border border-dashed border-gray-200">
                                            Tidak ada laporan baru yang perlu diverifikasi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <div class="p-2 bg-gray-100 rounded-lg text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Riwayat Penanganan</h3>
                            <p class="text-sm text-gray-500">Arsip laporan yang sedang diproses atau sudah selesai.</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200 table-fixed">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-1/6">Tanggal</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-2/6">Detail Laporan</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-1/6">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-2/6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse ($laporanArsip as $laporan)
                                    <tr class="{{ $laporan->status == 'Selesai' ? 'bg-gray-50' : 'hover:bg-gray-50' }} transition">
                                        <td class="px-6 py-4 text-sm text-gray-600 text-center align-middle">
                                            {{ $laporan->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-center align-middle">
                                            <div class="text-sm font-bold text-gray-900">{{ $laporan->judul }}</div>
                                            <div class="text-xs text-gray-400 mt-1">Oleh: {{ $laporan->pelapor->guest_id }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-center align-middle">
                                            @if($laporan->status == 'Ditanggapi')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                                    <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span> Proses
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center align-middle">
                                            @if($laporan->status == 'Ditanggapi')
                                                <form action="/laporan/{{ $laporan->id }}/selesai" method="POST" onsubmit="return confirm('Tandai kasus ini selesai?');">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" style="color: #16a34a; border: 1px solid #bbf7d0; background-color: #f0fdf4;" class="px-4 py-2 rounded-lg text-xs font-bold shadow-sm hover:bg-green-100 transition">
                                                        🏁 Tandai Selesai
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-xs font-medium italic">Closed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic">Belum ada riwayat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>