<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta Sertifikasi - Admin Panel</title>

    <!-- Font & Icons -->
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
            padding: 30px 20px;
        }

        .card {
            max-width: 1280px;
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

        .header-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.55rem 1rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-size: 0.825rem;
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

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .card-body {
            padding: 25px;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            position: relative;
            font-size: 0.875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .btn-close {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            font-size: 18px;
            cursor: pointer;
            color: inherit;
        }

        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .search-input {
            flex: 1;
            max-width: 450px;
            padding: 0.65rem 1rem;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 0.875rem;
            outline: none;
        }

        .search-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-dark {
            background: #0f172a;
            color: white;
        }

        .btn-dark:hover {
            background: #1e293b;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            color: #475569;
            padding: 12px;
            text-align: left;
            font-size: 0.775rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.875rem;
            color: #334155;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .img-ktp {
            width: 65px;
            height: 42px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            transition: transform 0.2s;
        }

        .img-ktp:hover {
            transform: scale(1.1);
        }

        .badge {
            display: inline-block;
            padding: 0.3rem 0.65rem;
            border-radius: 6px;
            font-size: 0.725rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-pending {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .badge-approved {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .btn-success {
            background: #16a34a;
            color: white;
        }

        .btn-success:hover {
            background: #15803d;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .btn-info {
            background: #0284c7;
            color: white;
        }

        .btn-info:hover {
            background: #0369a1;
        }

        .inline-form {
            display: inline;
        }

        .empty-data {
            padding: 30px;
            text-align: center;
            color: #94a3b8;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px 10px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-buttons {
                width: 100%;
                flex-direction: column;
            }

            .header-buttons .btn {
                width: 100%;
                justify-content: center;
            }

            .search-form {
                flex-direction: column;
            }

            .search-input {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card">

            <div class="card-header">
                <h2>
                    <i class="fa-solid fa-users"></i> Daftar Peserta Sertifikasi
                </h2>

                <div class="header-buttons">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Dashboard
                    </a>
                   
                </div>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'">×</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'">×</button>
                    </div>
                @endif

                <!-- Form Pencarian -->
                <form action="{{ route('peserta.index') }}" method="GET" class="search-form">
                    <input type="text" name="cari" class="search-input" placeholder="Cari NIK, Nama, Email, No. HP..." value="{{ request('cari') }}">
                    <button type="submit" class="btn btn-dark">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari Data
                    </button>
                    @if(request('cari'))
                        <a href="{{ route('peserta.index') }}" class="btn btn-secondary" style="background: #e2e8f0; color: #334155;">Reset</a>
                    @endif
                </form>

                <!-- Tabel Data Peserta -->
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 4%">No</th>
                                <th>KTP</th>
                                <th>Ijazah</th>
                                <th>Sertifikat</th>
                                <th>NIK & Nama Peserta</th>
                                <th>Gender</th>
                                <th>Skema Sertifikasi</th>
                                <th>Kontak</th>
                                <th>Status Verifikasi</th>
                                <th style="width: 18%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pesertas as $key => $peserta)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <!-- Foto KTP -->
                                    <td>
                                        @if($peserta->foto_ktp)
                                            <a href="{{ asset('storage/' . $peserta->foto_ktp) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $peserta->foto_ktp) }}" class="img-ktp" alt="KTP">
                                            </a>
                                        @else
                                            <span style="color: #94a3b8; font-size: 0.75rem;">Tidak Ada</span>
                                        @endif
                                    </td>

                                    <!-- Ijazah (Ditampilkan berupa gambar/thumbnail) -->
                                    <td>
                                        @if($peserta->ijazah)
                                            <a href="{{ asset('storage/' . $peserta->ijazah) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $peserta->ijazah) }}" class="img-ktp" alt="Ijazah">
                                            </a>
                                        @else
                                            <span style="color: #94a3b8; font-size: 0.75rem;">Tidak Ada</span>
                                        @endif
                                    </td>

                                    <!-- Sertifikat (Ditampilkan berupa gambar/thumbnail menggunakan foto_sertifikat) -->
                                    <td>
                                        @if($peserta->foto_sertifikat)
                                            <a href="{{ asset('storage/' . $peserta->foto_sertifikat) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $peserta->foto_sertifikat) }}" class="img-ktp" alt="Sertifikat">
                                            </a>
                                        @else
                                            <span style="color: #94a3b8; font-size: 0.75rem;">Tidak Ada</span>
                                        @endif
                                    </td>

                                    <!-- NIK & Nama -->
                                    <td>
                                        <strong>{{ $peserta->nama_peserta }}</strong><br>
                                        <small style="color: #64748b;">NIK: {{ $peserta->nik ?? '-' }}</small>
                                    </td>

                                    <!-- Jenis Kelamin -->
                                    <td>
                                        {{ $peserta->jenis_kelamin === 'L' ? 'Laki-Laki' : ($peserta->jenis_kelamin === 'P' ? 'Perempuan' : '-') }}
                                    </td>

                                    <!-- Skema Sertifikasi -->
                                    <td>
                                        {{ $peserta->skema->nama_skema ?? 'Tidak Ada Skema' }}
                                    </td>

                                    <!-- Email & No HP -->
                                    <td>
                                        {{ $peserta->email }}<br>
                                        <small style="color: #64748b;">{{ $peserta->no_hp }}</small>
                                    </td>

                                    <!-- Badge Status Verifikasi -->
                                    <td>
                                        @if(optional($peserta->user)->status_verifikasi === 'approved')
                                            <span class="badge badge-approved">Disetujui</span>
                                        @elseif(optional($peserta->user)->status_verifikasi === 'rejected')
                                            <span class="badge badge-rejected">Ditolak</span>
                                        @else
                                            <span class="badge badge-pending">Menunggu</span>
                                        @endif
                                    </td>

                                    <!-- Tombol Aksi Verifikasi & CRUD -->
                                    <td>
                                        <div class="action-buttons">
                                            @if(optional($peserta->user)->status_verifikasi === 'pending')
                                                <!-- Tombol Setujui -->
                                                <form action="{{ route('peserta.verifikasi', $peserta->id) }}" method="POST" class="inline-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success" style="padding: 0.4rem 0.6rem;" title="Setujui Peserta" onclick="return confirm('Setujui pendaftaran peserta ini?')">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>

                                                <!-- Tombol Tolak -->
                                                <form action="{{ route('peserta.tolak', $peserta->id) }}" method="POST" class="inline-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-warning" style="padding: 0.4rem 0.6rem;" title="Tolak Peserta" onclick="return confirm('Tolak pendaftaran peserta ini?')">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="{{ route('peserta.show', $peserta->id) }}" class="btn btn-info" style="padding: 0.4rem 0.6rem;" title="Detail Peserta">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a href="{{ route('peserta.edit', $peserta->id) }}" class="btn btn-secondary" style="padding: 0.4rem 0.6rem; background: #64748b;" title="Edit Peserta">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="padding: 0.4rem 0.6rem;" title="Hapus Peserta">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="empty-data">
                                        Data peserta tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

</body>

</html>