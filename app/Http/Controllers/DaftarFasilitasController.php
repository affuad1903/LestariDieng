<?php

namespace App\Http\Controllers;

use App\Models\DaftarFasilitas;
use App\Models\Paket;
use Illuminate\Http\Request;


class DaftarFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftar_fasilitas = DaftarFasilitas::with(['paket'])->get();
        return view('admin.page.daftar_fasilitas.index',['daftar_fasilitas'=>$daftar_fasilitas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $paket = Paket::all();
        $paket_id = $request->get('paket_id');
        $is_synchronized = !is_null($paket_id);

        if ($is_synchronized && $paket_id) {
            $selected_paket = Paket::find($paket_id);
            if (!$selected_paket) {
                return redirect()->route('daftar-fasilitas.create')
                    ->with('error', 'Paket tidak ditemukan!');
            }

            // ✅ Ambil ID fasilitas yang sudah berelasi dengan paket ini
            $related_fasilitas_ids = $selected_paket->daftar_fasilitas()->pluck('daftar_fasilitas.id')->toArray();

            // ✅ Filter hanya fasilitas yang belum berelasi
            $daftar_fasilitas = DaftarFasilitas::whereNotIn('id', $related_fasilitas_ids)->get();

            return view('admin.page.daftar_fasilitas.create-sync', [
                'selected_paket' => $selected_paket,
                'daftar_fasilitas' => $daftar_fasilitas
            ]);
        }

        // Jika bukan mode sinkronisasi
        $daftar_fasilitas = DaftarFasilitas::all();
        return view('admin.page.daftar_fasilitas.create', [
            'paket' => $paket,
            'daftar_fasilitas' => $daftar_fasilitas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paket' => 'required|array',
            'paket.*' => 'exists:paket,id',
            'daftar_fasilitas' => 'nullable|array',
            'daftar_fasilitas.*' => 'exists:daftar_fasilitas,id',
            'nama_fasilitas_baru' => 'nullable|string',
        ], [
            'paket.required' => 'Minimal satu paket harus dipilih!',
        ]);

        $fasilitasId = $request->input('daftar_fasilitas', []);
        $paketIds = $request->input('paket', []);

        if ($request->filled('nama_fasilitas_baru')) {
            $namaFasilitasBaru = explode(',', $request->nama_fasilitas_baru);

            foreach ($namaFasilitasBaru as $nama) {
                $nama = trim($nama);
                $existing = DaftarFasilitas::where('nama_fasilitas', $nama)->first();
                if (!$existing) {
                    $newFasilitas = DaftarFasilitas::create([
                        'nama_fasilitas' => $nama,
                    ]);
                    $fasilitasId[] = $newFasilitas->id;
                } else {
                    $fasilitasId[] = $existing->id;
                }
            }
        }

        $fasilitasId = array_filter($fasilitasId);

        foreach ($paketIds as $id) {
            $paket = Paket::find($id);
            if ($paket && !empty($fasilitasId)) {
                // ✅ Cek fasilitas yang sudah terhubung
                $existing = $paket->daftar_fasilitas()->pluck('daftar_fasilitas.id')->toArray();
                $newAttach = array_diff($fasilitasId, $existing);

                if (!empty($newAttach)) {
                    $paket->daftar_fasilitas()->attach($newAttach);
                }
            }
        }

        if ($request->has('is_synchronized') && count($paketIds) === 1) {
            $paket_id = $paketIds[0];
            return redirect()->route('paket.show', $paket_id)
                ->with('success', 'Data fasilitas berhasil ditambahkan ke paket!');
        }

        return redirect()->route('paket.index')->with('success', 'Data fasilitas berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $daftar_fasilitas = DaftarFasilitas::findOrFail($id);
        $paket = Paket::all();
    
        return view('admin.page.daftar_fasilitas.edit', compact('daftar_fasilitas', 'paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string',
        ], [
            'nama_fasilitas.required' => 'wajib diisi! (Setidaknya satu saja).',
            'nama_fasilitas.max' => 'Nama fasilitas maksimal 255 karakter.',
        ]);
    
        $daftar_fasilitas = DaftarFasilitas::findOrFail($id);
        $daftar_fasilitas->nama_fasilitas = $request->input('nama_fasilitas');
        $daftar_fasilitas->save();
    
        // Update relasi paket
        $paketId = $request->input('paket', []);
        $daftar_fasilitas->paket()->sync($paketId);
    
        return redirect()->route('daftar-fasilitas.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $daftar_fasilitas = DaftarFasilitas::findOrFail($id);
        $daftar_fasilitas->paket()->detach();
        $daftar_fasilitas->delete();
        return redirect()->back()->with('success', 'Data fasilitas berhasil dihapus!');
    }
}
