<?php

namespace Reserva\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Tarifa implements InputFilterAwareInterface
 {
    public $idTarifa;
    public $monto;
    public $vigencia;
    public $idCategoria;
    public $idTipoHuesped;

    protected $inputFilter;                       // <-- Add this variable

     public function exchangeArray($data)
     {         
        $this->idTarifa = (!empty($data['idTarifa'])) ? $data['idTarifa'] : null;
        $this->monto = (!empty($data['monto'])) ? $data['monto'] : null;
        $this->vigencia = (!empty($data['vigencia'])) ? $data['vigencia'] : null;
        $this->idCategoria = (!empty($data['idCategoria'])) ? $data['idCategoria'] : null;
        $this->idTipoHuesped = (!empty($data['idTipoHuesped'])) ? $data['idTipoHuesped'] : null;
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
                 'name'     => 'monto',
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