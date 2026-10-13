<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Portal Sertifikasi USK</title>

    <!-- Google Fonts & FontAwesome Icons -->
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
            background-color: #f8fafc;
            color: #0f172a;
            min-height: 100vh;
        }

        /* Top Navbar */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.9rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.15rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.3px;
        }

        .navbar .brand i {
            color: #4f46e5;
            font-size: 1.3rem;
        }

        .badge-admin {
            background-color: #e0e7ff;
            color: #4338ca;
            font-size: 0.725rem;
            font-weight: 700;
            padding: 0.25rem 0.6rem;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .btn-logout {
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #dc2626;
            padding: 0.5rem 1.1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: #dc2626;
            color: #ffffff;
            border-color: #dc2626;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        /* Welcome Banner */
        .welcome-card {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #ffffff;
            padding: 2rem 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.2);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-text h1 {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 0.4rem;
        }

        .welcome-text p {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .welcome-icon {
            font-size: 3rem;
            color: rgba(255, 255, 255, 0.15);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #ffffff;
            padding: 1.75rem;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        }

        .stat-left {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.peserta {
            background-color: #e0e7ff;
            color: #4f46e5;
        }

        .stat-icon.skema {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .stat-info h3 {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.5px;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-info .number {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.65rem 1.1rem;
            background: #0f172a;
            color: #ffffff;
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.825rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            background: #334155;
            transform: translateX(2px);
        }

        .btn-action.blue {
            background: #2563eb;
        }

        .btn-action.blue:hover {
            background: #1d4ed8;
        }

        /* Recent Activity Table Card */
        .table-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            padding: 1.75rem;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-title i {
            color: #4f46e5;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: #f8fafc;
            color: #475569;
            padding: 0.85rem 1rem;
            font-size: 0.775rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.875rem;
            color: #334155;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        .badge-skema {
            display: inline-block;
            background: #f1f5f9;
            color: #334155;
            padding: 0.25rem 0.65rem;
            border-radius: 6px;
            font-size: 0.775rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.9rem 1.25rem;
            }
            .welcome-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .welcome-icon {
                display: none;
            }
            .stat-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.25rem;
            }
            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <!-- Top Navbar -->
    <nav class="navbar">
        <div class="brand">
            <i class="fa-solid fa-shield-halved"></i>
            PANEL ADMIN USK
            <span class="badge-admin">Administrator</span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </nav>

    <!-- Main Container -->
    <div class="container">

        <!-- Welcome Banner -->
        <div class="welcome-card">
            <div class="welcome-text">
                <h1>Selamat Datang, {{ Auth::user()->name }} 👋</h1>
                <p>Kelola data peserta, skema sertifikasi, dan akun pendaftar melalui kontrol panel ini.</p>
            </div>
            <div class="welcome-icon">
                <i class="fa-solid fa-user-gear"></i>
            </div>
        </div>

        <!-- Kartu Statistik Utama -->
        <div class="stats-grid">

            <!-- Card Total Peserta -->
            <div class="stat-card">
                <div class="stat-left">
                    <div class="stat-icon peserta">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Peserta</h3>
                        <div class="number">{{ $totalPeserta ?? 0 }}</div>
                    </div>
                </div>
                <a href="{{ route('peserta.index') }}" class="btn-action">
                    Kelola Peserta <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- Card Total Skema -->
            <div class="stat-card">
                <div class="stat-left">
                    <div class="stat-icon skema">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Skema Sertifikasi</h3>
                        <div class="number">{{ $totalSkema ?? 0 }}</div>
                    </div>
                </div>
                <a href="{{ route('skema.index') }}" class="btn-action blue">
                    Kelola Skema <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>

        <!-- Tabel Ringkasan Peserta Terbaru -->
        <div class="table-card">
            <div class="table-header">
                <div class="table-title">
                    <i class="fa-solid fa-clock-rotate-left"></i> Pendaftaran Peserta Terbaru
                </div>
                <a href="{{ route('peserta.create') }}" class="btn-action" style="background: #10b981;">
                    <i class="fa-solid fa-user-plus"></i> Tambah Peserta
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>Skema Sertifikasi</th>
                            <th>Email</th>
                            <th>No. HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertas ?? [] as $index => $peserta)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td style="font-weight: 700; color: #0f172a;">{{ $peserta->nama_peserta }}</td>
                                <td>
                                    <span class="badge-skema">
                                        {{ $peserta->skema->nama_skema ?? 'Belum Ada' }}
                                    </span>
                                </td>
                                <td>{{ $peserta->email }}</td>
                                <td>{{ $peserta->no_hp }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: #94a3b8; padding: 2rem;">
                                    Belum ada peserta yang mendaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>