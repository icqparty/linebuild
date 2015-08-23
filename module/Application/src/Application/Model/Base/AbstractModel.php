<?php
namespace Application\Model\Base;


use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Stdlib\Hydrator\ObjectProperty;

class AbstractModel extends AbstractTableGateway
{

    public function __construct(Adapter $adapter,$table,$object)
    {
        $this->adapter = $adapter;
        $this->table=$table;
        $resultSet = new HydratingResultSet();
        $resultSet->setObjectPrototype($object);
        $resultSet->setHydrator(new ObjectProperty());
        $this->resultSetPrototype=$resultSet;

        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function get($id)
    {
        $id  = (int) $id;

        $rowset = $this->select(array(
            'id' => $id,
        ));

        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find row $id");
        }

        return $row;
    }

    public function save($object)
    {
        $id = (int) $object->id;

        if ($id == 0) {
            $this->insert($object->getArrayCopy());
        } elseif ($this->get($id)) {
            $this->update(
                $object->getArrayCopy(),array('id' => $id)
            );

        } else {
            throw new \Exception('Form id does not exist');
        }
        return $this->getLastInsertValue();
    }

    public function delete($ids)
    {

        parent::delete(array(
            'id' => $ids,
        ));
    }
} 