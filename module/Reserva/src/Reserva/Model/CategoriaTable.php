<?php
namespace Reserva\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;

class CategoriaTable {
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function get($id) {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('idCategoria' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function fetchAllWithAlias() {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('categoriahabitaciones');
        $select->columns(array('value' => 'idCategoria', 'label' => 'nombre'));

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        return $result;
    }

    public function save(Categoria $categoria) {
        $data = array(
            'idCategoria' => $categoria->getId(),
            'nombre' => $categoria->getNombre(),
        );

        $id = (int) $categoria->getId();
        if($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->get($id)) {
                $this->tableGateway->update($data, array('idCategoria' => $id));
            } else {
                throw new \Exception('La Categoria no existe');
            }
        }
    }

    public function delete($id) {
        $this->tableGateway->delete(array('idCategoria' => (int)$id));
    }



}