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

        }

        public function createCity(){

        }

        public function createStreet(){
            $street = new App\Street([
                'name' => $this->request->street ?: '*'
            ]);
            $street->save();
            return $street->id;
        }

        public function createDistrict(){

        }

        public function createHouse(){

        }

    }
?>
