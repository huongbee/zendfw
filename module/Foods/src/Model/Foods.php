<?php
namespace Foods\Model;
use DomainException;
class Foods{
    //`id`, `id_type`, `name`, `summary`, 
    //`detail`, `price`, `promotion`, `image`, `update_at`, `unit`, `today`
    public $id;
    public $id_type;
    public $name;
    public $summary;
    public $detail;
    public $price;
    public $promotion;
    public $image;
    public $update_at;
    public $unit;
    public $today;

    public function exchangeArray(array $data){
        $this->id           = !empty($data['id']) ? $data['id'] : null;
        $this->id_type      = !empty($data['id_type']) ? $data['id_type'] : null;
        $this->name         = !empty($data['name']) ? $data['name'] : null;
        $this->summary      = !empty($data['summary']) ? $data['summary'] : null;
        $this->detail       = !empty($data['detail']) ? $data['detail'] : null;
        $this->price        = !empty($data['price']) ? $data['price'] : null;
        $this->promotion    = !empty($data['promotion']) ? $data['promotion'] : null;
        $this->image        = !empty($data['image']) ? $data['image'] : null;
        $this->update_at    = !empty($data['update_at']) ? $data['update_at'] : null;
        $this->unit         = !empty($data['unit']) ? $data['unit'] : null;
        $this->today        = !empty($data['today']) ? 1 : 0;
    } 

    public function getArrayCopy(){
        return get_object_vars($this);
    }
}