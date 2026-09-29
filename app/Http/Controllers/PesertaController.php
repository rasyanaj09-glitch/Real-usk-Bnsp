<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = Peserta::with('skema');

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where('nama_peserta', 'LIKE', "%$keyword%")
                  ->orWhere('email', 'LIKE', "%$keyword%");
        }

        $pesertas = $query->get();
        return view('peserta.index', compact('pesertas'));
    }

    public function create()
    {
        $skemas = SkemaSertifikasi::all();
        return view('peserta.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skema_id' => 'required|exists:skema_sertifikasi,id',
            'nama_peserta' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:peserta,email',
        ]);

        Peserta::create($request->all());
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil didaftarkan.');
    }

    public function show($id)
    {
        $peserta = Peserta::with('skema')->findOrFail($id);
        return view('peserta.show', compact('peserta'));
    }

    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        $skemas = SkemaSertifikasi::all();
        return view('peserta.edit', compact('peserta', 'skemas'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'skema_id' => 'required|exists:skema_sertifikasi,id',
        'nama_peserta' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required',
        'email' => 'required|email|unique:peserta,email,' . $id,
    ]);

    $peserta = Peserta::findOrFail($id);

    $peserta->update([
        'skema_id' => $request->skema_id,
        'nama_peserta' => $request->nama_peserta,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
    ]);

    dd($peserta->fresh());

    return redirect()->route('peserta.index')
        ->with('success', 'Data peserta berhasil diperbarui.');
}

    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }
}
 