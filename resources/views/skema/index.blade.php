@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Skema Sertifikasi</h5>
        <a href="{{ route('skema.create') }}" class="btn btn-light btn-sm">Tambah Skema Baru</a>
    </div>
    <div class="card-body">
        
        {{-- Notifikasi Sukses / Gagal --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tabel Data Skema -->
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Kode Skema</th>
                    <th>Nama Skema Sertifikasi</th>
                    <th>Jenis</th>
                    <th>Jumlah Unit</th>
                    <th style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skemas as $key => $skema)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><span class="badge bg-secondary">{{ $skema->kode_skema }}</span></td>
                    <td>{{ $skema->nama_skema }}</td>
                    <td>{{ $skema->jenis }}</td>
                    <td>{{ $skema->jumlah_unit }} Unit</td>
                    <td>
                      
                        <a href="{{ route('skema.edit', $skema->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                        
                       
                        <form action="{{ route('skema.destroy', $skema->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus skema ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-3">Data skema sertifikasi belum tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
