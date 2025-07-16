<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function homeIndex(){
        return view('page.home');
    }
    public function destinasiIndex(){
        return view('page.destinasi.index');
    }
    public function destinasiShow(){
        return view('page.destinasi.show');
    }
    public function paketIndex(){
        return view('page.paket.index');
    }
    public function paketShow(){
        return view('page.paket.show');
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
