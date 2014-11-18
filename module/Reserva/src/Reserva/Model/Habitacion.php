<?php

namespace Reserva\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Habitacion implements InputFilterAwareInterface
 {
    public $idHabitacion;
    public $numero;    
    public $idPabellon;
    public $plazaMaxima;
    public $idCategoria;
    public $idEstado;    
    protected $inputFilter;                      

     public function exchangeArray($data)
     {  
        $this->idHabitacion  = (isset($data['idHabitacion']))  ? $data['idHabitacion']  : null;       
        $this->numero  = (isset($data['numero']))  ? $data['numero']  : null;
        $this->idPabellon  = (isset($data['idPabellon']))  ? $data['idPabellon']  : null;
        $this->plazaMaxima  = (isset($data['plazaMaxima']))  ? $data['plazaMaxima']  : null;
        $this->idCategoria  = (isset($data['idCategoria']))  ? $data['idCategoria']  : null;
        $this->idEstado  = (isset($data['idEstado']))  ? $data['idEstado']  : null;
     }

     // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

      public function getArrayCopy()
     {
         return get_object_vars($this);
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'numero',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));


             

             $this->inputFilter = $inputFilter;
         }
         return $this->inputFilter;
     }
 }