<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\DestinationUniq;
use Illuminate\Support\Facades\File;

class DestinationUniqController extends Controller
{
    public function create(Request $request)
    {
        $destination = Destination::all();
        $selected_id = $request->get('destination_id', old('destination_id'));

        return view('admin.page.destinasi.uniq.create', [
            'destination' => $destination,
            'selected_id' => $selected_id
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required',
            'uniq_title' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                if (str_word_count($value) > 3) {
                    $fail('Judul maksimal 3 kata.');
                }
            }],
            'uniq_sub_title' => ['max:255', function ($attribute, $value, $fail) {
                if (str_word_count($value) > 3) {
                    $fail('Sub Judul maksimal 3 kata.');
                }
            }],
            'uniq_detail' => 'required|string',
            'uniq_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'destination_id.required' => 'Destinasi wajib diisi ya!',
            'uniq_title.required' => 'Judul wajib diisi ya!',
            'uniq_detail.required' => 'Detail wajib diisi ya!',
            'uniq_image.required' => 'Thumbnail wajib diupload!',
            'uniq_image.image' => 'File harus berupa gambar.',
            'uniq_image.mimes' => 'Thumbnail harus berformat JPG, JPEG, atau PNG.',
            'uniq_image.max' => 'Ukuran thumbnail maksimal 2MB.',
        ]);

        // Upload image
        $thumbImageName = time() . '_uniq.' . $request->file('uniq_image')->extension();
        $request->file('uniq_image')->move(public_path('image/destination/uniq'), $thumbImageName);

        // Simpan ke database
        $destination_uniq = new DestinationUniq;
        $destination_uniq->destination_id = $request->destination_id;
        $destination_uniq->uniq_title = $request->uniq_title;
        $destination_uniq->uniq_sub_title = $request->uniq_sub_title;
        $destination_uniq->uniq_detail = $request->uniq_detail;
        $destination_uniq->uniq_image = $thumbImageName;
        $destination_uniq->save();

        return redirect()->route('destinasi.show', $destination_uniq->destination_id)
                         ->with('success', 'Data berhasil ditambahkan!');
    }

    public function destroy(string $id)
    {
        $destination_uniq = DestinationUniq::findOrFail($id);
        File::delete('image/destination/uniq/' . $destination_uniq->uniq_image);
        $destinationId = $destination_uniq->destination_id;
        $destination_uniq->delete();

        return redirect()->route('destinasi.show', $destinationId)->with('success', 'Data berhasil dihapus!');
    }
}
