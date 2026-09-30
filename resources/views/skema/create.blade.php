<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Skema Sertifikasi Baru</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        .container {
            width: 100%;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .card {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.10);
        }

        .card-header {
            background: linear-gradient(135deg, #212529, #343a40);
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 21px;
        }

        .btn {
            display: inline-block;
            padding: 9px 15px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn-light {
            background: white;
            color: #212529;
        }

        .btn-light:hover {
            background: #e9ecef;
        }

        .btn-dark {
            background: #212529;
            color: white;
        }

        .btn-dark:hover {
            background: #000;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5c636a;
        }

        .card-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            background-color: white;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #343a40;
            box-shadow: 0 0 0 3px rgba(52, 58, 64, 0.10);
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert-danger {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px 10px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .button-container {
                flex-direction: column;
            }

            .button-container .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card">

            <div class="card-header">
                <h2>Tambah Skema Sertifikasi</h2>
                <a href="{{ route('skema.index') }}" class="btn btn-light">
                    Kembali
                </a>
            </div>

            <div class="card-body">

                {{-- Alert Notification jika ada error global --}}
                @if(session('error'))
                    <div class="alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('skema.store') }}" method="POST">
                    @csrf

                    <!-- Input Kode Skema -->
                    <div class="form-group">
                        <label for="kode_skema" class="form-label">Kode Skema</label>
                        <input 
                            type="text" 
                            name="kode_skema" 
                            id="kode_skema" 
                            class="form-control @error('kode_skema') is-invalid @enderror" 
                            placeholder="Contoh: SKM/01/2026"
                            value="{{ old('kode_skema') }}" 
                            required>

                        @error('kode_skema')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Input Nama Skema -->
                    <div class="form-group">
                        <label for="nama_skema" class="form-label">Nama Skema Sertifikasi</label>
                        <input 
                            type="text" 
                            name="nama_skema" 
                            id="nama_skema" 
                            class="form-control @error('nama_skema') is-invalid @enderror" 
                            placeholder="Contoh: Pemrogram Mobil Utama / Junior Web Developer"
                            value="{{ old('nama_skema') }}" 
                            required>

                        @error('nama_skema')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Input Jenis Skema -->
                    <div class="form-group">
                        <label for="jenis" class="form-label">Jenis Skema</label>
                        <select 
                            name="jenis" 
                            id="jenis" 
                            class="form-select @error('jenis') is-invalid @enderror" 
                            required>
                            <option value="">-- Pilih Jenis Skema --</option>
                            <option value="KKNI" {{ old('jenis') == 'KKNI' ? 'selected' : '' }}>KKNI</option>
                            <option value="Okupasi" {{ old('jenis') == 'Okupasi' ? 'selected' : '' }}>Okupasi</option>
                            <option value="Klaster" {{ old('jenis') == 'Klaster' ? 'selected' : '' }}>Klaster</option>
                        </select>

                        @error('jenis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Input Jumlah Unit Kompetensi -->
                    <div class="form-group">
                        <label for="jumlah_unit" class="form-label">Jumlah Unit Kompetensi</label>
                        <input 
                            type="number" 
                            name="jumlah_unit" 
                            id="jumlah_unit" 
                            class="form-control @error('jumlah_unit') is-invalid @enderror" 
                            placeholder="Contoh: 12"
                            value="{{ old('jumlah_unit') }}" 
                            min="1"
                            required>

                        @error('jumlah_unit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="button-container">
                        <button type="submit" class="btn btn-dark">
                            Simpan Skema
                        </button>
                        <a href="{{ route('skema.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>