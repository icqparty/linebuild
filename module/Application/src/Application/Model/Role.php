<?php
namespace Application\Model;

use Application\Model\Base\AbstractEntity;

class Role extends AbstractEntity
{
    public $id;
    public $header;
    public $name;
    public $parent_id;
    public $locked;
}