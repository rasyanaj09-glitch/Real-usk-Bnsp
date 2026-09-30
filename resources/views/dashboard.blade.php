<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Peserta</title>

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
            min-height: 100vh;
        }

        /* Top Navbar */
        .navbar {
            background: #151922;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .navbar .logo {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar .user-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar .user-name {
            font-size: 14px;
            color: #bfc3ca;
        }

        /* Tombol Logout Merah */
        .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 9px 18px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-logout:hover {
            background: #bb2d3b;
        }

        /* Container Content */
        .container {
            width: 92%;
            max-width: 1250px;
            margin: 35px auto;
        }

        .header {
            background: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .header h1 {
            font-size: 26px;
            margin-bottom: 8px;
            color: #222;
        }

        .header p {
            color: #777;
            font-size: 14px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            background: #ffe5e5;
            color: #c0392b;
            border: 1px solid #ffcccc;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .card {
            position: relative;
            padding: 30px;
            border-radius: 15px;
            color: white;
            min-height: 190px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-dark {
            background: linear-gradient(135deg, #212529, #343a40);
        }

        .card-gray {
            background: linear-gradient(135deg, #6c757d, #495057);
        }

        .card h3 {
            font-size: 17px;
            margin-bottom: 20px;
            font-weight: normal;
        }

        .card .number {
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .card a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .container {
                width: 95%;
                margin: 20px auto;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar Atas dengan Tombol Logout -->
    <div class="navbar">
        <div class="logo">Sistem Sertifikasi BNSP</div>

        <div class="user-section">
            <span class="user-name">
                Halo, {{ Auth::user()->name ?? Auth::user()->email ?? 'Admin' }}
            </span>

            <!-- Form Logout -->
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="container">

        <!-- Judul -->
        <div class="header">
            <h1>Selamat Datang di Aplikasi Pengelolaan Data Peserta</h1>
            <p>Ringkasan data sistem sertifikasi kompetensi.</p>
        </div>

        <!-- Pesan Error -->
        @if(session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Statistik -->
        <div class="cards">

            <!-- Total Skema -->
            <div class="card card-dark">
                <h3>Total Skema Sertifikasi</h3>
                <div class="number">
                    {{ $totalSkema }}
                </div>
                <a href="{{ route('skema.index') }}">
                    Lihat Detail →
                </a>
            </div>

            <!-- Total Peserta -->
            <div class="card card-gray">
                <h3>Total Peserta Terdaftar</h3>
                <div class="number">
                    {{ $totalPeserta }}
                </div>
                <a href="{{ route('peserta.index') }}">
                    Lihat Detail →
                </a>
            </div>

        </div>

    </div>

</body>
</html>