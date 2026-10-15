<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Peserta - Admin Panel</title>

    <!-- Font & FontAwesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

        .card {
            max-width: 850px;
            margin: 0 auto;
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

        .alert {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group-full {
            grid-column: span 2;
        }

        .form-group {
            margin-bottom: 18px;
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
            background: white;
            color: #0f172a;
            outline: none;
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

        .img-preview-container {
            margin-bottom: 10px;
        }

        .img-preview {
            width: 140px;
            height: 85px;
            object-fit: cover;
            border-radius: 8px;
            border: 1.5px solid #cbd5e1;
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
            margin-top: 30px;
            display: flex;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: 10px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 700;
            transition: all 0.2s;
        }

        .btn-light {
            background: white;
            color: #0f172a;
        }

        .btn-light:hover {
            background: #f1f5f9;
        }

        .btn-dark {
            background: #0f172a;
            color: white;
        }

        .btn-dark:hover {
            background: #1e293b;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px 15px;
            }

            .card-body {
                padding: 20px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group-full {
                grid-column: span 1;
            }

            .button-container {
                flex-direction: column;
            }

            .button-container .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card">

            <div class="card-header">
                <h2>
                    <i class="fa-solid fa-user-pen"></i> Edit Data Peserta
                </h2>

                <a href="{{ route('peserta.index') }}" class="btn btn-light">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">

                {{-- Alert Notification jika terjadi error sistem --}}
                @if(session('error'))
                    <div class="alert">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('peserta.update', $peserta->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <!-- Foto KTP -->
                        <div class="form-group-full">
                            <label class="form-label">Foto KTP Peserta</label>

                            @if($peserta->foto_ktp)
                                <div class="img-preview-container">
                                    <a href="{{ asset('storage/' . $peserta->foto_ktp) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $peserta->foto_ktp) }}" class="img-preview" alt="Foto KTP">
                                    </a>
                                </div>
                            @endif

                            <input 
                                type="file" 
                                name="foto_ktp" 
                                id="foto_ktp" 
                                accept="image/*" 
                                class="form-control @error('foto_ktp') is-invalid @enderror">

                            <small style="color: #64748b; font-size: 0.75rem; display: block; margin-top: 4px;">
                                *Pilih file baru jika ingin memperbarui foto KTP. Kosongkan jika tidak ada perubahan.
                            </small>

                            @error('foto_ktp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- NIK (16 Digit) -->
                        <div>
                            <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan)</label>
                            <input 
                                type="text" 
                                name="nik" 
                                id="nik" 
                                class="form-control @error('nik') is-invalid @enderror" 
                                value="{{ old('nik', $peserta->nik) }}" 
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
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select 
                                name="jenis_kelamin" 
                                id="jenis_kelamin" 
                                class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                required>
                                <option value="L" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>

                            @error('jenis_kelamin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Nama Peserta -->
                        <div class="form-group-full">
                            <label for="nama_peserta" class="form-label">Nama Peserta</label>
                            <input 
                                type="text" 
                                name="nama_peserta" 
                                id="nama_peserta" 
                                class="form-control @error('nama_peserta') is-invalid @enderror" 
                                value="{{ old('nama_peserta', $peserta->nama_peserta) }}" 
                                required>

                            @error('nama_peserta')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Skema Sertifikasi -->
                        <div class="form-group-full">
                            <label for="skema_id" class="form-label">Skema Sertifikasi</label>
                            <select 
                                name="skema_id" 
                                id="skema_id" 
                                class="form-select @error('skema_id') is-invalid @enderror" 
                                required>
                                <option value="">-- Pilih Skema Sertifikasi --</option>
                                @foreach($skemas as $skema)
                                    <option 
                                        value="{{ $skema->id }}" 
                                        {{ old('skema_id', $peserta->skema_id) == $skema->id ? 'selected' : '' }}>
                                        {{ $skema->nama_skema }}
                                    </option>
                                @endforeach
                            </select>

                            @error('skema_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="form-label">Email (Akun Login)</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                value="{{ old('email', $peserta->email) }}" 
                                required>

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div>
                            <label for="no_hp" class="form-label">No. HP / WhatsApp</label>
                            <input 
                                type="text" 
                                name="no_hp" 
                                id="no_hp" 
                                class="form-control @error('no_hp') is-invalid @enderror" 
                                value="{{ old('no_hp', $peserta->no_hp) }}" 
                                required>

                            @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="form-group-full">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea 
                                name="alamat" 
                                id="alamat" 
                                class="form-control @error('alamat') is-invalid @enderror" 
                                rows="3" 
                                required>{{ old('alamat', $peserta->alamat) }}</textarea>

                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>

                    <hr style="margin: 25px 0; border: none; border-top: 1px dashed #cbd5e1;">

                    <!-- Reset Password Peserta (Opsional) -->
                    <div class="form-group">
                        <label for="password" class="form-label" style="color: #dc2626;">
                            Reset Password Peserta (Opsional)
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Kosongkan jika tidak ingin mengubah password">

                        <small style="color: #64748b; display: block; margin-top: 5px;">
                            *Isi bidang ini hanya jika Admin ingin mereset/mengganti password akun peserta.
                        </small>

                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="button-container">
                        <button type="submit" class="btn btn-dark">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>

                        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>