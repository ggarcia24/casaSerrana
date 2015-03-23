<?php
namespace Reserva\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;

class TarifaTable {
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select(array('vigencia' => '0000-00-00 00:00:00'));

        return $resultSet;
    }

    public function getTarifa($id) {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('idTarifa' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveTarifa(Tarifa $tarifa) {
        $data = array(
            'monto' => $tarifa->getMonto(),
            'idCategoria' => $tarifa->getIdCategoria(),
            'idTipoHuesped' => $tarifa->getIdTipoHuesped(),
        );

        $id = (int)$tarifa->getId();

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            $tarifaOld = $this->getTarifa($id);
            if ($tarifaOld) {
                $tarifaOld->setVigencia(date('Y-m-d'));
                $oldData = $tarifaOld->toArray();
                unset($oldData['id']);
                $this->tableGateway->update($oldData, array('idTarifa' => $id));
                $this->tableGateway->insert($data);
            } else {
                throw new \Exception('La tarifa no existe');
            }
        }
    }

    public function deleteTarifa($id) {
        $this->tableGateway->delete(array('idTarifa' => (int)$id));
    }
}