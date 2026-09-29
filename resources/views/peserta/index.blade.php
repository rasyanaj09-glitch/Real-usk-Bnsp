```blade
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Peserta Sertifikasi</title>

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
            max-width: 1200px;
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

        .card-body {
            padding: 25px;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            position: relative;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .alert-danger {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .btn-close {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            font-size: 20px;
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
            padding: 11px 14px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        .search-input:focus {
            border-color: #343a40;
            box-shadow: 0 0 0 3px rgba(52, 58, 64, 0.10);
        }

        .btn-dark {
            background: #212529;
            color: white;
        }

        .btn-dark:hover {
            background: #000;
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
            background: #212529;
            color: white;
            padding: 13px 12px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 13px 12px;
            border-bottom: 1px solid #dee2e6;
            font-size: 14px;
        }

        tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        tbody tr:hover {
            background: #eef1f4;
        }

        .text-center {
            text-align: center;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .btn-info {
            background: #0dcaf0;
            color: white;
        }

        .btn-info:hover {
            background: #0aa2c0;
        }

        .btn-warning {
            background: #ffc107;
            color: white;
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #bb2d3b;
        }

        .inline-form {
            display: inline;
        }

        .empty-data {
            padding: 30px;
            text-align: center;
            color: #777;
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

            .card-body {
                padding: 15px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-input {
                max-width: 100%;
            }

            .btn-dark {
                width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn,
            .action-buttons button {
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
                    Daftar Peserta Sertifikasi
                </h2>

                <a
                    href="{{ route('peserta.create') }}"
                    class="btn btn-light">
                    Tambah Peserta Baru
                </a>

            </div>


            <div class="card-body">

                @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        onclick="this.parentElement.style.display='none'">
                        ×
                    </button>

                </div>

                @endif


                @if(session('error'))

                <div class="alert alert-danger">

                    {{ session('error') }}

                    <button
                        type="button"
                        class="btn-close"
                        onclick="this.parentElement.style.display='none'">
                        ×
                    </button>

                </div>

                @endif


                <form
                    action="{{ route('peserta.index') }}"
                    method="GET"
                    class="search-form">

                    <input
                        type="text"
                        name="cari"
                        class="search-input"
                        placeholder="Cari nama atau email..."
                        value="{{ request('cari') }}">

                    <button
                        type="submit"
                        class="btn btn-dark">
                        Cari Data
                    </button>

                </form>


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th style="width: 5%">
                                    No
                                </th>

                                <th>
                                    Nama Peserta
                                </th>

                                <th>
                                    Skema Sertifikasi
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    No. HP
                                </th>

                                <th style="width: 20%">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($pesertas as $key => $peserta)

                            <tr>

                                <td>
                                    {{ $key + 1 }}
                                </td>

                                <td>
                                    {{ $peserta->nama_peserta }}
                                </td>

                                <td>
                                    {{ $peserta->skema->nama_skema ?? 'Tidak Ada Skema' }}
                                </td>

                                <td>
                                    {{ $peserta->email }}
                                </td>

                                <td>
                                    {{ $peserta->no_hp }}
                                </td>

                                <td>

                                    <div class="action-buttons">

                                        <a
                                            href="{{ route('peserta.show', $peserta->id) }}"
                                            class="btn btn-info">
                                            Detail
                                        </a>


                                        <a
                                            href="{{ route('peserta.edit', $peserta->id) }}"
                                            class="btn btn-warning">
                                            Edit
                                        </a>


                                        <form
                                            action="{{ route('peserta.destroy', $peserta->id) }}"
                                            method="POST"
                                            class="inline-form"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="empty-data">
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
```