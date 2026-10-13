<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Peserta;
use App\Models\SkemaSertifikasi;

class AuthController extends Controller
{
    public function showLogin()
    {
        // 1. Jika pengguna sudah login, alihkan sesuai role-nya
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard'); // atau redirect('/admin')
            }
            return redirect()->route('peserta.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek Case-Sensitive Email
        if (!$user || $user->email !== $request->email) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        // Verifikasi Password dan Login
        if (Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->has('remember'));
            $request->session()->regenerate();

            // Redirect berdasarkan role user
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard'); // Arahkan ke panel Admin / Filament
            }

            return redirect()->intended(route('peserta.dashboard')); // Arahkan ke Dashboard Peserta
        }

        // Jika password salah
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // --- DASHBOARD ADMIN ---
    public function dashboard()
    {
        // Proteksi Auth & Role Admin
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'admin') {
            return redirect()->route('peserta.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Admin.');
        }

        $totalPeserta = Peserta::count();
        $totalSkema = SkemaSertifikasi::count();

        // Mengambil view dari folder resources/views/admin/dashboard.blade.php
        return response()
            ->view('admin.dashboard', compact('totalPeserta', 'totalSkema'))
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
    }

    // --- DASHBOARD PESERTA ---
    public function pesertaDashboard()
    {
        // Proteksi Auth & Role Peserta
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Mengambil view dari folder resources/views/peserta/dashboard.blade.php
        return response()
            ->view('peserta.dashboard')
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
    }




    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('peserta.dashboard');
        }

        // Ambil semua daftar skema sertifikasi
        $skemas = SkemaSertifikasi::all();

        return view('auth.register', compact('skemas'));
    }

    // 2. Proses Registrasi Peserta
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'skema_id' => 'required|exists:skema_sertifikasi,id',
            'no_hp'    => 'required|string|max:20',
            'alamat'   => 'required|string',
            'email'    => 'required|string|email|max:255|unique:users,email|unique:peserta,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Menggunakan DB Transaction agar pembuatan user & peserta selalu sukses bersamaan
        DB::transaction(function () use ($request) {
            // 1. Buat Akun User Utama (Role = Peserta)
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'peserta',
            ]);

            // 2. Buat Detail Peserta (Sertakan user_id dari id user yang baru dibuat)
            Peserta::create([
                'user_id'      => $user->id, // <-- PENTING: Memasukkan user_id yang terhubung
                'skema_id'     => $request->skema_id,
                'nama_peserta' => $request->name,
                'no_hp'        => $request->no_hp,
                'alamat'       => $request->alamat,
                'email'        => $request->email,
            ]);

            // Otomatis login setelah pendaftaran berhasil
            Auth::login($user);
        });

        return redirect()->route('peserta.dashboard')->with('success', 'Pendaftaran akun peserta berhasil!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
