@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Skema Sertifikasi</h5>
        <a href="{{ route('skema.index') }}" class="btn btn-light btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        
        {{-- Alert Notification jika terjadi kendala sistem --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('skema.update', $skema->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- PENTING: Wajib ada untuk proses update data di Laravel --}}

            <!-- Input Kode Skema -->
            <div class="mb-3">
                <label for="kode_skema" class="form-label">Kode Skema</label>
                <input type="text" name="kode_skema" id="kode_skema" class="form-control @error('kode_skema') is-invalid @enderror" value="{{ old('kode_skema', $skema->kode_skema) }}" required>
                @error('kode_skema')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Nama Skema -->
            <div class="mb-3">
                <label for="nama_skema" class="form-label">Nama Skema Sertifikasi</label>
                <input type="text" name="nama_skema" id="nama_skema" class="form-control @error('nama_skema') is-invalid @enderror" value="{{ old('nama_skema', $skema->nama_skema) }}" required>
                @error('nama_skema')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pilihan Jenis Skema -->
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Skema</label>
                <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                    <option value="">-- Pilih Jenis --</option>
                    {{-- Sesuaikan opsi pilihan di bawah ini dengan kebutuhan skema ujian Anda --}}
                    <option value="KKNI" {{ old('jenis', $skema->jenis) == 'KKNI' ? 'selected' : '' }}>KKNI</option>
                    <option value="Klaster" {{ old('jenis', $skema->jenis) == 'Klaster' ? 'selected' : '' }}>Klaster</option>
                    <option value="Okupasi" {{ old('jenis', $skema->jenis) == 'Okupasi' ? 'selected' : '' }}>Okupasi</option>
                </select>
                @error('jenis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Jumlah Unit -->
            <div class="mb-3">
                <label for="jumlah_unit" class="form-label">Jumlah Unit Kompetensi</label>
                <input type="number" name="jumlah_unit" id="jumlah_unit" class="form-control @error('jumlah_unit') is-invalid @enderror" value="{{ old('jumlah_unit', $skema->jumlah_unit) }}" min="1" required>
                @error('jumlah_unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-4">
                <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                <a href="{{ route('skema.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
