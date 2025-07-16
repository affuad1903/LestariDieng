<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationUniq extends Model
{
    protected $table = 'destination_uniq';
    protected $fillable = ['destination_id','uniq_title','uniq_sub_title','uniq_image','uniq_detail'];
    public function destination(){
        return $this->belongsTo(Destination::class,'destination_id');
    }
}
