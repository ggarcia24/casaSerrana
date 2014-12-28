<?php
namespace Cliente\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Predicate;

class AlimentoTable
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
     
     public function getAlimento($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idAlimento' => $id));
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
        $select->from('alimentos');
        $select->columns(array('value'=>'idAlimento','label'=>'nombre'));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        return $result;
    }




    public function saveAlimento(Alimento $alimento)
    {
        $data = array(            
            'idAlimento'            =>$alimento->idAlimento,
            'nombre'                =>$alimento->nombre,
            'descripcion'           =>$alimento->descripcion,
        );

        $id = (int) $alimento->idAlimento;
        if($id == 0)
        {
            $this->tableGateway->insert($data);
        }else
        {
            if ($this->getAlimento($id))
            {
               
                $this->tableGateway->update($data, array('idAlimento' => $id));
            }else 
            {
                throw new \Exception('Alimento id does not exist');
            }
        }
    }

     public function deleteAlimento($id)
     {
         $this->tableGateway->delete(array('idAlimento' => (int) $id));
     }
 }