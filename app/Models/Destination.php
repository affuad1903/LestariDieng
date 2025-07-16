<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table ='destination';
    protected $fillable = ['home_id','is_main_page','content_title','content_summary','content_location_title','content_location_detail','thumbnail_image'];
    public function home() {
        return $this->belongsTo(Home::class,'home_id');
    }
    public function destination_section() {
        return $this->hasMany(DestinationContentSection::class,'destination_id');
    }
    public function destination_uniq() {
        return $this->hasMany(DestinationUniq::class,'destination_id');
    }
}
