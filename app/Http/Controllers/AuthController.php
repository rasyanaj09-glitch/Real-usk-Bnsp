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
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('peserta.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek Case-Sensitive Email
        if (!$user || $user->email !== $request->email) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        // Verifikasi Password
        if (Hash::check($request->password, $user->password)) {

            // 1. JIKA ADMIN: Langsung izinkan masuk tanpa cek verifikasi
            if ($user->role === 'admin') {
                Auth::login($user, $request->has('remember'));
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }

            // 2. JIKA PESERTA: Cek Status Verifikasi oleh Admin
            if ($user->role === 'peserta') {
                if ($user->status_verifikasi === 'pending') {
                    return back()->withErrors([
                        'email' => 'Akun Anda sedang menunggu verifikasi dari Admin. Silakan tunggu persetujuan.',
                    ])->onlyInput('email');
                }

                if ($user->status_verifikasi === 'rejected') {
                    return back()->withErrors([
                        'email' => 'Pendaftaran akun Anda telah ditolak oleh Admin silahkan hubungi admin.',
                    ])->onlyInput('email');
                }

                // Jika status 'approved', izinkan login
                Auth::login($user, $request->has('remember'));
                $request->session()->regenerate();

                return redirect()->intended(route('peserta.dashboard'));
            }
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
        $totalSkema   = SkemaSertifikasi::count();
        $pesertas     = Peserta::with('skema', 'user')->latest()->take(5)->get();

        return response()
            ->view('admin.dashboard', compact('totalPeserta', 'totalSkema', 'pesertas'))
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

    // --- PROSES REGISTRASI PESERTA MANDIRI ---
    public function register(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'nik'           => 'required|numeric|digits:16|unique:peserta,nik',
            'jenis_kelamin' => 'required|in:L,P',
            'foto_ktp'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ijazah'        => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_sertifikat'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'skema_id'      => 'required|exists:skema_sertifikasi,id',
            'no_hp'         => 'required|string|max:20',
            'alamat'        => 'required|string',
            'email'         => 'required|string|email|max:255|unique:users,email|unique:peserta,email',
            'password'      => 'required|string|min:8|confirmed',
        ]);

        // Simpan Berkas Foto KTP ke storage/app/public/ktp
        $ktpPath = null;
        if ($request->hasFile('foto_ktp')) {
            $ktpPath = $request->file('foto_ktp')->store('ktp', 'public');
        }

        // Menggunakan DB Transaction agar pembuatan user & peserta selalu sukses bersamaan
        DB::transaction(function () use ($request, $ktpPath) {
            // 1. Buat Akun User Utama (Role = Peserta, Status = Pending)
            $user = User::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'role'              => 'peserta',
                'status_verifikasi' => 'pending',
            ]);

            // 2. Buat Detail Peserta
            Peserta::create([
                'user_id'       => $user->id,
                'skema_id'      => $request->skema_id,
                'nik'           => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'foto_ktp'      => $ktpPath,
                'ijazah'        => $request->file('ijazah') ? $request->file('ijazah')->store('ijazah', 'public') : null,
                'foto_sertifikat'    => $request->file('foto_sertifikat') ? $request->file('foto_sertifikat')->store('foto_sertifikat', 'public') : null,
                'nama_peserta'  => $request->name,
                'no_hp'         => $request->no_hp,
                'alamat'        => $request->alamat,
                'email'         => $request->email,
            ]);
        });

        // Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Akun Anda sedang menunggu verifikasi dari Admin.');
    }

 
   // --- UPDATE PROFILE PESERTA ---
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'no_hp'    => 'required|string|max:20',
            'alamat'   => 'required|string',
            'email'    => 'required|email|unique:users,email,' . $user->id . '|unique:peserta,email,' . optional($user->peserta)->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $userData = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Garis merah akan langsung hilang
        $user->update($userData);

        if ($user->peserta) {
            $user->peserta->update([
                'nama_peserta' => $request->name,
                'no_hp'        => $request->no_hp,
                'alamat'       => $request->alamat,
                'email'        => $request->email,
            ]);
        }

        return back()->with('success', 'Profil Anda berhasil diperbarui!');
    }

    // --- LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}