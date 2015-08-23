<?php
namespace Application\Model;

use Application\Model\Base\AbstractEntity;

class User extends AbstractEntity
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $create_date;
    public $role_id;
    public $login_date;
    public $status;
    public $update_date;


}