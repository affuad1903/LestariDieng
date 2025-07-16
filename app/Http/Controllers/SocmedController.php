<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Socmed;
use Illuminate\Http\Request;

class SocmedController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.home.socmed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:255',
        ], [
            'platform.required' => 'Platform sosial media wajib diisi!',
            'url.required' => 'URL sosial media wajib diisi!',
            'url.url' => 'URL sosial media harus valid!',
            'icon.required' => "Icon wajib dipilih!",
        ]);
        $home = Home::first();
        $socmed = new Socmed;
        $socmed->home_id = $home->id;
        $socmed->platform = $request->input('platform');
        $socmed->url = $request->input('url');
        $socmed->icon = $request->input('icon');
        
        $socmed->save();

        return redirect()->route('home.index')->with('success', 'Media sosial baru berhasil ditambahkan! Platform: ' . $request->input('platform'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $socmed = Socmed::find($id);
        return view('admin.page.home.socmed.edit',['socmed'=>$socmed]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:255',
        ], [
            'platform.required' => 'Platform sosial media wajib diisi!',
            'url.required' => 'URL sosial media wajib diisi!',
            'url.url' => 'URL sosial media harus valid!',
            'icon.required' => "Icon wajib dipilih!",
        ]);

        $socmed = Socmed::find($id);
        $socmed->platform = $request->input('platform');
        $socmed->url = $request->input('url');
        $socmed->icon = $request->input('icon');
        
        $socmed->save();
        return redirect()->route('home.index')->with('success', 'Media sosial berhasil diperbarui! Platform: ' . $request->input('platform'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $socmed = Socmed::find($id);
        $platform = $socmed->platform; // Store platform name before deletion
        $socmed->delete();
        return redirect()->route('home.index')->with('success', 'Media sosial "' . $platform . '" berhasil dihapus!');
    }
}
