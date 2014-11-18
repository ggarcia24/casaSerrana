<?php
namespace Reserva\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;


class HabitacionTable
{
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         $resultSet->buffer();
         $resultSet->next();
         return $resultSet;
     }

     public function getHabitacion($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idHabitacion' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }


    public function saveHabitacion(Habitacion $habitacion)
    {
        $data = array
        (    
            'idHabitacion'          =>$habitacion->idHabitacion,         
            'numero'                =>$habitacion->numero,
            'idPabellon'            =>$habitacion->idPabellon,
            'plazaMaxima'           =>$habitacion->plazaMaxima,
            'idCategoria'           =>$habitacion->idCategoria,
            'idEstado'              =>$habitacion->idEstado,
        );

        $id = (int) $habitacion->idHabitacion;
        if($id == 0)
        {
            
            $this->tableGateway->insert($data);
        }else
        {
            if ($this->getHabitacion($id)) 
            {
                $this->tableGateway->update($data, array('idHabitacion' => $id));
            }else 
            {
                throw new \Exception('Reserva id does not exist');
            }
        }
    }

    public function deleteHabitacion($id)
     {


         $this->tableGateway->delete(array('idHabitacion' => (int) $id));

     }



     
 }