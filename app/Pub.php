<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pub extends Model
{
    public function votes(){
        return $this->hasMany('App\Vote');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function attachment(){
        return $this->hasOne('App\Attachment');
    }
}
