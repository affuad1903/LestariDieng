<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Destination;

class PageController extends Controller
{
    public function homeIndex(){
        $destination = Destination::where('is_main_page', true)->get();
        $pakets = Paket::where('is_main_page', true)->get();

        return view('page.home', [
            'pakets' => $pakets,          // ini variabel yg betul
            'destinations' => $destination,
        ]);

    }
    public function destinasiIndex(){
        $destination = Destination::all();
        return view('page.destinasi.index', compact('destination'));
    }
    public function destinasiShow($id){
        $destination = Destination::with(['destination_section', 'destination_uniq'])->findOrFail($id);
        $destinationAll = Destination::all();
        return view('page.destinasi.show', compact('destination', 'destinationAll'));
    }
    public function paketIndex(){
        $pakets = Paket::all();
        return view('page.paket.index', compact('pakets'));
    }
    public function paketShow($id)
    {
        $paket = Paket::with(['daftar_destinasi', 'daftar_fasilitas', 'detailItinerary'])->findOrFail($id);

        // group by day, lalu sort by time di masing-masing group
        $groupedItinerary = $paket->detailItinerary
            ->sortBy('time')
            ->groupBy('day');

        return view('page.paket.show', [
            'paket' => $paket,
            'groupedItinerary' => $groupedItinerary,
        ]);
        }
    public function galeriIndex(){
        return view('page.galery.index');
    }
    public function galeriShow(){
        return view('page.galery.show');
    }
    public function paketJeepIndex(){
        return view('page.paketJeep.index');
    }
    public function paketJeepShow(){
        return view('page.paketJeep.show');
    }
    public function kontakIndex(){
        return view('page.kontak.index');
    }
}
