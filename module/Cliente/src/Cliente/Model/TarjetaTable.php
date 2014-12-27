<?php
namespace Cliente\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Predicate;

class TarjetaTable
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
     
     public function getTarjeta($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idTarjeta' => $id));
         $row = $rowset->current();         
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }
     
    public function fetchAllWithAlias()
    {
        $adapter=$this->tableGateway->getAdapter();
        $sql=new Sql($adapter);
        $select=$sql->select();
        $select->from('tarjetas');
        $select->columns(array('value'=>'idTarjeta','label'=>'nombre'));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        return $result;
    }



    public function saveTarjeta(Tarjeta $tarjeta)
    {
        $data = array(            
            'idTarjeta'             =>$tarjeta->idTarjeta,
            'nombre'                =>$tarjeta->nombre,
        );

        $id = (int) $tarjeta->idTarjeta;
        if($id == 0)
        {
            $this->tableGateway->insert($data);
        }else
        {
            if ($this->getTarjeta($id))
            {
               
                $this->tableGateway->update($data, array('idTarjeta' => $id));
            }else 
            {
                throw new \Exception('Tarjeta  id does not exist');
            }
        }
    }

     public function deleteTarjeta($id)
     {
         $this->tableGateway->delete(array('idTarjeta' => (int) $id));
     }
 }