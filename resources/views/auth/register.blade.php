<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Peserta - USK</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .register-box {
            width: 100%;
            max-width: 420px;
            border: 2px solid #0f172a;
            padding: 2rem;
            background-color: #ffffff;
        }

        .title {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            text-align: center;
        }

        .subtitle {
            font-size: 0.875rem;
            color: #64748b;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        /* Alert Error */
        .alert-error {
            border: 2px solid #dc2626;
            color: #dc2626;
            padding: 0.75rem;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }

        .alert-error ul {
            list-style: none;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
            text-transform: uppercase;
        }

        .form-input {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border: 2px solid #0f172a;
            font-size: 0.9rem;
            outline: none;
            background-color: #ffffff;
        }

        .form-input:focus {
            border-color: #2563eb;
        }

        /* Button Outline Submit */
        .btn-submit {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #2563eb;
            background-color: transparent;
            color: #2563eb;
            font-weight: 800;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-submit:hover {
            background-color: #2563eb;
            color: #ffffff;
        }

        .footer-link {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
        }

        .footer-link a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
            border-bottom: 2px solid #2563eb;
        }
    </style>
</head>

<body>

    <div class="register-box">
        <h2 class="title">Daftar Akun</h2>
        <p class="subtitle">Buat akun khusus peserta uji kompetensi</p>

        @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required class="form-input">
            </div>

            <!-- Pilih Skema Sertifikasi -->
            <div class="form-group">
                <label class="form-label" for="skema_id">Pilih Skema Sertifikasi</label>
                <div class="input-wrapper">
                    <select class="form-input @error('skema_id') is-invalid @enderror" id="skema_id" name="skema_id" required>
                        <option value="" disabled selected>-- Pilih Skema Sertifikasi --</option>
                        @foreach($skemas as $skema)
                        <option value="{{ $skema->id }}" {{ old('skema_id') == $skema->id ? 'selected' : '' }}>
                            {{ $skema->nama_skema ?? $skema->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Nomor HP / WhatsApp -->
            <div class="form-group">
                <label class="form-label">Nomor HP / WhatsApp</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" required class="form-input">
            </div>

            <!-- Alamat Lengkap -->
            <div class="form-group">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" placeholder="Masukkan alamat domisili lengkap" required class="form-input" style="resize: vertical;">{{ old('alamat') }}</textarea>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required class="form-input">
            </div>

            <!-- Password -->
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter" required class="form-input">
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password" required class="form-input">
            </div>

            <button type="submit" class="btn-submit">Daftar Akun</button>
        </form>

        <div class="footer-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>

</body>

</html>