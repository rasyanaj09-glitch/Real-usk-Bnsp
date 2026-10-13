<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Sertifikasi Profesi - USK</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #1e293b;
        }

        /* Navbar */
        .navbar {
            border-bottom: 2px solid #0f172a;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 1.25rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-actions {
            display: flex;
            gap: 0.75rem;
        }

        /* Outline Buttons */
        .btn-outline {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            border: 2px solid #0f172a;
            background-color: transparent;
            color: #0f172a;
            font-weight: 700;
            text-decoration: none;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            background-color: #0f172a;
            color: #ffffff;
        }

        .btn-outline-primary {
            border-color: #2563eb;
            color: #2563eb;
        }

        .btn-outline-primary:hover {
            background-color: #2563eb;
            color: #ffffff;
        }

        /* Hero Section */
        .hero {
            max-width: 900px;
            margin: 4rem auto;
            padding: 2rem 1rem;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.125rem;
            color: #475569;
            margin-bottom: 2rem;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        /* Outline Card Section */
        .card-container {
            max-width: 900px;
            margin: 2rem auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 0 1rem;
        }

        .card-outline {
            border: 2px solid #0f172a;
            padding: 1.5rem;
            background-color: #ffffff;
        }

        .card-outline h3 {
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
        }

        .card-outline p {
            font-size: 0.875rem;
            color: #64748b;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="brand">LSP Digital USK</div>
        <div class="nav-actions">
            @auth
                <a href="{{ route('peserta.dashboard') }}" class="btn-outline btn-outline-primary">Dashboard Saya</a>
            @else
                <a href="{{ route('login') }}" class="btn-outline">Login</a>
                <a href="{{ route('register') }}" class="btn-outline btn-outline-primary">Daftar Akun</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Sistem Sertifikasi & Uji Kompetensi</h1>
        <p>Pendaftaran akun dan pengelolaan data diri peserta sertifikasi dalam satu platform terpadu.</p>
        <div class="hero-buttons">
            <a href="{{ route('register') }}" class="btn-outline btn-outline-primary">Daftar Sekarang</a>
            <a href="{{ route('login') }}" class="btn-outline">Masuk ke Akun</a>
        </div>
    </section>

</body>
</html>