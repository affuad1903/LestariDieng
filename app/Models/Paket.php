<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';
    protected $fillable =['home_id','is_main_page','paket_title','paket_sub_title_date','paket_price','paket_detail','paket_image'];
    public function daftar_destinasi()
    {
        return $this->belongsToMany(DaftarDestinasi::class, 'daftar_destinasi_paket')->withTimestamps();;
    }
    public function daftar_fasilitas()
    {
        return $this->belongsToMany(DaftarFasilitas::class, 'daftar_fasilitas_paket')->withTimestamps();
    }
    public function detailItinerary()
    {
        return $this->hasMany(DetailItinerary::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
