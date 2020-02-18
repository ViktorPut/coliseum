<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public const APARTMENT = 'APARTMENT'; //Квартира
    public const APARTMENTS = 'APARTMENTS'; //Аппартаменты
    public const DACHA = 'DACHA'; //Дача
    public const HOUSE = 'HOUSE'; //Дом (частный)
    public const COTTAGE = 'COTTAGE'; //Коттедж
    public const PLOT = 'PLOT'; //Участок
    public const GARAGE = 'GARAGE'; // Гараж

    public function houses(){
        return $this->hasMany(House::class);
    }
}
