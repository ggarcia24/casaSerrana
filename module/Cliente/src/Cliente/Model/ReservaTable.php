<?php
namespace Cliente\Model;
use Zend\Db\TableGateway\TableGateway;
class ReservaTable
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

     public function getReserva($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idReserva' => $idReserva));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveAlbum(Reserva $reserva)
     {
         $data = array(
             'idCLiente' => $reserva->idCliente,
             'idHabitacion'  => $reserva->idHabitacion,
         );

         $id = (int) $reserva->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getReserva($id)) {
                 $this->tableGateway->update($data, array('idReserva' => $idReserva));
             } else {
                 throw new \Exception('Cliente id does not exist');
             }
         }
     }

     public function deleteReserva($id)
     {
         $this->tableGateway->delete(array('idReserva' => (int) $idReserva));
     }
 }