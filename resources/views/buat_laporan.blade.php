<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - BisikKampus</title>
    <style>
        /* --- SETUP TEMA --- */
        :root {
            --primary: #6C63FF;
            --primary-hover: #5a52d5;
            --bg-body: #F8F9FA;
            --text-dark: #2D3748;
            --text-gray: #718096;
            --white: #ffffff;
            --shadow: 0 2px 10px rgba(0,0,0,0.05);
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif; margin: 0; background-color: var(--bg-body); color: var(--text-dark);
            display: flex; justify-content: center;
        }
        
        .mobile-container {
            width: 100%; max-width: 600px; 
            background-color: var(--bg-body);
            min-height: 100vh;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            position: relative;
        }

        /* --- NAVBAR --- */
        .navbar {
            background: var(--white); height: 64px; padding: 0 20px;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: var(--shadow); position: sticky; top: 0; z-index: 100;
        }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .logo-img { height: 40px; width: auto; }
        .logo-text { font-size: 20px; font-weight: 800; color: var(--primary); }
        .nav-back {
            display: flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; border-radius: 12px;
            color: var(--text-gray); text-decoration: none; transition: 0.2s;
        }
        .nav-back:hover { background: #F0EFFF; color: var(--primary); }

        /* --- FORM CARD --- */
        .content-area { padding: 24px 20px; padding-bottom: 50px; } /* Tambah padding bawah */
        .form-card {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            overflow: visible; 
        }
        
        .form-title {
            font-size: 22px; font-weight: 800; color: var(--text-dark);
            margin-bottom: 10px;
        }
        .form-subtitle {
            font-size: 14px; color: var(--text-gray); margin-bottom: 30px; line-height: 1.5;
        }

        /* INPUT GROUPS - PERBAIKAN CSS DI SINI */
        .input-group { 
            margin-bottom: 24px; 
            display: block; /* Pastikan block */
            width: 100%;
        }
        /* Ini kode standard CSS yang benar (bukan SCSS) */
        .input-group:last-of-type {
            margin-bottom: 30px; 
        }

        .label-row { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
        .label-icon { color: var(--text-gray); width: 18px; height: 18px; }
        .input-label { font-size: 14px; font-weight: 700; color: var(--text-dark); }
        
        .form-input {
            width: 100%; padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 12px;
            font-size: 15px; color: var(--text-dark);
            background: var(--bg-body);
            transition: 0.2s; outline: none;
        }
        .form-input:focus {
            border-color: var(--text-gray);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
        }
        .form-textarea { min-height: 120px; resize: vertical; line-height: 1.6; }

        /* UPLOAD BUTTON STYLE - PERBAIKAN BOX */
        input[type="file"] { display: none; }
        
        .upload-box {
            display: block; /* Pastikan tampil sebagai blok penuh */
            width: 100%;    /* Lebar penuh */
            box-sizing: border-box; /* Agar padding tidak merusak lebar */
            border: 2px dashed #cbd5e0;
            border-radius: 16px;
            padding: 30px 20px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
            background: var(--bg-body);
            margin-top: 5px;
        }
        .upload-box:hover {
            border-color: var(--text-dark);
            background: #f1f1f1;
        }
        .upload-icon { width: 32px; height: 32px; color: var(--text-gray); margin-bottom: 8px; }
        .upload-text { font-size: 14px; font-weight: 600; color: var(--text-gray); }
        .upload-subtext { font-size: 12px; color: #a0aec0; margin-top: 4px; }
        
        /* SUBMIT BUTTON */
        .btn-submit {
            width: 100%; padding: 16px;
            background: var(--text-dark); 
            color: white; border: none;
            border-radius: 12px;
            font-size: 16px; font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .btn-submit:hover { background: black; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); }
        
        .alert-success {
            background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534;
            padding: 16px; border-radius: 12px; margin-bottom: 24px;
            display: flex; align-items: center; gap: 10px; font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="mobile-container">
        
        <nav class="navbar">
            <a href="/" class="nav-back">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:20px;height:20px;">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            
            <a href="/" class="nav-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
                <span class="logo-text">BisikKampus</span>
            </a>
            
            <div style="width:40px;"></div>
        </nav>

        <div class="content-area">

            @if (session('status'))
                <div class="alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:24px;height:24px;">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <div class="form-card">
                <div class="form-title">Kirim Menfess / Curhat mu..</div>
                <div class="form-subtitle">
                    Identitas amann. Ceritalah.., jangan dipendam sendiri!
                </div>

                <form action="/laporan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="guest_id" id="guest_id_input">

                    <div class="input-group">
                        <div class="label-row">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="label-icon"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                            <label class="input-label">Judul Laporan</label>
                        </div>
                        <input type="text" name="judul" class="form-input" placeholder="Contoh: AC Gedung C Rusak" required>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <svg ... class="label-icon">...</svg> 
                            <label class="input-label">Topik Menfess</label>
                        </div>
                        <select name="kategori" class="form-input" style="cursor:pointer;" required>
                            <option value="">-- Pilih Topik --</option>
                            <option value="akademik">📚 Akademik </option>
                            <option value="cinta">💘 Love Life </option>
                            <option value="horror">👻 Horror </option>
                            <option value="info">📢 Info Kehilangan</option>
                            <option value="rant">🤬 Marah-marah</option>
                            <option value="random">✨ Random Ajahhh</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="label-icon"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            <label class="input-label">Lokasi (Opsional)</label>
                        </div>
                        <input type="text" name="lokasi" class="form-input" placeholder="Contoh: Lantai 2, Ruang 204">
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="label-icon"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                            <label class="input-label">Deskripsi Lengkap</label>
                        </div>
                        <textarea name="deskripsi" class="form-input form-textarea" placeholder="Ceritakan masalahnya secara detail..." required></textarea>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="label-icon"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                            <label class="input-label">Bukti Foto (Opsional)</label>
                        </div>
                        
                        <label for="foto" class="upload-box" id="uploadArea">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="upload-icon" style="margin: 0 auto; display:block;">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>
                            <div class="upload-text" id="fileLabel">Klik untuk memilih foto</div>
                            <div class="upload-subtext">Format: JPG, PNG (Max 1MB)</div>
                        </label>
                        <input type="file" id="foto" name="foto" accept="image/*">
                    </div>

                    <button type="submit" class="btn-submit">
                        Kirim Laporan
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:20px;height:20px;">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Guest ID Logic
        let myGuestId = localStorage.getItem('bisik_guest_id');
        if (!myGuestId) {
            myGuestId = 'guest_' + Math.random().toString(36).substr(2, 5);
            localStorage.setItem('bisik_guest_id', myGuestId);
        }
        document.getElementById('guest_id_input').value = myGuestId;

        // File Upload UX
        const fileInput = document.getElementById('foto');
        const uploadArea = document.getElementById('uploadArea');
        const fileLabel = document.getElementById('fileLabel');

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileLabel.innerText = "✅ " + this.files[0].name;
                // Ubah warna teks jadi hitam (bukan ungu)
                fileLabel.style.color = "#2D3748";
                uploadArea.style.borderColor = "#2D3748";
                uploadArea.style.backgroundColor = "#F7FAFC";
            }
        });
    </script>

</body>
</html>