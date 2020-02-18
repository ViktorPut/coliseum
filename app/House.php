<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'rooms',
        'floors',
        'space',
        'cost',
        'description',
        'address_id',
        'category_id'
    ];
    //
    public  function address(){
        return $this->hasOne(Address::class);
    }

    public function city(){//??
        return $this->address->city;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }


}
