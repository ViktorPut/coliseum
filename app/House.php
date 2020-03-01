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
        return $this->belongsTo(Address::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function parameters(){
        return $this->belongsToMany(Parameter::class);
    }

    public function labels(){
        return $this->belongsToMany(Label::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
