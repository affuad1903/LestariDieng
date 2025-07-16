<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Paket;
use Illuminate\Http\Request;
use App\Models\DaftarDestinasi;
use App\Models\DaftarFasilitas;
use Illuminate\Support\Facades\File;

class PaketController extends Controller
{
    public function index()
    {
        $paket = Paket::all();
        return view('admin.page.paket.index', ['paket' => $paket]);
    }

    public function create()
    {
        $daftar_destinasi = DaftarDestinasi::all();
        $daftar_fasilitas = DaftarFasilitas::all();
        return view('admin.page.paket.create', compact('daftar_destinasi', 'daftar_fasilitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'is_main_page' => 'required|boolean',
            'paket_title' => 'required|string|max:255',
            'paket_sub_title_date' => 'required|string',
            'paket_price' => 'required',
            'paket_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = time() . '_paket.' . $request->file('paket_image')->extension();
        $request->file('paket_image')->move(public_path('image/paket'), $imageName);

        $home = Home::first();

        $paket = new Paket;
        $paket->home_id = $home->id;
        $paket->is_main_page = $request->is_main_page;
        $paket->paket_title = $request->paket_title;
        $paket->paket_sub_title_date = $request->paket_sub_title_date;
        $paket->paket_price = $request->paket_price;
        $paket->paket_detail = $request->paket_detail;
        $paket->paket_image = $imageName;
        $paket->save();

        // Tambahkan daftar destinasi
        $destinasiId = $request->input('daftar_destinasi', []);
        if ($request->filled('nama_destinasi_baru')) {
            foreach (explode(',', $request->nama_destinasi_baru) as $nama) {
                $nama = trim($nama);
                $existing = DaftarDestinasi::firstOrCreate(['nama_destinasi' => $nama]);
                $destinasiId[] = $existing->id;
            }
        }
        if (!empty($destinasiId)) {
            $paket->daftar_destinasi()->attach($destinasiId);
        }

        // Tambahkan daftar fasilitas
        $fasilitasId = $request->input('daftar_fasilitas', []);
        if ($request->filled('nama_fasilitas_baru')) {
            foreach (explode(',', $request->nama_fasilitas_baru) as $nama) {
                $nama = trim($nama);
                $existing = DaftarFasilitas::firstOrCreate(['nama_fasilitas' => $nama]);
                $fasilitasId[] = $existing->id;
            }
        }
        if (!empty($fasilitasId)) {
            $paket->daftar_fasilitas()->attach($fasilitasId);
        }

        return redirect()->route('paket.index')->with('success', 'Data paket berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $paket = Paket::with(['daftar_destinasi', 'daftar_fasilitas', 'detailItinerary'])->findOrFail($id);
        return view('admin.page.paket.show', ['paket' => $paket]);
    }

    public function edit(string $id)
    {
        $paket = Paket::with(['daftar_destinasi', 'daftar_fasilitas'])->findOrFail($id);
        $daftar_destinasi = DaftarDestinasi::all();
        $daftar_fasilitas = DaftarFasilitas::all();
        return view('admin.page.paket.edit', compact('paket', 'daftar_destinasi', 'daftar_fasilitas'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'is_main_page' => 'required|boolean',
            'paket_title' => 'required|string|max:255',
            'paket_sub_title_date' => 'required|string',
            'paket_price' => 'required',
            'paket_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $paket = Paket::findOrFail($id);

        if ($request->hasFile('paket_image')) {
            $imageName = time() . '_paket.' . $request->file('paket_image')->extension();
            $request->file('paket_image')->move(public_path('image/paket'), $imageName);
            $paket->paket_image = $imageName;
        }

        $paket->is_main_page = $request->is_main_page;
        $paket->paket_title = $request->paket_title;
        $paket->paket_sub_title_date = $request->paket_sub_title_date;
        $paket->paket_price = $request->paket_price;
        $paket->paket_detail = $request->paket_detail;
        $paket->save();

        // Update destinasi
        $destinasiId = $request->input('daftar_destinasi', []);
        if ($request->filled('nama_destinasi_baru')) {
            foreach (explode(',', $request->nama_destinasi_baru) as $nama) {
                $nama = trim($nama);
                $existing = DaftarDestinasi::firstOrCreate(['nama_destinasi' => $nama]);
                $destinasiId[] = $existing->id;
            }
        }
        $paket->daftar_destinasi()->sync($destinasiId);

        // Update fasilitas
        $fasilitasId = $request->input('daftar_fasilitas', []);
        if ($request->filled('nama_fasilitas_baru')) {
            foreach (explode(',', $request->nama_fasilitas_baru) as $nama) {
                $nama = trim($nama);
                $existing = DaftarFasilitas::firstOrCreate(['nama_fasilitas' => $nama]);
                $fasilitasId[] = $existing->id;
            }
        }
        $paket->daftar_fasilitas()->sync($fasilitasId);

        return redirect()->route('paket.show', $paket->id)->with('success', 'Data paket berhasil diedit!');
    }

    public function destroy(string $id)
    {
        $paket = Paket::findOrFail($id);
        File::delete(public_path('image/paket/' . $paket->paket_image));

        $paket->daftar_destinasi()->detach();
        $paket->daftar_fasilitas()->detach();
        $paket->detailItinerary()->delete(); // Hapus semua itinerary terkait
        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Data paket berhasil dihapus!');
    }
}
