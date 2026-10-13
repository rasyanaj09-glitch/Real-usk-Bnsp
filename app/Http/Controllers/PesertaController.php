<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

    // 1. ADMIN MEMBUAT AKUN PESERTA BARU (DENGAN PASSWORD INITIAL)
    public function store(Request $request)
    {
        $request->validate([
            'skema_id'     => 'required|exists:skema_sertifikasi,id',
            'nama_peserta' => 'required|string|max:255',
            'alamat'       => 'required|string',
            'no_hp'        => 'required|string|max:20',
            'email'        => 'required|email|unique:users,email|unique:peserta,email',
            'password'     => 'required|string|min:8',
        ]);

        DB::transaction(function () use ($request) {
            // Buat akun User (login) untuk peserta
            $user = User::create([
                'name'     => $request->nama_peserta,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'peserta',
            ]);

            // Buat data detail peserta
            Peserta::create([
                'user_id'      => $user->id,
                'skema_id'     => $request->skema_id,
                'nama_peserta' => $request->nama_peserta,
                'alamat'       => $request->alamat,
                'no_hp'        => $request->no_hp,
                'email'        => $request->email,
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

    // 2. ADMIN EDIT DATA & RESET PASSWORD PESERTA
    public function update(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);

        $request->validate([
            'skema_id'     => 'required|exists:skema_sertifikasi,id',
            'nama_peserta' => 'required|string|max:255',
            'alamat'       => 'required|string',
            'no_hp'        => 'required|string|max:20',
            'email'        => 'required|email|unique:peserta,email,' . $id . '|unique:users,email,' . $peserta->user_id,
            'password'     => 'nullable|string|min:8', // Nullable: Diisi jika Admin ingin Reset Password
        ]);

        DB::transaction(function () use ($request, $peserta) {
            // Update tabel Peserta
            $peserta->update([
                'skema_id'     => $request->skema_id,
                'nama_peserta' => $request->nama_peserta,
                'alamat'       => $request->alamat,
                'no_hp'        => $request->no_hp,
                'email'        => $request->email,
            ]);

            // Update tabel Users (Akun Login & Password)
            if ($peserta->user) {
                $userData = [
                    'name'  => $request->nama_peserta,
                    'email' => $request->email,
                ];

                // Jika kolom password diisi oleh Admin, lakukan Reset Password
                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->password);
                }

                $peserta->user->update($userData);
            }
        });

        return redirect()->route('peserta.index')->with('success', 'Data & password peserta berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);

        if ($peserta->user) {
            $peserta->user->delete();
        } else {
            $peserta->delete();
        }

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }
}