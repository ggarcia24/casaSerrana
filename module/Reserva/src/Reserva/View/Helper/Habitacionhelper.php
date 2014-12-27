<?php
namespace Reserva\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Reserva\Model\Habitacion;
use Reserva\Model\HabitacionTable;
 
class Habitacionhelper extends AbstractHelper
{
    protected $sm;
    protected $habitacionTable;

    public function getHabitacionTable()
    {
        if (!$this->habitacionTable) {
            $sm = $this->getServiceLocator();
            
            $this->habitacionTable = $sm->get('Reserva\Model\HabitacionTable');
        }
        return $this->habitacionTable;
    }

    public function __invoke()
    {
        return $this;
    }
    
    public function probando()
    {
        return 'probando';
    }

    
    public function obtengoHabitacion($id)
    {
        $habitacion = $this->getHabitacionTable()->getHabitacion($id);
        
        return $habitacion->nombre;
    }
}

