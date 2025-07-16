<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Home;
use App\Models\Destination;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destination = Destination::all();
        return view('admin.page.destinasi.index',['destination'=>$destination]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.destinasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'is_main_page' => 'required|boolean',
            'content_title' => 'required|string|max:255',
            'content_summary' => 'required|string',
            'content_location_title' => 'required|string',
            'content_location_detail' => 'required|string',
            'thumbnail_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'is_main_page.required' => 'Status halaman utama harus dipilih.',
            'is_main_page.boolean' => 'Status halaman utama harus berupa nilai benar atau salah (true/false).',
            'content_title.required' => 'Judul konten wajib diisi.',
            'content_title.max' => 'Judul konten maksimal 255 karakter.',
            'content_summary.required' => 'Ringkasan konten wajib diisi.',
            'content_location_title.required' => 'Judul untuk lokasi wajib diisi.',
            'content_location_detail.required' => 'Detail lokasi wajib diisi.',
            'thumbnail_image.required' => 'Thumbnail wajib diupload!',
            'thumbnail_image.image' => 'File harus berupa gambar.',
            'thumbnail_image.mimes' => 'Thumbnail harus berformat JPG, JPEG, atau PNG.',
            'thumbnail_image.max' => 'Ukuran thumbnail maksimal 2MB.',
        ]);
    
        // Upload image
        $thumbImageName = time().'_thumb.'.$request->file('thumbnail_image')->extension();
        $request->file('thumbnail_image')->move(public_path('image/destination'), $thumbImageName);
    
        $home = Home::first();
        // Simpan data
        $destination = new Destination;
        $destination->home_id = $home->id;
        $destination->is_main_page = $request->input('is_main_page');
        $destination->content_title = $request->input('content_title');
        $destination->content_summary = $request->input('content_summary');
        $destination->content_location_title = $request->input('content_location_title');
        $destination->content_location_detail = $request->input('content_location_detail');
        $destination->thumbnail_image = $thumbImageName;
    
        $destination->save();
    
        return redirect()->route('destinasi.index')->with('success', 'Data destination berhasil ditambahkan!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $destination = Destination::with(['destination_section', 'destination_uniq'])->findOrFail($id);
        return view('admin.page.destinasi.show',['destination'=>$destination]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $destination = Destination::findOrFail($id);
        return view('admin.page.destinasi.edit',['destination'=>$destination]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'is_main_page' => 'required|boolean',
            'content_title' => 'required|string|max:255',
            'content_summary' => 'required|string',
            'content_location_title' => 'required|string',
            'content_location_detail' => 'required|string',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'is_main_page.required' => 'Status halaman utama harus dipilih.',
            'is_main_page.boolean' => 'Status halaman utama harus berupa nilai benar atau salah (true/false).',
            'content_title.required' => 'Judul konten wajib diisi.',
            'content_title.max' => 'Judul konten maksimal 255 karakter.',
            'content_summary.required' => 'Ringkasan konten wajib diisi.',
            'content_location_title.required' => 'Judul untuk lokasi wajib diisi.',
            'content_location_detail.required' => 'Detail lokasi wajib diisi.',
            'thumbnail_image.image' => 'File harus berupa gambar.',
            'thumbnail_image.mimes' => 'Thumbnail harus berformat JPG, JPEG, atau PNG.',
            'thumbnail_image.max' => 'Ukuran thumbnail maksimal 2MB.',
        ]);
    
        $destination = Destination::findOrFail($id);
    
        // Proses upload thumbnail jika ada
        if ($request->hasFile('thumbnail_image')) {
            File::delete(public_path('image/destination/'.$destination->thumbnail_image)); // Hapus file lama
            $newImageName = time().'_thumb.'.$request->thumbnail_image->extension();
            $request->thumbnail_image->move(public_path('image/destination'), $newImageName);
            $destination->thumbnail_image = $newImageName; // Simpan nama baru
        }
    
        // Update data lainnya
        $destination->is_main_page = $request->input('is_main_page');
        $destination->content_title = $request->input('content_title');
        $destination->content_summary = $request->input('content_summary');
        $destination->content_location_title = $request->input('content_location_title');
        $destination->content_location_detail = $request->input('content_location_detail');
        $destination->updated_at = Carbon::now();
        $destination->save();
    
        return redirect()->route('destinasi.show', $destination->id)->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destination = Destination::with(['destination_section', 'destination_uniq'])->findOrFail($id);
        
        //hapus foto lama
        File::delete('image/destination/'.$destination->thumbnail_image);
        foreach ($destination->destination_uniq as $uniq) {
            File::delete('image/destination/uniq/'.$uniq->uniq_image);
        }
        
        foreach ($destination->destination_uniq as $uniq) {
            $uniq->delete();
        }
        foreach ($destination->destination_section as $section) {
            $section->delete();
        }
        $destination->delete();
        return redirect()->route('destinasi.index')->with('success', 'Destinasi berhasil dihapus!');
    }
}
