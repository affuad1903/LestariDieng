<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleryImg extends Model
{
    protected $table = 'galery_img';
    protected $fillable = ['galery_id','image'];
    public function galery(){
        return $this->belongsTo(Galery::class,'galery_id');
    }
}
