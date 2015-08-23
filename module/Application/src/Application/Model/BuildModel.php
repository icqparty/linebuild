<?php
namespace Application\Model;


use Application\Model\Base\AbstractModel;


class BuildModel extends AbstractModel{

    public function findByProjectId($project_id){

        $select=$this->getSql()->select();
        $select->where(array('project_id'=>$project_id));
        $row=$this->selectWith($select);

        if($row->count()==0){
            return false;
        }
        return $row;
    }

} 