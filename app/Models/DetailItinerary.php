<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailItinerary extends Model
{
    use HasFactory;

    protected $table = 'detail_itinerary';

    protected $fillable = [
        'paket_id',
        'day',       
        'time',    
        'detail'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
