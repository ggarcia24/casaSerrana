<?php
namespace Reserva\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Adapter\Adapter;
class ReservaTable
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


     public function getReserva($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('idReserva' => $idReserva));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function getReservaPorFechas($fechaDesde,$fechaHasta)
     {        
         $adapter=$this->tableGateway->getAdapter();
         $sql=new Sql($adapter);
         $select=$sql->select();
         $select->from('reservas'); 
         $fechaDesde=str_replace("-", "", $fechaDesde);
         $fechaHasta=str_replace("-", "", $fechaHasta);
         $select->where('fechaIn >='."'".$fechaDesde."'" OR 'fechaOut <='."'". $fechaHasta ."'" );
         //$select->where('fechaOut <='."'". $fechaHasta ."'");
         //$select->where('idReserva='."'". "1" ."'");

         $statement = $sql->prepareStatementForSqlObject($select);
         $result = $statement->execute();
         return $result;        
     }

     public function getReservaPorFecha($fecha)
     {

        //$fecha=str_replace("-", "", $fecha);
         $adapter=$this->tableGateway->getAdapter();
         $sql=new Sql($adapter);
         $select=$sql->select();
         $select->from('reservas');
         $select->where('fechaIn <='."'".$fecha."'");
         $select->where('fechaOut >='."'". $fecha ."'");
         $statement = $sql->prepareStatementForSqlObject($select);
         $result = $statement->execute(); 
         return $result;
        
     }



    public function saveReserva(Reserva $reserva)
    {
        $data = array(            
            'cuit'              =>$reserva->cuit,
            'nombre'                =>$reserva->nombre,
            'domicilio'             =>$reserva->domicilio,
            'telefonoFijo'          =>$reserva->telefonoFijo,
            'telefonoCelular'       =>$reserva->telefonoCelular,
            'tipoDocumento'         =>$reserva->tipoDocumento,
            'documento'             =>$reserva->documento,            
            'titular'               =>$reserva->titular,
            'email'                 =>$reserva->email,
            'idAlimentoEspecial'    =>$reserva->idAlimentoEspecial,
            'codigoPostal'          =>$reserva->codigoPostal,            
            'fechaNacimiento'       =>$reserva->fechaNacimiento,
            'idPadronAfiliado'      =>$$reserva->idPadronAfiliado,
        );

        $id = (int) $reserva->idReserva;
        if($id == 0)
        {
            print_r($data);
            exit;
            $this->tableGateway->insert($data);
        }else
        {
            if ($this->getReserva($id)) 
            {
                $this->tableGateway->update($data, array('idReserva' => $idReserva));
            }else 
            {
                throw new \Exception('Reserva id does not exist');
            }
        }
    }

     public function deleteReserva($id)
     {
         $this->tableGateway->delete(array('idReserva' => (int) $id));
     }
 }
