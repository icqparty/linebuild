<?php
/**
 * Created by PhpStorm.
 * User: icqparty
 * Date: 17.10.14
 * Time: 14:47
 */

namespace Application\View\Helper;


use Zend\I18n\Validator\DateTime;
use Zend\View\Helper\AbstractHelper;

class Duraction extends  AbstractHelper {
   private function numberFormat($digit, $width) {
        while(strlen($digit) < $width)
            $digit = '0' . $digit;
        return $digit;
    }
    public function __invoke($second){
        $minute='00';
        if($second<60){
            return $minute.':'.$this->numberFormat($second,2);
        }
       $minute=round($second/60);
       return $this->numberFormat($minute,2).' minutes '.$this->numberFormat($second%60,2)." secounds";
    }
}