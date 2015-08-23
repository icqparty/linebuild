<?php
namespace Application\Model;

use Application\Model\Base\AbstractEntity;

class Setting extends AbstractEntity
{
    public $id;
    public $name;
    public $value;
}