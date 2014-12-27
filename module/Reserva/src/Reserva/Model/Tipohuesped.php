<?php

namespace Reserva\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Tipohuesped implements InputFilterAwareInterface
 {
    public $idTipoHuesped;
    public $nombre;
    protected $inputFilter;                       // <-- Add this variable

     public function exchangeArray($data)
     {         
        $this->idTipoHuesped = (!empty($data['idTipoHuesped'])) ? $data['idTipoHuesped'] : null;
        $this->nombre = (!empty($data['nombre'])) ? $data['nombre'] : null;
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
                'name' => 'nombre',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el tipo de Huesped' 
                            ),
                        ),
                    ),
                ),
            ));

             

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }