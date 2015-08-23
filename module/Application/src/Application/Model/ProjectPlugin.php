<?php
namespace Application\Model;

use Application\Model\Base\AbstractEntity;

class ProjectPlugin extends AbstractEntity
{
    public $id;
    public $project_id;
    public $plugin_id;
}