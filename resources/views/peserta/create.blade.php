<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Peserta - Admin Panel</title>

    <!-- Font & FontAwesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Client-Side OCR Library (Tesseract.js CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #f8fafc;
            color: #0f172a;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            padding: 40px 20px;
        }

        .form-wrapper {
            max-width: 760px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
        }

        .card-header {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: white;
            padding: 22px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header h2 i {
            color: #38bdf8;
        }

        .card-body {
            padding: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group-full {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            font-size: 0.825rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 0.875rem;
            outline: none;
            background: white;
            color: #0f172a;
            transition: all 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 90px;
        }

        .ocr-loading {
            font-size: 0.825rem;
            color: #2563eb;
            font-weight: 600;
            margin-top: 6px;
            display: none;
        }

        .is-invalid {
            border-color: #dc2626 !important;
        }

        .invalid-feedback {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            gap: 15px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 700;
            transition: all 0.2s;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        .btn-dark {
            background: #0f172a;
            color: white;
        }

        .btn-dark:hover {
            background: #1e293b;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px 15px;
            }

            .card-body {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group-full {
                grid-column: span 1;
            }

            .button-container {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .btn {
                justify-content: center;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="form-wrapper">

            <div class="card">

                <div class="card-header">
                    <h2>
                        <i class="fa-solid fa-user-plus"></i> Form Pendaftaran Peserta
                    </h2>
                </div>

                <div class="card-body">

                    <form action="{{ route('peserta.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-grid">

                            <!-- Upload Foto KTP & OCR -->
                            <div class="form-group-full">
                                <label class="form-label">
                                    Upload Foto KTP (JPG / PNG)
                                </label>

                                <input 
                                    type="file" 
                                    name="foto_ktp" 
                                    id="foto_ktp" 
                                    accept="image/*" 
                                    class="form-control @error('foto_ktp') is-invalid @enderror"
                                    onchange="scanKTP(event)">

                                <div id="ocr-status" class="ocr-loading">
                                    <i class="fa-solid fa-spinner fa-spin"></i> Membaca data NIK & Jenis Kelamin 
                                </div>

                                @error('foto_ktp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                             <div class="form-grid">

                            <!-- Upload Foto ijazah-->
                            <div class="form-group-full">
                                <label class="form-label">
                                    Upload Foto Ijazah (JPG / PNG)
                                </label>

                                <input 
                                    type="file" 
                                    name="foto_ijazah" 
                                    id="foto_ijazah" 
                                    accept="image/*" 
                                    class="form-control @error('foto_ijazah') is-invalid @enderror"
                                    onchange="scanIjazah(event)">

                                <div id="ocr-status" class="ocr-loading">
                                    <i class="fa-solid fa-spinner fa-spin"></i> Membaca data Ijazah
                                </div>

                                @error('foto_ijazah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                             <div class="form-grid">

                            <!-- Upload Foto sertifikat -->
                            <div class="form-group-full">
                                <label class="form-label">
                                    Upload Foto Sertifikat (JPG / PNG)
                                </label>

                                <input 
                                    type="file" 
                                    name="foto_sertifikat" 
                                    id="foto_sertifikat" 
                                    accept="image/*" 
                                    class="form-control @error('foto_sertifikat') is-invalid @enderror"
                                    onchange="scanSertifikat(event)">

                                <div id="ocr-status" class="ocr-loading">
                                    <i class="fa-solid fa-spinner fa-spin"></i> Membaca data dari Sertifikat...
                                </div>

                                @error('foto_sertifikat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

     

                            <!-- NIK (Nomor Induk Kependudukan) -->
                            <div>
                                <label class="form-label">
                                    NIK (16 Digit)
                                </label>

                                <input 
                                    type="text" 
                                    name="nik" 
                                    id="nik" 
                                    class="form-control @error('nik') is-invalid @enderror" 
                                    value="{{ old('nik') }}" 
                                    placeholder="16 Digit NIK (Terisi Otomatis)" 
                                    maxlength="16" 
                                    required>

                                @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="form-label">
                                    Jenis Kelamin
                                </label>

                                <select 
                                    name="jenis_kelamin" 
                                    id="jenis_kelamin" 
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                    required>
                                    
                                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>

                                @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Skema Sertifikasi -->
                            <div class="form-group-full">
                                <label class="form-label">
                                    Skema Sertifikasi
                                </label>

                                <select 
                                    name="skema_id" 
                                    class="form-select @error('skema_id') is-invalid @enderror" 
                                    required>

                                    <option value="">
                                        -- Pilih Skema Sertifikasi --
                                    </option>

                                    @foreach($skemas as $skema)
                                    <option 
                                        value="{{ $skema->id }}" 
                                        {{ old('skema_id') == $skema->id ? 'selected' : '' }}>
                                        {{ $skema->kode_skema }} - {{ $skema->nama_skema }}
                                    </option>
                                    @endforeach

                                </select>

                                @error('skema_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="form-group-full">
                                <label class="form-label">
                                    Nama Lengkap
                                </label>

                                <input 
                                    type="text" 
                                    name="nama_peserta" 
                                    class="form-control @error('nama_peserta') is-invalid @enderror" 
                                    value="{{ old('nama_peserta') }}" 
                                    placeholder="Sesuai KTP" 
                                    required>

                                @error('nama_peserta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="form-label">
                                    Email (Untuk Akun Login)
                                </label>

                                <input 
                                    type="email" 
                                    name="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    value="{{ old('email') }}" 
                                    placeholder="nama@email.com" 
                                    required>

                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- No. Handphone -->
                            <div>
                                <label class="form-label">
                                    No. Handphone / WA
                                </label>

                                <input 
                                    type="text" 
                                    name="no_hp" 
                                    class="form-control @error('no_hp') is-invalid @enderror" 
                                    value="{{ old('no_hp') }}" 
                                    placeholder="Contoh: 081234567890" 
                                    required>

                                @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="form-group-full">
                                <label class="form-label">
                                    Alamat Lengkap
                                </label>

                                <textarea 
                                    name="alamat" 
                                    class="form-control @error('alamat') is-invalid @enderror" 
                                    rows="3" 
                                    placeholder="Sesuai KTP / Domisili" 
                                    required>{{ old('alamat') }}</textarea>

                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Password Awal Akun Peserta -->
                            <div class="form-group-full">
                                <label class="form-label">
                                    Password Akun Peserta
                                </label>

                                <input 
                                    type="password" 
                                    name="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    placeholder="Masukkan password awal peserta (minimal 8 karakter)" 
                                    required>

                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                        <!-- Button Container -->
                        <div class="button-container">
                            <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-dark">
                                <i class="fa-solid fa-floppy-disk"></i> Daftarkan Peserta
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- Script Client-Side OCR Tesseract.js -->
    <script>
    function scanKTP(event) {
        const file = event.target.files[0];
        if (!file) return;

        const ocrStatus = document.getElementById('ocr-status');
        ocrStatus.style.display = 'block';

        Tesseract.recognize(
            file,
            'ind',
            { logger: m => console.log(m) }
        ).then(({ data: { text } }) => {
            ocrStatus.style.display = 'none';

            // 1. Ekstrak 16 Digit NIK menggunakan Regex Match
            const nikMatches = text.match(/\b\d{16}\b/);
            if (nikMatches && nikMatches.length > 0) {
                document.getElementById('nik').value = nikMatches[0];
            }

            // 2. Ekstrak Jenis Kelamin
            const upperText = text.toUpperCase();
            if (upperText.includes('LAKI') || upperText.includes('LAKI-LAKI')) {
                document.getElementById('jenis_kelamin').value = 'L';
            } else if (upperText.includes('PEREMPUAN') || upperText.includes('WANITA')) {
                document.getElementById('jenis_kelamin').value = 'P';
            }
        }).catch(err => {
            ocrStatus.style.display = 'none';
            console.error(err);
            alert('Gagal membaca KTP secara otomatis. Silakan isi NIK & Jenis Kelamin secara manual.');
        });
    }
    </script>

</body>

</html>