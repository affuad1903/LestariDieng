<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table ='contact';
    protected $fillable = ['home_id','platform','url','detail','icon'];
    public function home() {
        return $this->belongsTo(Home::class,'home_id');
    }
}
