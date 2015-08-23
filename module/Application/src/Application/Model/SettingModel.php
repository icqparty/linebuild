<?php
namespace Application\Model;


use Application\Model\Base\AbstractModel;

class SettingModel extends AbstractModel{
    public function fetchByName($name){
        $row=$this->select(array(
            'name'=>$name
        ));

        if(!$row){
            throw new \Exception('Not row settings by {}');
        }
        if($this->isJson($row->current()->value)){
            return json_decode($row->current()->value);
        }
        return $row->current()->value;
    }
    function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
} 