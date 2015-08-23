<?php
/**
 * Created by PhpStorm.
 * User: icqparty
 * Date: 17.10.14
 * Time: 14:47
 */

namespace Application\View\Helper;


use Zend\View\Helper\AbstractHelper;

class IconSourceCode extends  AbstractHelper {

    public function __invoke($type){
        $type=strtolower($type);

        switch($type){
            case "bitbucket":{
                $result='bitbucket';
                break;
            }
            case "github":{
                $result='github';
                break;
            }
            case "gitlab":{
                $result='gitlab';
                break;
            }
            case "git":{
                break;
            }
            case "link":{
                break;
            }
            case "local":{
                break;
            }
        }
        $result='fa fa-'.$result;
        return $result;
    }
} 