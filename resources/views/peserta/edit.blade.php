<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Data Peserta</title>

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
            max-width: 850px;
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

        .card-body {
            padding: 30px;
        }

        .alert {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 15px;
            background: white;
            outline: none;
            transition: 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #343a40;
            box-shadow: 0 0 0 3px rgba(52, 58, 64, 0.12);
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

        .button-container {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 8px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
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
            background: #5a6268;
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

                <h2>
                    Edit Data Peserta
                </h2>

                <a
                    href="{{ route('peserta.index') }}"
                    class="btn btn-light">
                    Kembali
                </a>

            </div>


            <div class="card-body">

                {{-- Alert Notification jika terjadi error sistem --}}
                @if(session('error'))

                <div class="alert">
                    {{ session('error') }}
                </div>

                @endif


                <form
                    action="{{ route('peserta.update', $peserta->id) }}"
                    method="POST">

                    @csrf

                    @method('PUT')

                    {{-- PENTING: Laravel membutuhkan method PUT/PATCH untuk proses update data --}}


                    <!-- Input Nama Peserta -->
                    <div class="form-group">

                        <label
                            for="nama_peserta"
                            class="form-label">
                            Nama Peserta
                        </label>

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

                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
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


                    <!-- Dropdown Pilihan Skema Sertifikasi -->
                    <div class="form-group">

                        <label
                            for="skema_id"
                            class="form-label">
                            Skema Sertifikasi
                        </label>

                        <select
                            name="skema_id"
                            id="skema_id"
                            class="form-select @error('skema_id') is-invalid @enderror"
                            required>

                            <option value="">
                                -- Pilih Skema Sertifikasi --
                            </option>

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


                    <!-- Input Email -->
                    <div class="form-group">

                        <label
                            for="email"
                            class="form-label">
                            Email
                        </label>

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


                    <!-- Input No HP -->
                    <div class="form-group">

                        <label
                            for="no_hp"
                            class="form-label">
                            No. HP
                        </label>

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


                    <!-- Tombol Aksi -->
                    <div class="button-container">

                        <button
                            type="submit"
                            class="btn btn-dark">
                            Simpan Perubahan
                        </button>

                        <a
                            href="{{ route('peserta.index') }}"
                            class="btn btn-secondary">
                            Batal
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>