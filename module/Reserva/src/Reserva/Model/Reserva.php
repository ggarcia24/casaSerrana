<?php

namespace Reserva\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Reserva implements InputFilterAwareInterface
 {
    public $idReserva;    
    public $idCliente;
    public $idHabitacion;
    public $idTarifa;    
    public $idEstado;
    public $idTipoHuesped;
    public $fechaIn;    
    public $fechaOut;     
    public $cantidadAdultos;
    public $cantidadMenores;
    //public $idPago;
    public $comentario;
    protected $inputFilter;                       // <-- Add this variable

     public function exchangeArray($data)
     {         
         $this->idReserva = (isset($data['idReserva']))  ? $data['idReserva']  : null;
         //$this->idCliente = (isset($data['idCliente']))  ? $data['idCliente']  : null;
         $this->cantidadAdultos = (isset($data['cantidadAdulto']))  ? $data['cantidadAdulto']  : null;    
         $this->idHabitacion = (isset($data['idHabitacion']))  ? $data['idHabitacion']  : null;       
         $this->idTarifa = (isset($data['idTarifa']))  ? $data['idTarifa']  : null;       
         $this->idEstado = (isset($data['idEstado']))  ? $data['idEstado']  : null;       
         $this->idTipoHuesped = (isset($data['idTipoHuesped']))  ? $data['idTipoHuesped']  : null;      
         $this->fechaIn = (isset($data['fechaIngreso']))  ? $data['fechaIngreso']  : null;       
         $this->fechaOut = (isset($data['fechaSalida']))  ? $data['fechaSalida']  : null;   
         $this->cantidadAdultos = (isset($data['cantidadAdulto']))  ? $data['cantidadAdulto']  : null;       
         $this->comentario = (isset($data['comentario']))  ? $data['comentario']  : null;       
         
     }

     // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

    
     public function getInputFilter()
     {
         if (!$this->inputFilter) 
         {
            $inputFilter = new InputFilter();
/*
            $inputFilter->add(array(
                'name'     => 'cantidadAdulto',
                'required' => true,
                'options' => array(
                    'messages' => array(
                        'isEmpty' => 'Please enter a value for "foo".',
                        ),
                ),                
             ));
*/
                $inputFilter->add(array(
                    'name' => 'cantidadAdulto',
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
                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir la cantidad de adultos' 
                                ),
                            ),
                        ),
                    ),
                ));

            $inputFilter->add(array(
                'name' => 'fechaIngreso',
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Ingresar fecha desde' 
                            ),
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'fechaSalida',
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Ingresar fecha hasta' 
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