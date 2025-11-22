<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BisikKampus - Beranda</title>
    <style>
        /* --- VARIABLES --- */
        :root {
            --primary: #6C63FF;
            --primary-light: #F0EFFF;
            --bg-body: #F8F9FA;
            --text-dark: #2D3748;
            --text-gray: #718096;
            --white: #ffffff;
            --shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* --- RESET & GLOBAL --- */
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: var(--bg-body);
            color: var(--text-dark);
        }
        a { text-decoration: none; color: inherit; transition: 0.2s; }
        ul { list-style: none; padding: 0; margin: 0; }

        /* --- SVG ICONS SETUP --- */
        /* Ini kelas baru agar ikon ukurannya pas */
        .icon {
            width: 24px;
            height: 24px;
            stroke-width: 1.5; /* Ketebalan garis */
            stroke: currentColor; /* Warnanya ikut warna teks */
            fill: none;
            display: inline-block;
            vertical-align: middle;
        }
        .icon-sm { width: 18px; height: 18px; }

        /* --- NAVBAR (TOP) --- */
        .navbar {
            background: var(--white);
            height: 64px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
        }
        .nav-left { display: flex; align-items: center; gap: 15px; }
        .nav-logo {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.5px;
            display: flex; align-items: center; gap: 8px;
        }
        .nav-search {
            background: var(--bg-body);
            border-radius: 12px;
            padding: 10px 20px;
            border: 1px solid transparent;
            width: 280px;
            outline: none;
            color: var(--text-dark);
            transition: 0.2s;
            display: none;
        }
        .nav-search:focus {
            background: var(--white);
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }
        .nav-icon-btn {
            width: 40px; height: 40px;
            border-radius: 12px;
            background: var(--bg-body);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-dark);
            cursor: pointer;
        }
        .nav-icon-btn:hover { background: var(--primary-light); color: var(--primary); }
        
        /* --- LAYOUT UTAMA --- */
        .main-layout {
            display: flex;
            justify-content: center;
            padding-top: 80px;
            padding-bottom: 40px;
            min-height: 100vh;
            gap: 30px;
        }

        .sidebar-left {
            width: 280px;
            position: fixed;
            left: 20px;
            top: 80px;
            height: calc(100vh - 90px);
            overflow-y: auto;
            display: none;
        }

        .feed-center {
            width: 100%;
            max-width: 600px;
            padding: 0 10px;
        }

        .sidebar-right {
            width: 280px;
            position: fixed;
            right: 20px;
            top: 80px;
            display: none;
        }

        @media (min-width: 1100px) {
            .sidebar-left, .sidebar-right { display: block; }
            .nav-search { display: block; }
        }

        /* --- UI COMPONENTS --- */
        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            color: var(--text-gray);
            margin-bottom: 5px;
            gap: 12px; /* Jarak ikon ke teks */
        }
        .menu-item:hover { 
            background-color: var(--white); 
            color: var(--primary); 
            box-shadow: var(--shadow);
        }
        .menu-item.active {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        /* Create Post */
        .create-post-card {
            background: var(--white);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            box-shadow: var(--shadow);
            border: 1px solid #eee;
            display: flex; flex-direction: column; gap: 15px;
        }
        .create-input-row { display: flex; gap: 12px; align-items: center; }
        .fake-input {
            background: var(--bg-body);
            border-radius: 25px;
            padding: 12px 20px;
            flex-grow: 1;
            color: var(--text-gray);
            font-size: 15px;
            cursor: pointer;
            transition: 0.2s;
        }
        .fake-input:hover { background: #eee; }
        
        .create-actions {
            border-top: 1px solid #f0f0f0;
            padding-top: 12px;
            display: flex; gap: 10px;
        }
        .action-pill {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            display: flex; align-items: center; gap: 6px;
            cursor: pointer;
            transition: 0.2s;
            background: var(--bg-body);
            color: var(--text-gray);
        }
        .action-pill:hover { background: var(--primary-light); color: var(--primary); }

        /* Post Card */
        .post-card {
            background: var(--white);
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            border: 1px solid #eee;
            overflow: hidden;
        }
        .post-header { padding: 16px; display: flex; align-items: center; }
        .avatar { width: 42px; height: 42px; border-radius: 50%; margin-right: 12px; object-fit: cover; }
        .post-info h4 { margin: 0; font-size: 15px; font-weight: 700; color: var(--text-dark); }
        .post-info span { font-size: 13px; color: var(--text-gray); }
        
        .category-badge {
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 6px;
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 700;
            margin-left: 6px;
            text-transform: uppercase;
        }

        .post-content { padding: 0 16px 16px; font-size: 15px; line-height: 1.6; color: #1c1e21; }
        .post-image { width: 100%; display: block; max-height: 500px; object-fit: cover; background: #f0f0f0; }
        
        .post-stats {
            padding: 12px 16px;
            border-bottom: 1px solid #f0f0f0;
            display: flex; justify-content: space-between;
            color: var(--text-gray); font-size: 13px;
        }
        
        .post-actions {
            padding: 6px;
            display: flex;
            justify-content: space-around;
        }
        .post-action-btn {
            flex-grow: 1;
            padding: 10px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            color: var(--text-gray);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }
        .post-action-btn:hover { background: var(--bg-body); color: var(--text-dark); }
        
        .sidebar-title {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 15px;
            padding-left: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-left">
            <a href="/" class="nav-logo" style="display: flex; align-items: center; gap: 10px;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BisikKampus" style="height: 45px; width: auto;">
                <span style="font-size: 20px; font-weight: 800; color: var(--primary);">BisikKampus</span>
            </a>
            <form action="/" method="GET">
                <input type="text" name="search" class="nav-search" placeholder="Cari laporan..." value="{{ request('search') }}">
            </form>
        </div>
        <div style="display: flex; gap: 12px;">
            @auth
                <a href="/dashboard" class="nav-icon-btn" title="Dashboard Admin">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </a>
            @endauth
            <div class="nav-icon-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
        </div>
    </nav>

    <div class="main-layout">

        <div class="sidebar-left">
            <div style="margin: 20px 0 10px 12px; font-weight: 700; font-size: 12px; color: var(--text-gray); text-transform: uppercase; letter-spacing: 1px;">Topik Panas</div>

            <a href="/?kategori=akademik" class="menu-item {{ request('kategori') == 'akademik' ? 'active' : '' }}">
                <span class="menu-icon">📚</span> Akademik & Tugas
            </a>
            <a href="/?kategori=cinta" class="menu-item {{ request('kategori') == 'cinta' ? 'active' : '' }}">
                <span class="menu-icon">💘</span> Love Life
            </a>
            <a href="/?kategori=horror" class="menu-item {{ request('kategori') == 'horror' ? 'active' : '' }}">
                <span class="menu-icon">👻</span> Horror Kampus
            </a>
            <a href="/?kategori=info" class="menu-item {{ request('kategori') == 'info' ? 'active' : '' }}">
                <span class="menu-icon">📢</span> Info Kehilangan
            </a>
            <a href="/?kategori=rant" class="menu-item {{ request('kategori') == 'rant' ? 'active' : '' }}">
                <span class="menu-icon">🤬</span> Sambat/Rant
            </a>
        </div>

        <div class="feed-center">

            <a href="/buat-laporan" class="create-post-card">
                <div class="create-input-row">
                    <img src="https://ui-avatars.com/api/?name=Me&background=E0EFFF&color=6C63FF" class="avatar">
                    <div class="fake-input">Lagi mikirin apa? Spill sini dong...</div>
                </div>
                <div class="create-actions">
                    <div class="action-pill" style="color: #45bd62;">📸 Pap Foto</div>
                    <div class="action-pill" style="color: #f5533d;">📍 Spill Lokasi</div>
                    <div class="action-pill" style="color: #f7b928;">😎 Anonim</div>
                </div>
            </a>

            @foreach ($semuaLaporan as $laporan)
            <div class="post-card">
                <div class="post-header">
                    <img src="https://ui-avatars.com/api/?name={{ $laporan->pelapor->guest_id }}&background=random" class="avatar">
                    <div class="post-info">
                        <h4>
                            {{ $laporan->pelapor->guest_id }}
                            <span class="category-badge">{{ $laporan->kategori }}</span>
                            @if($laporan->status == 'Selesai')
                                <span style="font-size: 10px; padding: 2px 8px; border-radius: 6px; background: #d1fae5; color: #065f46; font-weight: 700; margin-left: 6px; border: 1px solid #34d399;">
                                    ✅ SELESAI
                                </span>
                            @endif
                        </h4>
                        <span>{{ $laporan->created_at->diffForHumans() }} · 📍 {{ $laporan->lokasi ?? 'Kampus' }}</span>
                    </div>
                </div>

                <div class="post-content">
                    <h3 style="font-size: 16px; margin-bottom: 8px; font-weight: 700;">{{ $laporan->judul }}</h3>
                    <p>{{ $laporan->deskripsi }}</p>
                </div>

                @if ($laporan->foto_url)
                    <img src="{{ $laporan->foto_url }}" class="post-image" alt="Bukti">
                @endif

                <div class="post-stats">
                    <span>👍 0 Suka</span>
                    <span>{{ $laporan->komentar->count() }} Komentar</span>
                </div>

                <div class="post-actions">
                    <div class="post-action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-sm" style="margin-right:5px;">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.247-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                        </svg>
                        Suka
                    </div>
                    
                    <a href="/laporan/{{ $laporan->id }}" class="post-action-btn" style="text-decoration: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-sm" style="margin-right:5px;">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                        </svg>
                        Komentar
                    </a>

                    <div class="post-action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-sm" style="margin-right:5px;">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                        </svg>
                        Bagikan
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="sidebar-right">
            <div class="sidebar-title">🔥 Sedang Hangat</div>
            
            @foreach ($trendingLaporan as $index => $trend)
            <a href="/laporan/{{ $trend->id }}" class="menu-item" style="align-items: flex-start; text-decoration: none; gap: 10px;">
                <span style="font-size: 18px; font-weight: bold; color: var(--primary);">#{{ $index + 1 }}</span>
                <div>
                    <div style="font-weight: 600; font-size: 14px; color: var(--text-dark);">
                        {{ Str::limit($trend->judul, 30) }}
                    </div>
                    <div style="font-size: 12px; color: var(--text-gray);">
                        {{ $trend->komentar_count }} Komentar
                    </div>
                </div>
            </a>
            @endforeach

            <div style="margin-top: 20px; font-size: 12px; color: #ccc; padding-left: 10px;">
                &copy; 2025 BisikKampus.<br>
                Kelompok 2 TI UNRI.
            </div>
        </div>

    </div>

</body>
</html>