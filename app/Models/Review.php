<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'paket_id',
        'nama',
        'isi_review',
        'bintang',
        'no_hp',
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
