<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarFasilitas extends Model
{
    protected $table = 'daftar_fasilitas';
    protected $fillable =['nama_fasilitas'];
    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'daftar_fasilitas_paket')->withTimestamps();
    }
}
