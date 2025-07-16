<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeItinerary extends Model
{
    use HasFactory;

    protected $table = 'time_itinerary';

    protected $fillable = ['waktu'];

    public function detailItineraries()
    {
        return $this->hasMany(DetailItinerary::class);
    }
}
