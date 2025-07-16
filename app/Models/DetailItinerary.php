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
        'day_itinerary_id',
        'time_itinerary_id',
        'detail'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function dayItinerary()
    {
        return $this->belongsTo(DayItinerary::class, 'day_itinerary_id');
    }

    public function timeItinerary()
    {
        return $this->belongsTo(TimeItinerary::class, 'time_itinerary_id');
    }
}
