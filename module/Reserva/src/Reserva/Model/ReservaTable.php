<?php
namespace Reserva\Model;

use Cliente\Model\ClienteTable;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ObjectProperty;

class ReservaTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway,
                                ClienteTable $clienteTable,
                                HabitacionTable $habitacionTable,
                                TarifaTable $tarifaTable,
                                EstadoTable $estadoTable,
                                TipohuespedTable $tipoHuespedTable) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function findByPabellonYFecha($idPabellon, $fecha) {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('reservas');
        $select->join('habitaciones', 'habitaciones.idHabitacion = reservas.idHabitacion');
        $where = $select->where;
        $where->equalTo('idPabellon', $idPabellon);
        $where->lessThanOrEqualTo('fechaIn', $fecha);
        $where->greaterThanOrEqualTo('fechaOut', $fecha);

        print($select->getSqlString($adapter->platform));
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        return $resultSet;
    }

    public function findByHabitacionYFecha($idHabitacion, $fecha) {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('reservas');
        $where = $select->where;
        $where->equalTo('idHabitacion', $idHabitacion)->AND->NEST
              ->lessThanOrEqualTo('fechaIn', $fecha)->AND
              ->lessThanOrEqualTo('fechaOut', $fecha);

        //print($select->getSqlString($adapter->platform) . '<br>');
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $cant = count($results);
        $ret = null;
        if($cant > 1) {
            throw new \Exception('Error! Multiples reservas para una misma fecha y una misma habitacion');
        } elseif($cant == 1) {
            $entityPrototype = new Reserva();
            $hydrator = new ObjectProperty();
            $resultset = new HydratingResultSet($hydrator, $entityPrototype);
            $resultset->initialize($results);
            $ret = $resultset->current();
        }
        return $ret;
    }

    public function getReserva($id) {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('idReserva' => $idReserva));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getReservaPorFechas($fechaDesde, $fechaHasta) {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('reservas');
        $select->where('fechaIn >=' . "'" . $fechaDesde . "'" OR 'fechaOut <=' . "'" . $fechaHasta . "'");
        //$select->where('fechaOut <='."'". $fechaHasta ."'");
        //$select->where('idReserva='."'". "1" ."'");

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        return $result;
    }

    public function getReservaPorFecha($fecha) {
        //$fecha=str_replace("-", "", $fecha);
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('reservas');
        $select->where('fechaIn <=' . "'" . $fecha . "'");
        $select->where('fechaOut >=' . "'" . $fecha . "'");
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        return $result;
    }

    public function saveReserva(Reserva $reserva) {
        $data = array(
            'idHabitacion' => $reserva->getId(),
            'idCliente' => $reserva->getCliente()->getId(),
            'idTarifa' => $reserva->getTarifa()->getId(),
            'idEstado' => $reserva->getEstado()->getId(),
            'idTipoHuesped' => $reserva->getTipoHuesped()->getId(),
            'fechaIn' => $reserva->getFechaIn(),
            'fechaOut' => $reserva->getFechaOut(),
            'cantidadAdultos' => $reserva->getCantidadAdultos(),
            'cantidadMenores' => $reserva->getCantidadMenores(),
            //'idPago'                =>$reserva->idPago,
            'comentario' => $reserva->getComentario(),
        );
        $id = (int)$reserva->getId();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getReserva($id)) {
                $this->tableGateway->update($data, array('idReserva' => $idReserva));
            } else {
                throw new \Exception('Reserva id does not exist');
            }
        }
    }

    public function deleteReserva($id) {
        $this->tableGateway->delete(array('idReserva' => (int)$id));
    }

}
