<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //
    public function houses(){
        return $this->belongsToMany(House::class);
    }
}
