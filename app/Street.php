<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function addresses(){
        return $this->hasMany(Address::class);
    }
}
