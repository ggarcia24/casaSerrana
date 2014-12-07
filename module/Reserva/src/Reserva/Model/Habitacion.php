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
        if (!$this->inputFilter) 
        {
            $inputFilter = new InputFilter();



            $inputFilter->add(array(
                'name' => 'numero',
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el numero de habitacion' 
                            ),
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'plazaMaxima',
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir las plazas maximas' 
                            ),
                        ),
                    ),
                ),
            )); 

            $inputFilter->add(array(
                'name' => 'idPabellon',
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el pabellon' 
                            ),
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'idCategoria',
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir la categoria de habitacion' 
                            ),
                        ),
                    ),
                ),
            ));  

            $inputFilter->add(array(
                'name' => 'idEstado',
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el estado de la habitacion' 
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