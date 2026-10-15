<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = Peserta::with('skema', 'user');

        if ($request->has('cari') && !empty($request->cari)) {
            $keyword = $request->cari;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_peserta', 'LIKE', "%$keyword%")
                  ->orWhere('email', 'LIKE', "%$keyword%")
                  ->orWhere('nik', 'LIKE', "%$keyword%")
                  ->orWhere('no_hp', 'LIKE', "%$keyword%");
            });
        }

        $pesertas = $query->latest()->get();
        return view('peserta.index', compact('pesertas'));
    }

    public function create()
    {
        $skemas = SkemaSertifikasi::all();
        return view('peserta.create', compact('skemas'));
    }

    // 1. ADMIN MEMBUAT AKUN PESERTA BARU (LANGSUNG APPROVED)
    public function store(Request $request)
    {
        $request->validate([
            'skema_id'      => 'required|exists:skema_sertifikasi,id',
            'nik'           => 'required|numeric|digits:16|unique:peserta,nik',
            'jenis_kelamin' => 'required|in:L,P',
            'foto_ktp'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_peserta'  => 'required|string|max:255',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'email'         => 'required|email|unique:users,email|unique:peserta,email',
            'password'      => 'required|string|min:8',
        ]);

        $ktpPath = null;
        if ($request->hasFile('foto_ktp')) {
            $ktpPath = $request->file('foto_ktp')->store('ktp', 'public');
        }

        DB::transaction(function () use ($request, $ktpPath) {
            // Karena dibuat langsung oleh Admin, status_verifikasi di-set 'approved'
            $user = User::create([
                'name'              => $request->nama_peserta,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'role'              => 'peserta',
                'status_verifikasi' => 'approved',
            ]);

            Peserta::create([
                'user_id'       => $user->id,
                'skema_id'      => $request->skema_id,
                'nik'           => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'foto_ktp'      => $ktpPath,
                'nama_peserta'  => $request->nama_peserta,
                'alamat'        => $request->alamat,
                'no_hp'         => $request->no_hp,
                'email'         => $request->email,
            ]);
        });

        return redirect()->route('peserta.index')->with('success', 'Akun peserta berhasil dibuat oleh Admin.');
    }

    public function show($id)
    {
        $peserta = Peserta::with('skema', 'user')->findOrFail($id);
        return view('peserta.show', compact('peserta'));
    }

    public function edit($id)
    {
        $peserta = Peserta::with('user')->findOrFail($id);
        $skemas  = SkemaSertifikasi::all();
        return view('peserta.edit', compact('peserta', 'skemas'));
    }

    // 2. ADMIN EDIT DATA PESERTA & UPLOAD/UPDATE KTP
    public function update(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);

        $request->validate([
            'skema_id'      => 'required|exists:skema_sertifikasi,id',
            'nik'           => 'required|numeric|digits:16|unique:peserta,nik,' . $id,
            'jenis_kelamin' => 'required|in:L,P',
            'foto_ktp'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_peserta'  => 'required|string|max:255',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'email'         => 'required|email|unique:peserta,email,' . $id . '|unique:users,email,' . $peserta->user_id,
            'password'      => 'nullable|string|min:8',
        ]);

        $ktpPath = $peserta->foto_ktp;
        if ($request->hasFile('foto_ktp')) {
            // Hapus foto KTP lama jika ada
            if ($peserta->foto_ktp) {
                Storage::disk('public')->delete($peserta->foto_ktp);
            }
            $ktpPath = $request->file('foto_ktp')->store('ktp', 'public');
        }

        DB::transaction(function () use ($request, $peserta, $ktpPath) {
            $peserta->update([
                'skema_id'      => $request->skema_id,
                'nik'           => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'foto_ktp'      => $ktpPath,
                'nama_peserta'  => $request->nama_peserta,
                'alamat'        => $request->alamat,
                'no_hp'         => $request->no_hp,
                'email'         => $request->email,
            ]);

            if ($peserta->user) {
                $userData = [
                    'name'  => $request->nama_peserta,
                    'email' => $request->email,
                ];

                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->password);
                }

                $peserta->user->update($userData);
            }
        });

        return redirect()->route('peserta.index')->with('success', 'Data & profil peserta berhasil diperbarui.');
    }

    // 3. ADMIN VERIFIKASI (APPROVE) AKUN PESERTA
    public function verifikasi($id)
    {
        $peserta = Peserta::findOrFail($id);

        if ($peserta->user) {
            $peserta->user->update([
                'status_verifikasi' => 'approved'
            ]);
        }

        return back()->with('success', 'Akun peserta ' . $peserta->nama_peserta . ' berhasil diverifikasi.');
    }

    // 4. ADMIN TOLAK (REJECT) AKUN PESERTA
    public function tolak($id)
    {
        $peserta = Peserta::findOrFail($id);

        if ($peserta->user) {
            $peserta->user->update([
                'status_verifikasi' => 'rejected'
            ]);
        }

        return back()->with('success', 'Pendaftaran peserta ' . $peserta->nama_peserta . ' telah ditolak.');
    }

    // 5. HAPUS PESERTA & BERKAS KTP
    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);

        // Hapus file KTP dari storage jika ada
        if ($peserta->foto_ktp) {
            Storage::disk('public')->delete($peserta->foto_ktp);
        }

        // Hapus User (Otomatis menghapus Peserta karena cascade)
        if ($peserta->user) {
            $peserta->user->delete();
        } else {
            $peserta->delete();
        }

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }
}