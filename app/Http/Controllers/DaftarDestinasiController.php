<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use App\Models\DaftarDestinasi;

class DaftarDestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftar_destinasi = DaftarDestinasi::with(['paket'])->get();
        return view('admin.page.daftar_destinasi.index',['daftar_destinasi'=>$daftar_destinasi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $paket = Paket::all();
        $daftar_destinasi = DaftarDestinasi::all();
        
        // Check if this is a synchronized request from paket show page
        $paket_id = $request->get('paket_id');
        $is_synchronized = !is_null($paket_id);
        
        if ($is_synchronized && $paket_id) {
            $selected_paket = Paket::find($paket_id);
            if (!$selected_paket) {
                return redirect()->route('daftar-d.create')
                    ->with('error', 'Paket tidak ditemukan!');
            }
            
            // Return synchronized view
            return view('admin.page.daftar_destinasi.create-sync', [
                'selected_paket' => $selected_paket,
                'daftar_destinasi' => $daftar_destinasi
            ]);
        }
        
        // Return normal view
        return view('admin.page.daftar_destinasi.create', [
            'paket' => $paket,
            'daftar_destinasi' => $daftar_destinasi
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
            'daftar_destinasi' => 'nullable|array',
            'daftar_destinasi.*' => 'exists:daftar_destinasi,id',
            'nama_destinasi_baru' => 'nullable|string',
        ], [
            'paket.required' => 'Minimal satu paket harus dipilih!',
        ]);

        $destinasiId = $request->input('daftar_destinasi', []);
        $paketIds = $request->input('paket', []);
        if ($request->filled('nama_destinasi_baru')) {
            $namaDestinasiBaru = explode(',', $request->nama_destinasi_baru);

            foreach ($namaDestinasiBaru as $nama) {
                $nama = trim($nama);

                $existing = DaftarDestinasi::where('nama_destinasi', $nama)->first();
                if (!$existing) {
                    $newDestinasi = DaftarDestinasi::create([
                        'nama_destinasi' => $nama,
                    ]);
                    $destinasiId[] = $newDestinasi->id;
                } else {
                    $destinasiId[] = $existing->id;
                }
            }
        }

        $destinasiId = array_filter($destinasiId);
        foreach ($paketIds as $id) {
            $paket = Paket::find($id);
            if ($paket && !empty($destinasiId)) {
                $paket->daftar_destinasi()->attach($destinasiId);
            }
        }

        // Check if this is a synchronized request and redirect accordingly
        if ($request->has('is_synchronized') && count($paketIds) === 1) {
            $paket_id = $paketIds[0];
            return redirect()->route('paket.show', $paket_id)
                ->with('success', 'Data destinasi berhasil ditambahkan ke paket!');
        }

        return redirect()->route('paket.index')->with('success', 'Data destinasi berhasil ditambahkan!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $daftar_destinasi = DaftarDestinasi::findOrFail($id);
        $paket = Paket::all();
    
        return view('admin.page.daftar_destinasi.edit', compact('daftar_destinasi', 'paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_destinasi' => 'required|string|max:255',
        ], [
            'nama_destinasi.required' => 'Nama destinasi wajib diisi.',
            'nama_destinasi.max' => 'Nama destinasi maksimal 255 karakter.',
        ]);
    
        $daftar_destinasi = DaftarDestinasi::findOrFail($id);
        $daftar_destinasi->nama_destinasi = $request->input('nama_destinasi');
        $daftar_destinasi->save();
    
        // Update relasi paket
        $paketId = $request->input('paket', []);
        $daftar_destinasi->paket()->sync($paketId);
    
        return redirect()->route('daftar-d.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $daftar_destinasi = DaftarDestinasi::findOrFail($id);
        $daftar_destinasi->paket()->detach();
        $daftar_destinasi->delete();
        return redirect()->back()->with('success', 'Data destinasi berhasil dihapus!');
    }
}
