<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Legality;
use Illuminate\Http\Request;

class LegalityController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.home.legality.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'number' => 'required|string|max:255',
        ], [
            'type.required' => 'Tipe Legalitas wajib diisi ya!',
            'number.required' => 'Nomor Legalitas wajib diisi ya!',
        ]);

        $home = Home::first();
        $legality = new Legality;
        $legality->home_id = $home->id;
        $legality->type = $request->input('type');
        $legality->number = $request->input('number');
        $legality->save();
        return redirect()->route('home.index')->with('success', 'Legalitas baru berhasil ditambahkan! Tipe: ' . $request->input('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $legality = Legality::find($id);
        return view('admin.page.home.legality.edit',['legality'=>$legality]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'number' => 'required|string|max:255',
        ], [
            'type.required' => 'Tipe Legalitas wajib diisi ya!',
            'number.required' => 'Nomor Legalitas wajib diisi ya!',
        ]);

        $legality = Legality::find($id);

        $legality->type = $request->input('type');
        $legality->number = $request->input('number');
        $legality->save();
        return redirect()->route('home.index')->with('success', 'Legalitas berhasil diperbarui! Tipe: ' . $request->input('type'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $legality = Legality::find($id);
        $type = $legality->type; // Store type name before deletion
        $legality->delete();
        return redirect()->route('home.index')->with('success', 'Legalitas "' . $type . '" berhasil dihapus!');
    }
}
