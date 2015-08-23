<?php
/**
 * Created by PhpStorm.
 * User: icqparty
 * Date: 17.10.14
 * Time: 14:47
 */

namespace Application\View\Helper;


use Zend\View\Helper\AbstractHelper;

class Status extends  AbstractHelper {

    protected $status=array(
        '0'=>array(
            'title'=>'Pedding',
            'class'=>'label-info'
        ),
        '1'=>array(
            'title'=>'Running',
            'class'=>'label-warning'
        ),
        '2'=>array(
            'title'=>'Failed',
            'class'=>'label-danger'
        ),
        '3'=>array(
            'title'=>'Success',
            'class'=>'label-success'
        ),
        '4'=>array(
            'title'=>'Error',
            'class'=>'label-danger'
        )
    );

    public function __invoke($status){
        if(!isset($this->status[$status])){
            throw new \Exception("Number status build no found");
        }

        $attr='';
        $class="label {$this->status[$status]['class']} ";

        $result="<span class=\"{$class}\" {$attr}>{$this->status[$status]['title']}</span>";
        return $result;
    }
} 