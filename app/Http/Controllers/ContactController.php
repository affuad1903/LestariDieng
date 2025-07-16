<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.home.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'detail' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ], [
            'platform.required' => 'Platform kontak wajib diisi!',
            'url.required' => 'URL kontak wajib diisi!',
            'url.url' => 'URL kontak harus valid!',
            'detail.required' => 'Detail kontak wajib diisi!',
            'icon.required' => "Icon wajib dipilih!",
        ]);
        $home = Home::first();
        $contact = new Contact;
        $contact->home_id = $home->id;
        $contact->platform = $request->input('platform');
        $contact->url = $request->input('url');
        $contact->detail = $request->input('detail');
        $contact->icon = $request->input('icon');
        
        $contact->save();

        return redirect()->route('home.index')->with('success', 'Kontak baru berhasil ditambahkan! Platform: ' . $request->input('platform'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::find($id);
        return view('admin.page.home.contact.edit',['contact'=>$contact]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'detail' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ], [
            'platform.required' => 'Platform kontak wajib diisi!',
            'url.required' => 'URL kontak wajib diisi!',
            'url.url' => 'URL kontak harus valid!',
            'detail.required' => 'Detail kontak wajib diisi!',
            'icon.required' => "Icon wajib dipilih!",
        ]);
        $contact = Contact::find($id);
        $contact->platform = $request->input('platform');
        $contact->url = $request->input('url');
        $contact->detail = $request->input('detail');
        $contact->icon = $request->input('icon');
        
        $contact->save();

        return redirect()->route('home.index')->with('success', 'Kontak berhasil diperbarui! Platform: ' . $request->input('platform'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        $platform = $contact->platform; // Store platform name before deletion
        $contact->delete();
        return redirect()->route('home.index')->with('success', 'Kontak "' . $platform . '" berhasil dihapus!');
    }
}
