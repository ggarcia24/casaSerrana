<?php
namespace Cliente\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Predicate;

class BancoTable
{
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();         
         return $resultSet;
     }
     
    public function fetchAllWithAlias()
    {
        $adapter=$this->tableGateway->getAdapter();
        $sql=new Sql($adapter);
        $select=$sql->select();
        $select->from('bancos');
        $select->columns(array('value'=>'idBanco','label'=>'nombre'));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        return $result;
    } 
     
     public function getBanco($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idBanco' => $id));
         $row = $rowset->current();         
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }



    public function saveBanco(Banco $banco)
    {
        $data = array(            
            'idBanco'               =>$banco->idBanco,
            'nombre'                =>$banco->nombre,
        );

        $id = (int) $banco->idBanco;
        if($id == 0)
        {
            $this->tableGateway->insert($data);
        }else
        {
            if ($this->getBanco($id))
            {
               
                $this->tableGateway->update($data, array('idBanco' => $id));
            }else 
            {
                throw new \Exception('Banco id does not exist');
            }
        }
    }

     public function deleteBanco($id)
     {
         $this->tableGateway->delete(array('idBanco' => (int) $id));
     }
 }