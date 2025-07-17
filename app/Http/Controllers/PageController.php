<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Paket;
use App\Models\Galery;
use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function homeIndex(){
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $destination = Destination::where('is_main_page', true)->get();
        $pakets = Paket::where('is_main_page', true)->get();
        $reviews = Review::latest()->take(6)->get(); 

        return view('page.home', [
            'home' => $home,
            'pakets' => $pakets,
            'destinations' => $destination,
            'reviews' => $reviews,
        ]);
    }
    public function destinasiIndex(){
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $destination = Destination::all();
        return view('page.destinasi.index', compact('destination', 'home'));
    }
    public function destinasiShow($id)
    {
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $destination = Destination::with(['destination_section', 'destination_uniq'])->findOrFail($id);
        $destinationAll = Destination::where('id', '!=', $id)->get();
        if ($destinationAll->count() < 4) {
            $randomDestination = Destination::all()->shuffle()->take(4);
        } else {
            $randomDestination = $destinationAll->shuffle()->take(4);
        }

        return view('page.destinasi.show', [

            'destination' => $destination,
            'home' => $home,
            'destinationAll' => $destinationAll,
            'randomDestination' => $randomDestination,
        ]);
    }
    public function paketIndex(){
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $pakets = Paket::all();
        return view('page.paket.index', compact('pakets','home'));
    }
    public function paketShow($id)
    {
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $paket = Paket::with(['daftar_destinasi', 'daftar_fasilitas', 'detailItinerary'])->findOrFail($id);

        // group by day, lalu sort by time di masing-masing group
        $groupedItinerary = $paket->detailItinerary
            ->sortBy('time')
            ->groupBy('day');

        return view('page.paket.show', [
            'paket' => $paket,
            'home' => $home,
            'groupedItinerary' => $groupedItinerary,
        ]);
    }
    public function galeriIndex(){
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $galeries = Galery::with('galery_img')->get();
        return view('page.galery.index', compact('home', 'galeries'));
    }
    public function galeriShow($id)
    {
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        $galery = Galery::with('galery_img')->findOrFail($id);
        return view('page.galery.show', compact('galery','home'));
    }
    public function kontakIndex(){
        $home = Home::with(['socialMedias', 'legalities', 'contacts'])->first();
        return view('page.kontak.index',compact('home'));
    }
}
