<?php
namespace App;

use Illuminate\Http\Request;

class HouseService{
        protected $model;
        protected $request;

        public function __construct($model, Request $request)
        {
            $this->model = $model;
            $this->request = $request;
        }

        public function createAddress(){
            $address = new Address([
                'number'        => $this->request->number ?: '*',
                'city_id'       => $this->createCity(),
                'district_id'   => $this->createDistrict(),
                'street_id'     => $this->createStreet(),
            ]);

            $address->save();
            return $address->id;
        }

        public function createCity(){
            return (City::firstOrCreate([ 'name' => $this->request->city]))->id;
        }

        public function createStreet(){
            $street = new Street([
                'name' => $this->request->street ?: '*'
            ]);
            $street->save();
            return $street->id;
        }

        public function createDistrict(){
            return  (District::firstOrCreate([ 'name' => $this->request->district ]))->id;
        }

        public function createHouse(){
            $house = new House();
            $house->fill([
                'rooms'       => $this->request->rooms ?: '*',
                'floors'      => $this->request->floors ?: '*',
                'cost'        => $this->request->cost,
                'space'       => $this->request->space,
                'description' => $this->request->description ?: '*',
                'category_id' => $this->request->category,
            ]);
            $house->address_id = $this->createAddress();
            $house->save();

//            if(Auth::user()->isAdmin()){
//                $house->users()->attach($this->request->user);
//            }else{
//                $house->users()->attach(Auth::user()->id);
//            }
        }

    }
?>
