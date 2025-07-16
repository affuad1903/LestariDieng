<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galery';
    protected $fillable = ['title'];
    public function galery_img() {
        return $this->hasMany(GaleryImg::class,'galery_id');
    }
}
