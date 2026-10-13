<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta - USK BNSP</title>

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
            background-color: #f1f5f9;
            color: #0f172a;
            min-height: 100vh;
        }

        /* Top Navbar */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.9rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.15rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.3px;
        }

        .brand i {
            color: #2563eb;
            font-size: 1.3rem;
        }

        .btn-logout {
            border: 1.5px solid #fee2e2;
            background: #fef2f2;
            color: #dc2626;
            padding: 0.5rem 1.1rem;
            font-size: 0.85rem;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background-color: #dc2626;
            color: #ffffff;
            border-color: #dc2626;
        }

        /* Container Content */
        .main-container {
            max-width: 760px;
            margin: 2rem auto;
            padding: 0 1.25rem;
        }

        /* Alert Status */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
        }

        .alert-danger {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .alert-danger ul {
            margin-left: 1.25rem;
            font-weight: 500;
        }

        /* Header Card User Welcome */
        .user-welcome-card {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #ffffff;
            border-radius: 16px;
            padding: 1.75rem 2rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.25);
        }

        .user-info-text h1 {
            font-size: 1.35rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }

        .user-info-text p {
            color: #94a3b8;
            font-size: 0.875rem;
        }

        .badge-role {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.4rem 0.85rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Main Form Card */
        .card-box {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        .card-header-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-header-title i {
            color: #2563eb;
        }

        /* Form Layout */
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
            font-size: 0.8rem;
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

        .form-input {
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

        .form-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-input-disabled {
            background-color: #f8fafc;
            color: #64748b;
            cursor: not-allowed;
            border-color: #e2e8f0;
        }

        textarea.form-input {
            padding-left: 2.6rem;
            padding-top: 0.75rem;
        }

        .divider {
            border: none;
            border-top: 1px dashed #cbd5e1;
            margin: 2rem 0 1.5rem 0;
            grid-column: span 2;
        }

        .section-subtitle {
            font-size: 0.8rem;
            font-weight: 800;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            grid-column: span 2;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Submit Button */
        .btn-save {
            width: 100%;
            border: none;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            padding: 0.9rem;
            font-size: 0.9rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .btn-save:active {
            transform: translateY(0);
        }

        @media (max-width: 640px) {
            .navbar {
                padding: 0.8rem 1rem;
            }
            .main-container {
                margin: 1rem auto;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group-full {
                grid-column: span 1;
            }
            .divider, .section-subtitle {
                grid-column: span 1;
            }
            .user-welcome-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar">
        <div class="brand">
            <i class="fa-solid fa-graduation-cap"></i>
            PORTAL PESERTA USK
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </nav>

    <!-- Main Container -->
    <div class="main-container">

        <!-- Banner Selamat Datang -->
        <div class="user-welcome-card">
            <div class="user-info-text">
                <h1>Halo, {{ Auth::user()->peserta->nama_peserta ?? Auth::user()->name }} 👋</h1>
                <p>Selamat datang di sistem informasi uji kompetensi sertifikasi.</p>
            </div>
            <span class="badge-role"><i class="fa-solid fa-id-badge"></i> Peserta</span>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <!-- Notifikasi Error Validasi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.2rem;"></i>
                <div>
                    <strong>Periksa Kembali Inputan Anda:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Card Form Edit Profil -->
        <div class="card-box">
            <div class="card-header-title">
                <i class="fa-solid fa-user-pen"></i> Informasi Profil & Akun
            </div>

            <form action="{{ route('peserta.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">

                    <!-- Nama Lengkap -->
                    <div class="form-group-full">
                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <i class="fa-solid fa-user input-icon"></i>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->peserta->nama_peserta ?? Auth::user()->name) }}" required class="form-input">
                        </div>
                    </div>

                    <!-- Skema Sertifikasi (Readonly) -->
                    <div class="form-group-full">
                        <label class="form-label">Skema Sertifikasi Yang Diikuti</label>
                        <div class="input-group">
                            <i class="fa-solid fa-certificate input-icon"></i>
                            <input type="text" value="{{ Auth::user()->peserta->skema->nama_skema ?? 'Belum Memilih Skema' }}" readonly disabled class="form-input form-input-disabled">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="form-label">Email (Akun Login)</label>
                        <div class="input-group">
                            <i class="fa-solid fa-envelope input-icon"></i>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="form-input">
                        </div>
                    </div>

                    <!-- Nomor HP / WA -->
                    <div>
                        <label class="form-label">Nomor HP / WhatsApp</label>
                        <div class="input-group">
                            <i class="fa-solid fa-phone input-icon"></i>
                            <input type="text" name="no_hp" value="{{ old('no_hp', Auth::user()->peserta->no_hp ?? '') }}" placeholder="Contoh: 081234567890" required class="form-input">
                        </div>
                    </div>

                    <!-- Alamat Lengkap -->
                    <div class="form-group-full">
                        <label class="form-label">Alamat Lengkap Domisili</label>
                        <div class="input-group">
                            <i class="fa-solid fa-location-dot input-icon" style="top: 1rem;"></i>
                            <textarea name="alamat" rows="3" required class="form-input" style="resize: vertical;">{{ old('alamat', Auth::user()->peserta->alamat ?? '') }}</textarea>
                        </div>
                    </div>

                    <hr class="divider">

                    <!-- Subtitle Keamanan -->
                    <div class="section-subtitle">
                        <i class="fa-solid fa-shield-halved"></i> Keamanan Akun (Opsional)
                    </div>

                    <!-- Password Baru -->
                    <div>
                        <label class="form-label">Password Baru</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" class="form-input">
                        </div>
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div>
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock-check input-icon"></i>
                            <input type="password" name="password_confirmation" placeholder="Kosongkan jika tidak diubah" class="form-input">
                        </div>
                    </div>

                </div>

                <div style="margin-top: 2rem;">
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>
</html>