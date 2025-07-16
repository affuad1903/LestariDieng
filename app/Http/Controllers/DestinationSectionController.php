<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DestinationContentSection;
use App\Models\Destination;
class DestinationSectionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destination = Destination::all();
        return view('admin.page.destinasi.section.create',['destination'=>$destination]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required',
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
        ], [
            'destination_id.required' => 'wajib diisi ya!',
            'title.required' => 'Judul Konten Tambahan wajib diisi ya!',
            'detail.required' => 'Detail wajib diisi ya!',
        ]);

        $destination_section = new DestinationContentSection;
        $destination_section->destination_id =  $request->input('destination_id');
        $destination_section->title = $request->input('title');
        $destination_section->detail = $request->input('detail');
        
        $latestOrder = DestinationContentSection::max('order') ?? 0;
        $newOrder = $latestOrder + 1;
        $destination_section->order = $newOrder;
        $destination_section->save();
        $destinationId = $destination_section->destination_id;
        return redirect()->route('destinasi.show', $destinationId)->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destination_section = DestinationContentSection::find($id);
        $destination_section->delete();
        $destinationId = $destination_section->destination_id;
        return redirect()->route('destinasi.show', $destinationId)->with('success', 'Data berhasil dihapus!');
    }
}
