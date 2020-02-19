<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    public function house(){
        return $this->belongsTo(House::class );
    }
}
