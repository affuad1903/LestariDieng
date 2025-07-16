<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socmed extends Model
{
    protected $table ='socmed';
    protected $fillable = ['home_id','platform','url','icon'];
    public function home() {
        return $this->belongsTo(Home::class,'home_id');
    }
}
