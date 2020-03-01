<?php
namespace App\ServicesAndHelpers;

class HousesFilters{
    protected $builder;
    protected $request;

    public function __construct($builder, $request)
    {
        $this->builder = $builder;
        $this->request = $request;
    }

    public function apply(){
        foreach ($this->filter() as $filter => $value){
            if(method_exists($this, $filter)){
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    protected function city($value){
        $this->builder->whereHas('address', function ($query) use ($value){
            $query->whereHas('city', function ($query) use ($value){
                $query->where('name', 'like', "%$value%");
            });
        });
    }
    protected function filter(){
        return $this->request->all();
    }
}
?>
