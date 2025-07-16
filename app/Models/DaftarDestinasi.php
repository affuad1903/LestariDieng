<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarDestinasi extends Model
{
    protected $table = 'daftar_destinasi';
    protected $fillable =['nama_destinasi'];
    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'daftar_destinasi_paket')->withTimestamps();
    }
}
