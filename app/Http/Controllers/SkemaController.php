<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Wajib di-import untuk best practice logging
use Illuminate\Support\Facades\DB;  // Wajib di-import untuk database transaction

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
     * Menampilkan form tambah skema
     */
    public function create()
    {
        return view('skema.create');
    }

    /**
     * Menyimpan data skema baru (Menggunakan Try-Catch & Transaction)
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_skema'  => 'required|unique:skema_sertifikasi,kode_skema',
            'nama_skema'  => 'required|string|max:255',
            'jenis'       => 'required|string',
            'jumlah_unit' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Best Practice: Gunakan data yang sudah tervalidasi, bukan $request->all() langsung
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
     * Menampilkan form edit skema
     */
    public function edit($id)
    {
        try {
            $skema = SkemaSertifikasi::findOrFail($id);
            return view('skema.edit', compact('skema'));
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
