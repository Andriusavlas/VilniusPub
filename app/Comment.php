<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function pubs(){
        return $this->belongsTo('App\Pub','pub_id');
    }
}
