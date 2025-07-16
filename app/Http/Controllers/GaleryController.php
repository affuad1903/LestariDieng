<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\GaleryImg;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    public function index()
    {
        $galery = Galery::with('galery_img')->get();
        return view('admin.page.galery.index', compact('galery'));
    }

    public function create()
    {
        return view('admin.page.galery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $galery = Galery::create(['title' => $request->title]);

        $folderPath = public_path('image/galery/' . $galery->id);
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($folderPath, $filename);

            GaleryImg::create([
                'galery_id' => $galery->id,
                'image' => $filename,
            ]);
        }

        return redirect()->route('galery.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $galery = Galery::with('galery_img')->findOrFail($id);
        return view('admin.page.galery.show', compact('galery'));
    }

    public function edit(string $id)
    {
        $galery = Galery::with('galery_img')->findOrFail($id);
        return view('admin.page.galery.edit', compact('galery'));
    }

    public function addImages(Request $request, string $id)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $galery = Galery::findOrFail($id);
        $folderPath = public_path('image/galery/' . $galery->id);
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($folderPath, $filename);

            GaleryImg::create([
                'galery_id' => $galery->id,
                'image' => $filename,
            ]);
        }

        return redirect()->back()->with('success', 'Gambar berhasil ditambahkan!');
    }

    public function deleteImage(string $id)
    {
        $image = GaleryImg::findOrFail($id);
        $imagePath = public_path('image/galery/' . $image->galery_id . '/' . $image->image);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $image->delete();
        return redirect()->back()->with('success', 'Gambar berhasil dihapus!');
    }

    public function destroy(string $id)
    {
        $galery = Galery::with('galery_img')->findOrFail($id);

        // Hapus semua gambar di folder
        $folder = public_path('image/galery/' . $galery->id);
        if (file_exists($folder)) {
            foreach ($galery->galery_img as $img) {
                $path = $folder . '/' . $img->image;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            rmdir($folder);
        }

        // Hapus dari database
        $galery->galery_img()->delete();
        $galery->delete();

        return redirect()->route('galery.index')->with('success', 'Galeri berhasil dihapus!');
    }
}
