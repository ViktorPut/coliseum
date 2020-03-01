<?php
namespace App\ServicesAndHelpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HouseService{
        protected $request;

        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        public function createAddress(){
            $address = new \App\Address([
                'number'        => $this->request->number ?: '*',
                'city_id'       => $this->createCity(),
                'district_id'   => $this->createDistrict(),
                'street_id'     => $this->createStreet(),
            ]);

            $address->save();
            return $address->id;
        }

        public function createCity(){
            return (\App\City::firstOrCreate([ 'name' => $this->request->city]))->id;
        }

        public function createStreet(){
            $street = new \App\Street([
                'name' => $this->request->street ?: '*'
            ]);
            $street->save();
            return $street->id;
        }

        public function createDistrict(){
            return  (\App\District::firstOrCreate([ 'name' => $this->request->district ]))->id;
        }

        public function createHouse(){
            $house = new \App\House();
            $this->getHouse($house);

            $this->attachUser($house);

            $params = $this->getParameters();
            if($params != null){
                $house->parameters()->attach($params);
            }
        }

        public function getHouse(\App\House $house){
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

            (new ImageService($this->request))->attach($house);
        }

        public function attachUser(\App\House $house){
            if(Auth::user()->isAdmin()){
                $house->users()->attach($this->request->user);
            }else{
                $house->users()->attach(Auth::user()->id);
            }
        }

        public function getParameters(){
            if(!$this->request->has('parameters')) return null;

            $parameters = array();
            foreach (array_keys($this->request->parameters) as $fieldKey){
                foreach ($this->request->parameters[$fieldKey] as $key => $parameterRequest) {
                    if($parameterRequest == null)
                        continue;
                    $parameters[$key][$fieldKey] = $parameterRequest;
                }
            }
            foreach ($parameters as $parameter){
                $params[] = \App\Parameter::firstOrCreate([ 'name' => $parameter['name'] ?? 'Неизвестный параметр', 'value' => $parameter['value'] ])->id;
            }
            return $params;
        }

        public function updateHouse(\App\House $house){
            $this->getHouse($house);
            if(Auth::user()->isAdmin()) {
                $this->attachUser($house);
            }
            $params = $this->getParameters();
            if($params != null){
                $house->parameters()->sync($params);
            }else{
                $house->parameters()->detach();
            }
        }
    }
?>
