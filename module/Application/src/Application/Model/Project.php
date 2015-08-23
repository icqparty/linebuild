<?php
namespace Application\Model;

use Application\Model\Base\AbstractEntity;

class Project extends AbstractEntity
{
    public $id;
    public $header;
    public $repository;
    public $type;
    public $update_date;
    public $create_date;
    public $branch;
    public $open;
    public $status;
    public $owner;

}