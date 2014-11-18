<?php
namespace Reserva\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;

class CategoriaTable
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

     public function fetchAllWithAlias()
     {
        $adapter=$this->tableGateway->getAdapter();
        $sql=new Sql($adapter);
        $select=$sql->select();
        $select->from('categoriaHabitaciones');
        $select->columns(array('value'=>'idCategoria','label'=>'nombre'));

         $statement = $sql->prepareStatementForSqlObject($select);
         $result = $statement->execute(); 

         return $result;
     }
     
 }