<?php
namespace Reserva\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;


class HabitacionTable {
    protected $tableGateway;
    protected $pabellonTable;
    protected $categoriaTable;
    protected $estadoTable;

    public function __construct(TableGateway $tableGateway,
                                PabellonTable $pabellonTable,
                                CategoriaTable $categoriaTable,
                                EstadoTable $estadoTable) {
        $this->tableGateway = $tableGateway;
        $this->pabellonTable = $pabellonTable;
        $this->categoriaTable = $categoriaTable;
        $this->estadoTable = $estadoTable;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        $resultSet->buffer();
        $resultSet->next();
        return $resultSet;
    }

    public function findByPabellon($idPabellon = 0) {
        $resultSet = $this->tableGateway->select(array('idPabellon' => $idPabellon));
        return $resultSet;
    }

    public function getHabitacion($id) {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('idHabitacion' => $id));
        /* @var Habitacion $row */
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        $row->setPabellon($this->pabellonTable->getPabellon($row->getIdPabellon()));
        $row->setCategoria($this->categoriaTable->getCategoria($row->getIdCategoria()));
        $row->setEstado($this->estadoTable->getEstado($row->getIdEstado()));
        return $row;
    }


    public function saveHabitacion(Habitacion $habitacion) {
        $data = array(
            'idHabitacion' => $habitacion->getId(),
            'numero' => $habitacion->getNumero(),
            'idPabellon' => $habitacion->getPabellon()->getId(),
            'plazaMaxima' => $habitacion->getPlazaMaxima(),
            'idCategoria'  => $habitacion->getCategoria()->getId(),
            'idEstado' => $habitacion->getEstado()->getId(),
        );

        $id = (int)$habitacion->idHabitacion;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getHabitacion($id)) {
                $this->tableGateway->update($data, array('idHabitacion' => $id));
            } else {
                throw new \Exception('Reserva id does not exist');
            }
        }
    }

    public function deleteHabitacion($id) {
        $this->tableGateway->delete(array('idHabitacion' => (int)$id));
    }
}