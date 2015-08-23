<?php
namespace Application\Model\Base;


class AbstractEntity
{
    public  function getArrayCopy(){
        return get_object_vars($this);
    }
} 