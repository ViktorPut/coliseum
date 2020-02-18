<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = [
        'number'
    ];

    public function street(){
        return $this->belongsTo(Street::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function house(){
        return $this->hasOne(House::class);
    }
}
