<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Skema Sertifikasi</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .navbar .logo {
            font-size: 21px;
            font-weight: bold;
        }

        .navbar .subtitle {
            font-size: 13px;
            color: #bfc3ca;
            margin-top: 4px;
        }

        /* Container */
        .container {
            width: 92%;
            max-width: 1250px;
            margin: 35px auto;
        }

        /* Header */
        .page-header {
            background: white;
            border-radius: 12px;
            padding: 25px 30px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        .page-header h1 {
            font-size: 25px;
            color: #1d232f;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #777;
            font-size: 14px;
        }

        /* Group Tombol Header */
        .header-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        /* Button */
        .btn {
            border: none;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 7px;
            padding: 9px 15px;
            font-size: 13px;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn:hover {
            transform: translateY(-1px);
            opacity: 0.9;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            padding: 11px 18px;
        }

        .btn-secondary:hover {
            background: #5c636a;
        }

        .btn-tambah {
            background: #151922;
            color: white;
            padding: 11px 18px;
        }

        .btn-edit {
            background: #f0ad00;
            color: white;
        }

        .btn-hapus {
            background: #dc3545;
            color: white;
        }

        /* Alert */
        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .alert-success {
            background: #dff5e5;
            color: #176b35;
            border: 1px solid #bce5c8;
        }

        .alert-danger {
            background: #fde2e2;
            color: #a51d2a;
            border: 1px solid #f3b9bd;
        }

        .close-alert {
            border: none;
            background: transparent;
            font-size: 20px;
            cursor: pointer;
            color: inherit;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .card-title {
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            font-size: 17px;
            font-weight: bold;
            color: #333;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #151922;
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8f9fb;
        }

        /* Badge */
        .badge {
            display: inline-block;
            background: #e9ecef;
            color: #343a40;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        .jenis {
            background: #e8f0fe;
            color: #2457a6;
        }

        .jumlah {
            font-weight: bold;
        }

        /* Action */
        .aksi {
            display: flex;
            gap: 7px;
            align-items: center;
        }

        .aksi form {
            margin: 0;
        }

        /* Empty */
        .empty {
            text-align: center;
            padding: 45px 20px;
            color: #888;
        }

        .empty-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        /* Footer */
        .footer {
            text-align: center;
            color: #888;
            font-size: 13px;
            padding: 25px;
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
                gap: 18px;
            }

            .page-header h1 {
                font-size: 21px;
            }

            .header-buttons {
                width: 100%;
                flex-direction: column;
            }

            .header-buttons .btn {
                width: 100%;
                text-align: center;
            }

            th,
            td {
                padding: 11px;
            }

            .aksi {
                flex-direction: column;
                align-items: stretch;
            }

            .aksi .btn {
                text-align: center;
            }
        }
    </style>

</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <div>
            <div class="logo">Sistem Sertifikasi</div>
            <div class="subtitle">Manajemen Skema Sertifikasi</div>
        </div>
    </div>

    <!-- Content -->
    <div class="container">

        <!-- Header -->
        <div class="page-header">
            <div>
                <h1>Daftar Skema Sertifikasi</h1>
                <p>Kelola data skema sertifikasi yang tersedia.</p>
            </div>

            <div class="header-buttons">
                <!-- Tombol Kembali ke Dashboard -->
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    Kembali ke Dashboard
                </a>

                <!-- Tombol Tambah Skema Baru -->
                <a href="{{ route('skema.create') }}" class="btn btn-tambah">
                    + Tambah Skema Baru
                </a>
            </div>
        </div>


        <!-- Notifikasi Sukses -->
        @if(session('success'))
        <div class="alert alert-success">
            <span>{{ session('success') }}</span>

            <button type="button"
                class="close-alert"
                onclick="this.parentElement.remove()">
                &times;
            </button>
        </div>
        @endif


        <!-- Notifikasi Error -->
        @if(session('error'))
        <div class="alert alert-danger">
            <span>{{ session('error') }}</span>

            <button type="button"
                class="close-alert"
                onclick="this.parentElement.remove()">
                &times;
            </button>
        </div>
        @endif


        <!-- Table Card -->
        <div class="card">

            <div class="card-title">
                Data Skema Sertifikasi
            </div>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Kode Skema</th>
                            <th>Nama Skema Sertifikasi</th>
                            <th>Jenis</th>
                            <th>Jumlah Unit</th>
                            <th style="width: 18%;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($skemas as $key => $skema)

                        <tr>

                            <!-- Nomor -->
                            <td>
                                {{ $key + 1 }}
                            </td>

                            <!-- Kode -->
                            <td>
                                <span class="badge">
                                    {{ $skema->kode_skema }}
                                </span>
                            </td>

                            <!-- Nama -->
                            <td>
                                <strong>
                                    {{ $skema->nama_skema }}
                                </strong>
                            </td>

                            <!-- Jenis -->
                            <td>
                                <span class="badge jenis">
                                    {{ $skema->jenis }}
                                </span>
                            </td>

                            <!-- Jumlah Unit -->
                            <td>
                                <span class="jumlah">
                                    {{ $skema->jumlah_unit }} Unit
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td>

                                <div class="aksi">

                                    <!-- Edit -->
                                    <a href="{{ route('skema.edit', $skema->id) }}"
                                        class="btn btn-edit">
                                        Edit
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('skema.destroy', $skema->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus skema ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-hapus">
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6">

                                <div class="empty">

                                    <div class="empty-icon">
                                        📋
                                    </div>

                                    <div>
                                        Data skema sertifikasi belum tersedia.
                                    </div>

                                    <br>

                                    <a href="{{ route('skema.create') }}"
                                        class="btn btn-tambah">
                                        + Tambah Skema
                                    </a>

                                </div>

                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Footer -->
        <div class="footer">
            Sistem Manajemen Skema Sertifikasi
        </div>

    </div>

</body>

</html>