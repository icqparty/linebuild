<?php
namespace Application\Model;

use Application\Model\Base\AbstractEntity;

class Build extends AbstractEntity
{
    public $id;
    public $project_id;
    public $commit_id;
    public $branch;
    public $create_date;
    public $update_date;
    public $log;
    public $extra;
    public $status;
    public $finish_date;
    public $author;
    public $message;
    public $duration;
}