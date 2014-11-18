<?php
namespace Reserva\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;

class PabellonTable
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


     public function getPabellon($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idPabellon' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

          public function fetchAllWithAlias()
     {
        $adapter=$this->tableGateway->getAdapter();
        $sql=new Sql($adapter);
        $select=$sql->select();
        $select->from('pabellones');
        $select->columns(array('value'=>'idPabellon','label'=>'nombre'));

         $statement = $sql->prepareStatementForSqlObject($select);
         $result = $statement->execute(); 

         return $result;
     }

     public function savePabellon(Pabellon $pabellon)
    {
        $data = array(            
            'idPabellon'              =>$pabellon->idPabellon,            
            'nombre'                  =>$pabellon->nombre,
        );

        $id = (int) $pabellon->idPabellon;
        if($id == 0)
        {
            $this->tableGateway->insert($data);
        }else
        {
            if ($this->getPabellon($id))
            {
               
                $this->tableGateway->update($data, array('idPabellon' => $id));
            }else 
            {
                throw new \Exception('El Pabellon no existe');
            }
        }
    }

     public function deletePabellon($id)
     {
         $this->tableGateway->delete(array('idPabellon' => (int) $id));
     }


     


     
 }