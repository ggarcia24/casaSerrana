<?php
namespace Reserva\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;

class TarifaTable
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


     public function getTarifa($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idTarifa' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }


     public function saveTarifa(Tarifa $tarifa)
    {
        $data = array(            
            'idTarifa'              =>$tarifa->idTarifa,            
            'monto'                 =>$tarifa->monto,
            'vigencia'              =>$tarifa->vigencia,
            'idCategoria'           =>$tarifa->idCategoria,
            'idTipoHuesped'         =>$tarifa->idTipoHuesped,
        );

        $id = (int) $tarifa->idTarifa;

        if($id == 0)
        {
            $this->tableGateway->insert($data);
        }else
        {
            if ($this->getTarifa($id))
            {
               
                $this->tableGateway->update($data, array('idTarifa' => $id));
            }else 
            {
                throw new \Exception('La tarifa no existe');
            }
        }
    }

     public function deleteTarifa($id)
     {
         $this->tableGateway->delete(array('idTarifa' => (int) $id));
     }


     


     
 }