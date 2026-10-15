<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Peserta - Portal Sertifikasi USK</title>

    <!-- Google Fonts & FontAwesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .register-box {
            width: 100%;
            max-width: 620px;
            border: 1px solid #e2e8f0;
            padding: 2.5rem;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        .title {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
            text-align: center;
            color: #0f172a;
            letter-spacing: -0.3px;
        }

        .subtitle {
            font-size: 0.875rem;
            color: #64748b;
            text-align: center;
            margin-bottom: 1.75rem;
        }

        /* Alert Error */
        .alert-error {
            border: 1px solid #fecaca;
            background-color: #fef2f2;
            color: #b91c1c;
            padding: 1rem 1.25rem;
            border-radius: 12px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-error ul {
            list-style: none;
            margin-left: 0;
        }

        .alert-error li {
            margin-bottom: 0.25rem;
        }

        /* Form Grid System */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }

        .form-group-full {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            font-size: 0.775rem;
            font-weight: 700;
            margin-bottom: 0.45rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.6rem;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            outline: none;
            background-color: #ffffff;
            color: #0f172a;
            transition: all 0.2s ease;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        textarea.form-input {
            padding-left: 2.6rem;
            padding-top: 0.75rem;
        }

        .ocr-loading {
            font-size: 0.8rem;
            color: #2563eb;
            font-weight: 600;
            margin-top: 6px;
            display: none;
            grid-column: span 2;
        }

        /* Button Submit */
        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            border: none;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease;
            margin-top: 0.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .footer-link {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
            color: #64748b;
        }

        .footer-link a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 640px) {
            .register-box {
                padding: 1.5rem;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group-full {
                grid-column: span 1;
            }
            .ocr-loading {
                grid-column: span 1;
            }
        }
    </style>
</head>

<body>

    <div class="register-box">
        <h2 class="title"><i class="fa-solid fa-graduation-cap" style="color: #2563eb;"></i> Daftar Akun</h2>
        <p class="subtitle">Buat akun khusus peserta uji kompetensi sertifikasi</p>

        <!-- Alert Notification Error -->
        @if ($errors->any())
        <div class="alert-error">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.2rem;"></i>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">

                <!-- 1. Upload Foto KTP dengan Client-Side OCR -->
                <div class="form-group-full">
                    <label class="form-label">Upload Foto KTP (JPG / PNG)</label>
                    <div class="input-group">
                        <i class="fa-solid fa-id-card input-icon"></i>
                        <input type="file" name="foto_ktp" id="foto_ktp" accept="image/*" class="form-input" required onchange="scanKTP(event)">
                    </div>
                    <div id="ocr-status" class="ocr-loading">
                        <i class="fa-solid fa-spinner fa-spin"></i>Silahkan Masukkan Gambar Ktp
                    </div>
                </div>

                <!-- 2. NIK Auto-Fill -->
                <div>
                    <label class="form-label">NIK (16 Digit)</label>
                    <div class="input-group">
                        <i class="fa-solid fa-address-card input-icon"></i>
                        <input type="text" name="nik" id="nik" value="{{ old('nik') }}" placeholder="Isi NIK sesuai dengan yang di ktp" maxlength="16" required class="form-input">
                    </div>
                </div>

                <!-- 3. Jenis Kelamin Auto-Fill -->
                <div>
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="input-group">
                        <i class="fa-solid fa-venus-mars input-icon"></i>
                        <select name="jenis_kelamin" id="jenis_kelamin" required class="form-select">
                            <option value="" disabled selected>-- Pilih Gender --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <!-- 4. Nama Lengkap -->
                <div class="form-group-full">
                    <label class="form-label">Nama Lengkap Peserta</label>
                    <div class="input-group">
                        <i class="fa-solid fa-user input-icon"></i>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama sesuai KTP" required class="form-input">
                    </div>
                </div>

                <!-- 5. Pilih Skema Sertifikasi -->
                <div class="form-group-full">
                    <label class="form-label">Skema Sertifikasi Yang Diikuti</label>
                    <div class="input-group">
                        <i class="fa-solid fa-certificate input-icon"></i>
                        <select class="form-select" id="skema_id" name="skema_id" required>
                            <option value="" disabled selected>-- Pilih Skema Sertifikasi --</option>
                            @foreach($skemas as $skema)
                                <option value="{{ $skema->id }}" {{ old('skema_id') == $skema->id ? 'selected' : '' }}>
                                    {{ $skema->kode_skema ?? '' }} {{ $skema->nama_skema ?? $skema->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- 6. Nomor HP / WhatsApp -->
                <div>
                    <label class="form-label">Nomor HP / WhatsApp</label>
                    <div class="input-group">
                        <i class="fa-solid fa-phone input-icon"></i>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" required class="form-input">
                    </div>
                </div>

                <!-- 7. Email -->
                <div>
                    <label class="form-label">Email (Akun Login)</label>
                    <div class="input-group">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required class="form-input">
                    </div>
                </div>

                <!-- 8. Alamat Lengkap -->
                <div class="form-group-full">
                    <label class="form-label">Alamat Lengkap Domisili</label>
                    <div class="input-group">
                        <i class="fa-solid fa-location-dot input-icon" style="top: 1rem;"></i>
                        <textarea name="alamat" rows="2" placeholder="Masukkan alamat domisili sesuai KTP" required class="form-input" style="resize: vertical;">{{ old('alamat') }}</textarea>
                    </div>
                </div>

                <!-- 9. Password -->
                <div>
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password" placeholder="Minimal 8 karakter" required class="form-input">
                    </div>
                </div>

                <!-- 10. Konfirmasi Password -->
                <div>
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock-check input-icon"></i>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" required class="form-input">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group-full" style="margin-top: 0.5rem;">
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-user-plus"></i> Daftar Akun Peserta
                    </button>
                </div>

            </div>
        </form>

        <div class="footer-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>


    

</body>

</html>