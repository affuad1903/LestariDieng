<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Home;
use App\Models\Socmed;
use App\Models\Contact;
use App\Models\Legality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $home = Home::all();
        $legality = Legality::all();
        $socmed = Socmed::all();
        $contact = Contact::all();
        return view('admin.page.home.index',['home'=>$home,'legality'=>$legality,'socmed'=>$socmed,'contact'=>$contact]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.home.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag_line' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'hero_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'title.required' => 'Judul wajib diisi ya!',
            'tag_line.required' => 'Tagline wajib diisi!',
            'logo.required' => 'Logo wajib diupload!',
            'hero_image.required' => 'Hero image wajib diupload!',
        ]);
        // Upload image
        $newLogoImageName = time().'_logo.'.$request->logo->extension();
        $newHeroImageName = time().'_hero.'.$request->hero_image->extension();
        $request->logo->move(public_path('image/home'), $newLogoImageName);
        $request->hero_image->move(public_path('image/home'), $newHeroImageName);

        $home = new Home;
        $home->title = $request->input('title');
        $home->tag_line = $request->input('tag_line');
        $home->logo = $newLogoImageName;
        $home->hero_image = $newHeroImageName;
        
        $home->save();

        return redirect()->route('home.index')->with('success', 'Konten beranda baru berhasil ditambahkan! Judul: ' . $request->input('title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $home = Home::find($id);
        return view('admin.page.home.edit',['home'=>$home]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag_line' => 'required|string|max:255',
            'logo' => 'image|mimes:jpg,jpeg,png|max:2048',
            'hero_image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'title.required' => 'Judul wajib diisi ya!',
            'tag_line.required' => 'Tagline wajib diisi!',
        ]);
        $home = Home::find($id);
        if($request->has('logo')){
            //hapus data lama
            File::delete('image/home/'.$home->logo);
            $newLogoImageName = time().'_logo.'.$request->logo->extension();
            $request->logo->move(public_path('image/home'), $newLogoImageName);
            $home->logo=$newLogoImageName;
        };
        if($request->has('hero_image')){
            //hapus data lama
            File::delete('image/home/'.$home->hero_image);
            $newHeroImageName = time().'_hero.'.$request->hero_image->extension();
            $request->hero_image->move(public_path('image/home'), $newHeroImageName);
            $home->hero_image=$newHeroImageName;
        };
        $home->title = $request->input('title');
        $home->tag_line = $request->input('tag_line');
        $home->updated_at = Carbon::now();
        $home->save();
        return redirect()->route('home.index')->with('success', 'Konten beranda berhasil diperbarui! Judul: ' . $request->input('title'));
    }
}
