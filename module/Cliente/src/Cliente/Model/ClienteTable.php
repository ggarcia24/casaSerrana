<?php
namespace Cliente\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Predicate;

use Cliente\Exception\TestException;

class ClienteTable
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

     public function getClientePorFecha()
     {

         $adapter=$this->tableGateway->getAdapter();
         $sql=new Sql($adapter);
         $select=$sql->select();

         $select->from('clientes');

         //$select->where(array('idCliente' => 1));

         echo $sql->getSqlStringForSqlObject($select);
         

         $statement = $sql->prepareStatementForSqlObject($select);
         $result = $statement->execute(); 
         //foreach ($result as $value) { 
           // echo var_dump($value); 
           // }
          //  exit; 
           //    $row = $result->current();
         return $result;        
     }
     
     public function getClientePorDatos($datos)
     {
         
        $adapter=$this->tableGateway->getAdapter();
        $sql=new Sql($adapter);
        $select=$sql->select();
        $select->from('clientes');
        $select->where(array(
            new Predicate\PredicateSet(
                array(
                    new Predicate\Like('nombre', '%'.$datos.'%'),
                    new Predicate\Like('apellido', '%'.$datos.'%'),
                    new Predicate\Operator('documento', '=',  $datos),
                ),
                Predicate\PredicateSet::COMBINED_BY_OR
            ),
        ));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        return $result;
     }

     public function getCliente($id)
     {
         $id  = (int) $id;

         $rowset = $this->tableGateway->select(array('idCliente' => $id));
         $row = $rowset->current();         
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }



    public function saveCliente(Cliente $cliente)
    {
        $data = array(            
            'idCliente'             =>$cliente->idCliente,
            'apellido'              =>$cliente->apellido,
            'nombre'                =>$cliente->nombre,
            'direccion'             =>$cliente->direccion,
            'telefono'              =>$cliente->telefono,
            'tipoDocumento'         =>$cliente->tipoDocumento,
            'documento'             =>$cliente->documento,
            'idBancoPorCliente'     =>$cliente->idBancoPorCliente,
            'titular'               =>$cliente->titular,
            'email'                 =>$cliente->email,
            'idAlimentoEspecial'    =>$cliente->idAlimentoEspecial,
            'codigoPostal'          =>$cliente->codigoPostal,
            'idTarjetaPorCliente'   =>$cliente->idTarjetaPorCliente,
            'fechaNacimiento'       =>$cliente->fechaNacimiento,
            'idTipoHuesped'         =>$cliente->idTipoHuesped,
            'idProvincia'           =>$cliente->idProvincia,
            'idPais'                =>$cliente->idPais,
            'localidad'             =>$cliente->localidad,
        );

        $id = (int) $cliente->idCliente;
        if($id == 0)
        {
            $this->tableGateway->insert($data);

        }else
        {
            if ($this->getCliente($id))
            {
               
                $this->tableGateway->update($data, array('idCliente' => $id));
            }else 
            {
                throw new \InvalidArgumentException('Cliente id does not exist');
            }
        }
    }

     public function deleteCliente($id)
     {
         $this->tableGateway->delete(array('idCliente' => (int) $id));
     }
 }