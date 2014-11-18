<?php
namespace Proveedor\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;
class ProveedorTable
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


     public function getProveedor($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idProveedor' => $idProveedor));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }



    public function saveProveedor(Proveedor $proveedor)
    {
        $data = array(            
            'idProveedor'                  =>$proveedor->idProveedor,
            'nombreCompania'                  =>$proveedor->nombreCompania,
            'cuit'                =>$proveedor->cuit,
            'nombreContacto'             =>$proveedor->nombreContacto,
            'telefonoFijo'          =>$proveedor->telefonoFijo,
            'telefonoCelular'       =>$proveedor->telefonoCelular,
            
            
            'provincia'               =>$proveedor->provincia,
            'localidad'                 =>$proveedor->localidad,
            'email'    =>$proveedor->email,
            'direccion'          =>$proveedor->direccion,
            
            'codigoPostal'       =>$proveedor->codigoPostal,

        );

        $id = (int) $proveedor->idProveedor;
        if($id == 0)
        {
            
            print_r($data);
            
            $this->tableGateway->insert($data);
        }else
        {
            if ($this->getProveedor($id)) 
            {
                $this->tableGateway->update($data, array('idProveedor' => $idProveedor));
            }else 
            {
                throw new \Exception('Proveedor id does not exist');
            }
        }
    }

     public function deleteProveedor($id)
     {
         $this->tableGateway->delete(array('idProveedor' => (int) $id));
     }
 }