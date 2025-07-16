<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayItinerary extends Model
{
    use HasFactory;

    protected $table = 'day_itinerary';

    protected $fillable = ['nama_hari'];

    public function detailItineraries()
    {
        return $this->hasMany(DetailItinerary::class);
    }
}
