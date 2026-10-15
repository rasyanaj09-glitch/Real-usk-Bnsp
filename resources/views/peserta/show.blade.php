<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Profil Peserta</title>

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
            max-width: 750px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.10);
        }

        .card-header {
            background: linear-gradient(135deg, #212529, #343a40);
            color: white;
            padding: 22px 25px;
        }

        .card-header h2 {
            font-size: 21px;
        }

        .card-body {
            padding: 30px;
        }

        .profile-table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 8px;
        }

        .profile-table th,
        .profile-table td {
            padding: 15px;
            border: 1px solid #dee2e6;
            text-align: left;
            vertical-align: middle;
        }

        .profile-table th {
            width: 35%;
            background: #f1f3f5;
            font-weight: bold;
            color: #333;
        }

        .profile-table td {
            background: white;
        }

        .profile-table tr:nth-child(even) td {
            background: #f8f9fa;
        }

        /* Styling Gambar Pratinjau */
        .img-preview {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 1.5px solid #ced4da;
            transition: transform 0.2s ease-in-out;
        }

        .img-preview:hover {
            transform: scale(1.05);
            border-color: #0d6efd;
        }

        .no-file {
            color: #adb5bd;
            font-size: 13px;
            font-style: italic;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s;
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
                padding: 20px 10px;
            }

            .card-body {
                padding: 20px;
            }

            .profile-table th,
            .profile-table td {
                padding: 11px;
                font-size: 14px;
            }

            .profile-table th {
                width: 40%;
            }

            .button-container {
                justify-content: stretch;
            }

            .btn {
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
                <h2>Detail Profil Peserta</h2>
            </div>

            <div class="card-body">

                <table class="profile-table">

                    <tr>
                        <th>NIK</th>
                        <td>{{ $peserta->nik ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Nama Peserta</th>
                        <td>{{ $peserta->nama_peserta }}</td>
                    </tr>

                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $peserta->jenis_kelamin === 'L' ? 'Laki-Laki' : ($peserta->jenis_kelamin === 'P' ? 'Perempuan' : '-') }}</td>
                    </tr>

                    <tr>
                        <th>Skema Dipilih</th>
                        <td>
                            <strong>{{ $peserta->skema->kode_skema ?? '-' }}</strong> - {{ $peserta->skema->nama_skema ?? 'Tidak Ada Skema' }}
                        </td>
                    </tr>

                    <tr>
                        <th>Jenis Skema</th>
                        <td>
                            {{ $peserta->skema->jenis ?? '-' }} ({{ $peserta->skema->jumlah_unit ?? 0 }} Unit)
                        </td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $peserta->email }}</td>
                    </tr>

                    <tr>
                        <th>No. HP</th>
                        <td>{{ $peserta->no_hp }}</td>
                    </tr>

                    <tr>
                        <th>Alamat</th>
                        <td>{{ $peserta->alamat }}</td>
                    </tr>

                    <!-- Lampiran Foto KTP -->
                    <tr>
                        <th>Foto KTP</th>
                        <td>
                            @if($peserta->foto_ktp)
                                <a href="{{ asset('storage/' . $peserta->foto_ktp) }}" target="_blank" title="Klik untuk memperbesar">
                                    <img src="{{ asset('storage/' . $peserta->foto_ktp) }}" class="img-preview" alt="Foto KTP">
                                </a>
                            @else
                                <span class="no-file">Tidak ada lampiran KTP</span>
                            @endif
                        </td>
                    </tr>

                    <!-- Lampiran Foto Ijazah -->
                    <tr>
                        <th>Foto Ijazah</th>
                        <td>
                            @if($peserta->ijazah)
                                <a href="{{ asset('storage/' . $peserta->ijazah) }}" target="_blank" title="Klik untuk memperbesar">
                                    <img src="{{ asset('storage/' . $peserta->ijazah) }}" class="img-preview" alt="Foto Ijazah">
                                </a>
                            @else
                                <span class="no-file">Tidak ada lampiran Ijazah</span>
                            @endif
                        </td>
                    </tr>

                    <!-- Lampiran Foto Sertifikat -->
                    <tr>
                        <th>Foto Sertifikat</th>
                        <td>
                            @if($peserta->foto_sertifikat)
                                <a href="{{ asset('storage/' . $peserta->foto_sertifikat) }}" target="_blank" title="Klik untuk memperbesar">
                                    <img src="{{ asset('storage/' . $peserta->foto_sertifikat) }}" class="img-preview" alt="Foto Sertifikat">
                                </a>
                            @else
                                <span class="no-file">Tidak ada lampiran Sertifikat</span>
                            @endif
                        </td>
                    </tr>

                </table>

                <div class="button-container">
                    <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
                        Kembali ke Daftar
                    </a>
                </div>

            </div>

        </div>

    </div>

</body>

</html>