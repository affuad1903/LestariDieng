<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationContentSection extends Model
{
    protected $table ='destination_content_section';
    protected $fillable = ['destination_id','subtitle','detail','order'];

    public function destination(){
        return $this->belongsTo(Destination::class,'destination_id');
    }
}
