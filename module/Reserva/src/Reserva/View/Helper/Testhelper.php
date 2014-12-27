<?php
namespace Reserva\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Reserva\Model\Habitacion;
use Reserva\Model\HabitacionTable;

class Testhelper extends AbstractHelper
{
    public function __invoke() 
    {
    
        
        return $this;
                
    }
    
    public function fooMethod( $test ){
        echo $test;
    }
 
    public function barMethod()
    {
        echo 'hai';
    }
}
