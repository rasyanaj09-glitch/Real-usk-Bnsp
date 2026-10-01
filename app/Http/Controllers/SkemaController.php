<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Wajib di-import untuk best practice logging
use Illuminate\Support\Facades\DB;   // Wajib di-import untuk database transaction

class SkemaController extends Controller
{
    /**
     * Menampilkan daftar skema sertifikasi
     */
    public function index()
    {
        try {
            $skemas = SkemaSertifikasi::all();
            return view('skema.index', compact('skemas')); 
        } catch (\Exception $e) {
            Log::error('Gagal memuat halaman indeks skema: ' . $e->getMessage());
            
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan sistem saat mengambil data skema.');
        }
    }

    /**
     * Menampilkan form tambah skema (Mengambil daftar jenis unik dari DB)
     */
    public function create()
    {
        try {
            // Mengambil daftar jenis unik yang sudah ada di database
            $jenisList = SkemaSertifikasi::whereNotNull('jenis')
                            ->distinct()
                            ->pluck('jenis');

            return view('skema.create', compact('jenisList'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat halaman create skema: ' . $e->getMessage());
            return redirect()->route('skema.index')->with('error', 'Terjadi kesalahan sistem saat memuat halaman.');
        }
    }

    /**
     * Menyimpan data skema baru (Menggunakan Try-Catch & Transaction)
     */
  public function store(Request $request)
{
    // Jika jenis_custom diisi, gunakan jenis_custom. Jika kosong, gunakan pilihan dropdown (jenis_select)
    $jenisFinal = $request->filled('jenis_custom') ? $request->jenis_custom : $request->jenis_select;

    // Gabungkan ke $request
    $request->merge(['jenis' => $jenisFinal]);

    $validatedData = $request->validate([
        'kode_skema'  => 'required|unique:skema_sertifikasi,kode_skema',
        'nama_skema'  => 'required|string|max:255',
        'jenis'       => 'required|string', // Memastikan salah satu jenis terisi
        'jumlah_unit' => 'required|integer|min:1',
    ]);

    DB::beginTransaction();
    try {
        SkemaSertifikasi::create($validatedData);

        DB::commit();
        return redirect()->route('skema.index')->with('success', 'Skema berhasil ditambahkan.');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Gagal menyimpan skema baru: ' . $e->getMessage());
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data karena kendala sistem.');
    }
}

    /**
     * Menampilkan form edit skema (Mengambil data skema + daftar jenis dari DB)
     */
    public function edit($id)
    {
        try {
            $skema = SkemaSertifikasi::findOrFail($id);

            // Mengambil daftar jenis unik yang sudah ada di database
            $jenisList = SkemaSertifikasi::whereNotNull('jenis')
                            ->distinct()
                            ->pluck('jenis');

            return view('skema.edit', compact('skema', 'jenisList'));
        } catch (\Exception $e) {
            Log::error('Skema tidak ditemukan untuk edit ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('skema.index')->with('error', 'Data skema tidak ditemukan.');
        }
    }

    /**
     * Memperbarui data skema (Menggunakan Try-Catch & Transaction)
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_skema'  => 'required|unique:skema_sertifikasi,kode_skema,' . $id,
            'nama_skema'  => 'required|string|max:255',
            'jenis'       => 'required|string',
            'jumlah_unit' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $skema = SkemaSertifikasi::findOrFail($id);
            $skema->update($validatedData);

            DB::commit();
            return redirect()->route('skema.index')->with('success', 'Skema berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal memperbarui skema ID ' . $id . ': ' . $e->getMessage());
            
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data karena kendala sistem.');
        }
    }

    /**
     * Menghapus data skema
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $skema = SkemaSertifikasi::findOrFail($id);
            $skema->delete();

            DB::commit();
            return redirect()->route('skema.index')->with('success', 'Skema berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menghapus skema ID ' . $id . ': ' . $e->getMessage());
            
            // Menangani error jika skema gagal dihapus karena masih terikat relasi foreign key di tabel peserta
            return redirect()->route('skema.index')->with('error', 'Skema tidak dapat dihapus karena masih digunakan oleh data peserta.');
        }
    }
}