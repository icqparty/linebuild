<?php
/**
 * Created by PhpStorm.
 * User: icqparty
 * Date: 17.10.14
 * Time: 14:47
 */

namespace Application\View\Helper;


use Zend\View\Helper\AbstractHelper;

class TimeAgo extends  AbstractHelper {
    public function __invoke(){
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return '0 seconds';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60  =>  'month',
            24 * 60 * 60  =>  'day',
            60 * 60  =>  'hour',
            60  =>  'minute',
            1  =>  'second'
        );
        $plural=$this->getView()->plugin('plural');



    }
} 