<?php
namespace Cliente\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Predicate;

use Cliente\Exception\TestException;

class ClienteTable {
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function findByTerm($query) {

        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter);

        $resultSet1 = new ResultSet();
        $select1 = $sql->select();
        $select1->from('clientes')->where->like('nombre', '%'.$query.'%');
        $statement1 = $sql->prepareStatementForSqlObject($select1);
        $result1 = $statement1->execute();

        $resultSet2 = new ResultSet();
        $select2 = $sql->select();
        $select2->from('clientes')->where->like('apellido', '%'.$query.'%');
        $statement2 = $sql->prepareStatementForSqlObject($select2);
        $result2 = $statement2->execute();

        $resultSet3 = new ResultSet();
        $select3 = $sql->select();
        $select3->from('clientes')->where->equalTo('documento', $query);
        $statement3 = $sql->prepareStatementForSqlObject($select3);
        $result3 = $statement3->execute();

        $result = array_merge_recursive($resultSet1->initialize($result1)->toArray(),
                                        $resultSet2->initialize($result2)->toArray(),
                                        $resultSet3->initialize($result3)->toArray());

        return $result;
    }

    public function getCliente($id) {
        $id = (int)$id;

        $rowset = $this->tableGateway->select(array('idCliente' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }


    public function saveCliente(Cliente $cliente) {
        $data = array(
            'idCliente' => $cliente->idCliente,
            'apellido' => $cliente->apellido,
            'nombre' => $cliente->nombre,
            'direccion' => $cliente->direccion,
            'telefono' => $cliente->telefono,
            'tipoDocumento' => $cliente->tipoDocumento,
            'documento' => $cliente->documento,
            'idBancoPorCliente' => $cliente->idBancoPorCliente,
            'titular' => $cliente->titular,
            'email' => $cliente->email,
            'idAlimentoEspecial' => $cliente->idAlimentoEspecial,
            'codigoPostal' => $cliente->codigoPostal,
            'idTarjetaPorCliente' => $cliente->idTarjetaPorCliente,
            'fechaNacimiento' => $cliente->fechaNacimiento,
            'idTipoHuesped' => $cliente->idTipoHuesped,
            'idProvincia' => $cliente->idProvincia,
            'idPais' => $cliente->idPais,
            'localidad' => $cliente->localidad,
        );

        $id = (int)$cliente->idCliente;
        if ($id == 0) {
            try {
                $this->tableGateway->insert($data);
            } catch (\Exception $ex) {
                $this->flashMessenger()->addMessage('probando el mensajes');
                return $this->redirect()->toRoute('cliente', array('action' => 'index'));
                //throw new \Exception('Cliente id does not exist');

            }
        } else {
            if ($this->getCliente($id)) {

                $this->tableGateway->update($data, array('idCliente' => $id));
            } else {
                throw new \InvalidArgumentException('Cliente id does not exist');
            }
        }
    }

    public function deleteCliente($id) {
        $this->tableGateway->delete(array('idCliente' => (int)$id));
    }
}