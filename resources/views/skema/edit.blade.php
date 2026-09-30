<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Skema Sertifikasi</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        background: #f4f6f9;
        min-height: 100vh;
        color: #333;
    }

    /* Navbar */
    .navbar {
        background: #151922;
        color: white;
        padding: 18px 40px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
    }

    .navbar-title {
        font-size: 21px;
        font-weight: bold;
    }

    .navbar-subtitle {
        margin-top: 4px;
        color: #bfc3ca;
        font-size: 13px;
    }

    /* Container */
    .container {
        width: 92%;
        max-width: 900px;
        margin: 35px auto;
    }

    /* Header */
    .page-header {
        background: white;
        padding: 25px 30px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header h1 {
        font-size: 24px;
        color: #1d232f;
        margin-bottom: 5px;
    }

    .page-header p {
        font-size: 14px;
        color: #777;
    }

    /* Card */
    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        overflow: hidden;
    }

    .card-header {
        padding: 18px 25px;
        background: #151922;
        color: white;
    }

    .card-header h2 {
        font-size: 17px;
    }

    .card-body {
        padding: 30px;
    }

    /* Alert */
    .alert {
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 22px;
        font-size: 14px;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .alert-danger {
        background: #fde2e2;
        color: #a51d2a;
        border: 1px solid #f3b9bd;
    }

    .close-alert {
        border: none;
        background: transparent;
        color: inherit;
        font-size: 20px;
        cursor: pointer;
    }

    /* Form */
    .form-group {
        margin-bottom: 22px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d5d9df;
        border-radius: 7px;
        background: white;
        font-size: 14px;
        outline: none;
        transition: 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #151922;
        box-shadow: 0 0 0 3px rgba(21, 25, 34, 0.08);
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        margin-top: 6px;
        color: #dc3545;
        font-size: 13px;
    }

    /* Buttons */
    .actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .btn {
        border: none;
        text-decoration: none;
        display: inline-block;
        padding: 11px 18px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .btn-primary {
        background: #151922;
        color: white;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-back {
        background: white;
        color: #151922;
        border: 1px solid #ddd;
    }

    /* Footer */
    .footer {
        text-align: center;
        padding: 25px;
        color: #888;
        font-size: 13px;
    }

    /* Responsive */
    @media (max-width: 768px) {

        .navbar {
            padding: 15px 20px;
        }

        .container {
            width: 95%;
            margin: 20px auto;
        }

        .page-header {
            padding: 20px;
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .page-header h1 {
            font-size: 21px;
        }

        .btn-back {
            width: 100%;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .actions {
            flex-direction: column;
        }

        .actions .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
```

</head>

<body>

```
<!-- Navbar -->
<div class="navbar">
    <div class="navbar-title">
        Sistem Sertifikasi
    </div>

    <div class="navbar-subtitle">
        Manajemen Skema Sertifikasi
    </div>
</div>


<!-- Content -->
<div class="container">

    <!-- Page Header -->
    <div class="page-header">

        <div>
            <h1>Edit Skema Sertifikasi</h1>

            <p>
                Perbarui informasi skema sertifikasi.
            </p>
        </div>

        <a href="{{ route('skema.index') }}"
           class="btn btn-back">
            ← Kembali
        </a>

    </div>


    <!-- Card -->
    <div class="card">

        <div class="card-header">
            <h2>Form Edit Skema</h2>
        </div>


        <div class="card-body">

            {{-- Alert Error --}}
            @if(session('error'))

                <div class="alert alert-danger">

                    <span>
                        {{ session('error') }}
                    </span>

                    <button type="button"
                            class="close-alert"
                            onclick="this.parentElement.remove()">
                        &times;
                    </button>

                </div>

            @endif


            <!-- Form -->
            <form action="{{ route('skema.update', $skema->id) }}"
                  method="POST">

                @csrf

                @method('PUT')


                <!-- Kode Skema -->
                <div class="form-group">

                    <label for="kode_skema"
                           class="form-label">
                        Kode Skema
                    </label>

                    <input type="text"
                           name="kode_skema"
                           id="kode_skema"
                           class="form-control @error('kode_skema') is-invalid @enderror"
                           value="{{ old('kode_skema', $skema->kode_skema) }}"
                           required>

                    @error('kode_skema')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- Nama Skema -->
                <div class="form-group">

                    <label for="nama_skema"
                           class="form-label">
                        Nama Skema Sertifikasi
                    </label>

                    <input type="text"
                           name="nama_skema"
                           id="nama_skema"
                           class="form-control @error('nama_skema') is-invalid @enderror"
                           value="{{ old('nama_skema', $skema->nama_skema) }}"
                           required>

                    @error('nama_skema')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- Jenis Skema -->
                <div class="form-group">

                    <label for="jenis"
                           class="form-label">
                        Jenis Skema
                    </label>

                    <select name="jenis"
                            id="jenis"
                            class="form-select @error('jenis') is-invalid @enderror"
                            required>

                        <option value="">
                            -- Pilih Jenis --
                        </option>

                        <option value="KKNI"
                            {{ old('jenis', $skema->jenis) == 'KKNI' ? 'selected' : '' }}>
                            KKNI
                        </option>

                        <option value="Klaster"
                            {{ old('jenis', $skema->jenis) == 'Klaster' ? 'selected' : '' }}>
                            Klaster
                        </option>

                        <option value="Okupasi"
                            {{ old('jenis', $skema->jenis) == 'Okupasi' ? 'selected' : '' }}>
                            Okupasi
                        </option>

                    </select>


                    @error('jenis')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- Jumlah Unit -->
                <div class="form-group">

                    <label for="jumlah_unit"
                           class="form-label">
                        Jumlah Unit Kompetensi
                    </label>

                    <input type="number"
                           name="jumlah_unit"
                           id="jumlah_unit"
                           class="form-control @error('jumlah_unit') is-invalid @enderror"
                           value="{{ old('jumlah_unit', $skema->jumlah_unit) }}"
                           min="1"
                           required>

                    @error('jumlah_unit')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- Tombol -->
                <div class="actions">

                    <button type="submit"
                            class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('skema.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>


    <!-- Footer -->
    <div class="footer">
        Sistem Manajemen Skema Sertifikasi
    </div>

</div>

</body>
</html>
