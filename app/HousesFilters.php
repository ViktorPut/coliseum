<?php
namespace  App;

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

    protected function filter(){
        return $this->request->all();
    }
}
?>
