<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legality extends Model
{
    protected $table = 'legality';
    protected $fillable = ['home_id','type','number'];
    public function home() {
        return $this->belongsTo(Home::class,'home_id');
    }
}
