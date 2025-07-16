<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $table ='home';
    protected $fillable = ['title','tag_line','logo','hero_image','updated_at'];
    public function legalities() {
        return $this->hasMany(Legality::class,'home_id');
    }
    
    public function socialMedias() {
        return $this->hasMany(Socmed::class,'home_id');
    }
    
    public function contacts() {
        return $this->hasMany(Contact::class,'home_id');
    }

    public function destinations() {
        return $this->hasMany(Destination::class,'home_id');
    }
}
