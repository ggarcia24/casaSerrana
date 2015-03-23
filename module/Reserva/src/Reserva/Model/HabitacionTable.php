<?php
namespace Reserva\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
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
        $resultSet = $this->tableGateway->select(function(Select $select) {
            $select->order(array(
               'idPabellon DESC',
               'numero ASDC',
               'idCategoria DESC'
            ));
        });

        return $resultSet;
    }

    public function findByPabellon($idPabellon = 0) {
        $resultSet = $this->tableGateway->select(array('idPabellon' => $idPabellon));
        return $resultSet;
    }

    public function findByAmount($minGuestPorHab = null, $arrival = null, $departure = null, $categroia = null) {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);

        //Select all the habitaciones that have a reserva
        $select2 = $sql->select('habitacionporreserva');
        $select2->columns(array(
            'idHabitacion'
        ));
        $select2->join('reservas', 'reservas.idReserva = habitacionporreserva.idReserva', array(), Select::JOIN_LEFT);
        $where2 = $select2->where;

        $where2->greaterThanOrEqualTo('arrival_date', $arrival)->OR
               ->lessThanOrEqualTo('departure_date', $departure);

        //Now select all habitaciones available that do not have a reservation for those dates
        //Grouped by maxGuest available for that room
        $select = $sql->select('habitaciones');
        $select->columns(array(
            'cantidadHabitaciones' => new Expression('COUNT(idHabitacion)'),
            'plazaMaxima',
            'idCategoria',
            'idsHabitacion' => new Expression('GROUP_CONCAT(idHabitacion)'),
        ));
        $where = $select->where;
        $where->notIn('idHabitacion', $select2);
        if(is_int($minGuestPorHab) || $minGuestPorHab > 0) {
            $where->AND->greaterThanOrEqualTo('plazaMaxima', $minGuestPorHab);
        }

        if(is_int($categroia) && $categroia != 0) {
            $where->AND->greaterThanOrEqualTo('idCategoria', $categroia);
        }
        //Agreupar por cantidad de huespedes, pabellon y categoría,
        //esto permite que las habitaciones no se mezclen entre categoría
        $select->group(array('plazaMaxima','idPabellon','idCategoria'));
        $select->order('plazaMaxima DESC');

        $query = $select->getSqlString($adapter->platform);
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $resultSet = new ResultSet();
        return $resultSet->initialize($results)->toArray();
    }

    public function getHabitacion($id) {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('idHabitacion' => $id));
        /* @var Habitacion $row */
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        $row->setPabellon($this->pabellonTable->get($row->getIdPabellon()));
        $row->setCategoria($this->categoriaTable->get($row->getIdCategoria()));
        return $row;
    }


    public function saveHabitacion(Habitacion $habitacion) {
        $data = array(
            'idHabitacion' => $habitacion->getId(),
            'numero' => $habitacion->getNumero(),
            'idPabellon' => $habitacion->getIdPabellon(),
            'plazaMaxima' => $habitacion->getPlazaMaxima(),
            'idCategoria'  => $habitacion->getIdCategoria(),
        );

        $id = (int)$habitacion->getId();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getHabitacion($id)) {
                $this->tableGateway->update($data, array('idHabitacion' => $id));
            } else {
                throw new \Exception('Habitacion id does not exist');
            }
        }
    }

    public function deleteHabitacion($id) {
        $this->tableGateway->delete(array('idHabitacion' => (int)$id));
    }

}