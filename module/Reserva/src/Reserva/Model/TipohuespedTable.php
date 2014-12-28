<?php
namespace Reserva\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;

class TipohuespedTable
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


     public function getTipohuesped($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idTipoHuesped' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveTipohuesped(Tipohuesped $tipohuesped)
    {
        $data = array(            
            'idTipoHuesped' =>$tipohuesped->getId(),
            'nombre' =>$tipohuesped->getNombre(),
        );

        $id = (int) $tipohuesped->getId();
        if($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getTipohuesped($id)) {
                $this->tableGateway->update($data, array('idTipoHuesped' => $id));
            } else {
                throw new \Exception('El Tipo de huesped no existe');
            }
        }
    }

     public function deleteTipohuesped($id) {
         $this->tableGateway->delete(array('idTipoHuesped' => (int) $id));
     }

     public function fetchAllWithAlias()
     {
        $adapter=$this->tableGateway->getAdapter();
        $sql=new Sql($adapter);
        $select=$sql->select();
        $select->from('tipoHuespedes');
        $select->columns(array('value'=>'idTipoHuesped','label'=>'nombre'));

         $statement = $sql->prepareStatementForSqlObject($select);
         $result = $statement->execute(); 

         return $result;
     }


     


     
 }