<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $laporan->judul }} - BisikKampus</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:title" content="BisikKampus - Lapor Masalah Kampus">
    <style>
        /* --- CSS GLOBAL --- */
        * { box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; margin: 0; background: #f0f2f5; color: #050505; }
        a { text-decoration: none; color: inherit; }

        /* NAVBAR */
        .navbar { background: #fff; height: 56px; padding: 0 16px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 1px 2px rgba(0,0,0,0.1); position: fixed; top: 0; width: 100%; z-index: 100; }
        .nav-logo { font-size: 24px; font-weight: bold; color: #6C63FF; }

        /* LAYOUT */
        .main-layout { display: flex; justify-content: center; padding-top: 76px; min-height: 100vh; padding-bottom: 40px; }
        .feed-center { width: 100%; max-width: 590px; padding: 0 10px; }

        /* CARD */
        .post-card { background: white; border-radius: 8px; margin-bottom: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); overflow: hidden; }
        .post-header { padding: 12px 16px; display: flex; align-items: center; }
        .avatar { width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; }
        .post-info h4 { margin: 0; font-size: 15px; font-weight: 600; }
        .post-info span { font-size: 13px; color: #65676b; }
        .post-content { padding: 4px 16px 16px; font-size: 15px; line-height: 1.5; }
        .post-image { width: 100%; display: block; max-height: 600px; object-fit: cover; }
        
        /* KOMENTAR SECTION */
        .comment-section { padding: 10px 16px; border-top: 1px solid #e4e6eb; background: #fff; }
        .comment-form { display: flex; gap: 8px; margin-bottom: 20px; }
        .comment-input { background: #f0f2f5; border: none; border-radius: 18px; padding: 8px 12px; flex-grow: 1; font-size: 14px; outline: none; }
        .btn-send { background: transparent; color: #6C63FF; border: none; font-weight: bold; cursor: pointer; }

        /* ITEM KOMENTAR */
        .comment-list { list-style: none; padding: 0; margin: 0; }
        .comment-item { margin-bottom: 12px; }
        .comment-flex { display: flex; gap: 8px; }
        .comment-bubble { background: #f0f2f5; border-radius: 18px; padding: 8px 12px; display: inline-block; }
        .comment-author { font-weight: 600; font-size: 13px; color: #050505; display: block; }
        .comment-text { font-size: 14px; margin-top: 2px; color: #050505; }
        
        /* META & REPLY BUTTON */
        .comment-meta { font-size: 12px; color: #65676b; margin-left: 12px; margin-top: 2px; display: flex; gap: 10px; }
        .btn-reply { cursor: pointer; font-weight: 600; color: #65676b; background: none; border: none; padding: 0; font-size: 12px; }
        .btn-reply:hover { text-decoration: underline; }

        /* BALASAN (Indented) */
        .reply-list { list-style: none; padding-left: 48px; margin-top: 8px; }
        
        /* FORM BALASAN (Hidden by default) */
        .reply-form-container { margin-left: 48px; margin-top: 5px; display: none; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="/" class="nav-logo" style="display: flex; align-items: center; gap: 10px;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo BisikKampus" style="height: 45px; width: auto;">
            
            <span style="font-size: 20px; font-weight: 800; color: #6C63FF;">BisikKampus</span>
        </a>
    </nav>

    <div class="main-layout">
        <div class="feed-center">
            <a href="/" style="display:block; margin-bottom:10px; font-weight:600; color:#65676b;">← Kembali</a>

            <div class="post-card">
                <div class="post-header">
                    <img src="https://ui-avatars.com/api/?name={{ $laporan->pelapor->guest_id }}&background=random" class="avatar">
                    <div class="post-info">
                        <h4>{{ $laporan->pelapor->guest_id }}</h4>
                        <span>{{ $laporan->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="post-content">
                    <h3 style="margin:0 0 8px 0;">{{ $laporan->judul }}</h3>
                    {{ $laporan->deskripsi }}
                </div>
                @if ($laporan->foto_url)
                    <img src="{{ $laporan->foto_url }}" class="post-image">
                @endif

                <div class="comment-section">
                    
                    <form action="/laporan/{{ $laporan->id }}/komentar" method="POST" class="comment-form">
                        @csrf
                        <input type="hidden" name="guest_id" class="guest-id-input">
                        <img src="https://ui-avatars.com/api/?name=Me&background=ccc" class="avatar" style="width:32px; height:32px;">
                        <input type="text" name="isi_komentar" class="comment-input" placeholder="Tulis komentar..." required>
                        <button type="submit" class="btn-send">Kirim</button>
                    </form>

                    <ul class="comment-list">
                        @foreach ($laporan->komentar->whereNull('parent_komentar_id') as $komen)
                        <li class="comment-item">
                            <div class="comment-flex">
                                <img src="https://ui-avatars.com/api/?name={{ $komen->pelapor->guest_id }}&background=random" class="avatar" style="width:32px; height:32px;">
                                <div>
                                    <div class="comment-bubble">
                                        <span class="comment-author">{{ $komen->pelapor->guest_id }}</span>
                                        <span class="comment-text">{{ $komen->isi_komentar }}</span>
                                    </div>
                                    <div class="comment-meta">
                                        <span>{{ $komen->created_at->diffForHumans() }}</span>
                                        
                                        <button class="btn-reply" onclick="toggleReplyForm({{ $komen->id }})">Balas</button>

                                        @auth
                                            <form action="/komentar/{{ $komen->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin mau hapus komentar ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background:none; border:none; color:red; cursor:pointer; font-size:12px; margin-left:10px;">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        @endauth
                                    </div>
                                </div>
                            </div>

                            <div class="reply-form-container" id="reply-form-{{ $komen->id }}">
                                <form action="/laporan/{{ $laporan->id }}/komentar" method="POST" class="comment-form" style="margin-bottom:0;">
                                    @csrf
                                    <input type="hidden" name="guest_id" class="guest-id-input">
                                    <input type="hidden" name="parent_komentar_id" value="{{ $komen->id }}">
                                    
                                    <img src="https://ui-avatars.com/api/?name=Me&background=ccc" class="avatar" style="width:24px; height:24px;">
                                    <input type="text" name="isi_komentar" class="comment-input" placeholder="Balas {{ $komen->pelapor->guest_id }}..." required>
                                    <button type="submit" class="btn-send" style="font-size:12px;">Balas</button>
                                </form>
                            </div>

                            @if($komen->balasan->count() > 0)
                            <ul class="reply-list">
                                @foreach ($komen->balasan as $balasan)
                                <li class="comment-item">
                                    <div class="comment-flex">
                                        <img src="https://ui-avatars.com/api/?name={{ $balasan->pelapor->guest_id }}&background=random" class="avatar" style="width:24px; height:24px;">
                                        <div>
                                            <div class="comment-bubble">
                                                <span class="comment-author">{{ $balasan->pelapor->guest_id }}</span>
                                                <span class="comment-text">{{ $balasan->isi_komentar }}</span>
                                            </div>
                                            <div class="comment-meta">
                                                <span>{{ $balasan->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @endif

                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 1. Script Guest ID (Wajib ada di setiap halaman publik)
        let myGuestId = localStorage.getItem('bisik_guest_id');
        if (!myGuestId) {
            myGuestId = 'guest_' + Math.random().toString(36).substr(2, 5);
            localStorage.setItem('bisik_guest_id', myGuestId);
        }

        // Isi SEMUA input hidden dengan class 'guest-id-input'
        document.querySelectorAll('.guest-id-input').forEach(input => {
            input.value = myGuestId;
        });

        // 2. Fungsi Toggle Form Balasan
        function toggleReplyForm(commentId) {
            var formDiv = document.getElementById('reply-form-' + commentId);
            if (formDiv.style.display === "none" || formDiv.style.display === "") {
                formDiv.style.display = "block";
                // Otomatis fokus ke input
                formDiv.querySelector('input[type="text"]').focus();
            } else {
                formDiv.style.display = "none";
            }
        }
    </script>

</body>
</html>