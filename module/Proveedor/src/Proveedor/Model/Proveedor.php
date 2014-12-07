<?php

namespace Proveedor\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Proveedor implements InputFilterAwareInterface
 {
    public $idProveedor;
    public $nombreCompania;    
    public $cuit;     
    public $nombreContacto;
    public $telefonoFijo;
    public $telefonoCelular;
    public $provincia;
    public $localidad;
    public $email;
    public $direccion;
    public $codigoPostal;
    protected $inputFilter;                       // <-- Add this variable

     public function exchangeArray($data)
     {

        $this->idProveedor = (!empty($data['idProveedor'])) ? $data['idProveedor'] : null;
        $this->nombreCompania = (!empty($data['nombreCompania'])) ? $data['nombreCompania'] : null;
        $this->cuit = (!empty($data['cuit'])) ? $data['cuit'] : null;
        $this->nombreContacto = (!empty($data['nombreContacto'])) ? $data['nombreContacto'] : null;
        $this->telefonoFijo = (!empty($data['telefonoFijo'])) ? $data['telefonoFijo'] : null;
        $this->telefonoCelular = (!empty($data['telefonoCelular'])) ? $data['telefonoCelular'] : null;
        $this->provincia = (!empty($data['provincia'])) ? $data['provincia'] : null;
        $this->localidad = (!empty($data['localidad'])) ? $data['localidad'] : null;
        $this->idCliente = (!empty($data['idCliente'])) ? $data['idCliente'] : null;
        $this->email     = (!empty($data['email'])) ? $data['email'] : null;
        $this->direccion = (!empty($data['direccion'])) ? $data['direccion'] : null;
        $this->codigoPostal  = (!empty($data['codigoPostal '])) ? $data['codigoPostal '] : null;
         
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
                 'name'     => 'cuit',
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
                             'messages' => array(
                                'stringLengthTooShort' => 'CUIT demasiado largo',
                            ),
                         ),

                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'nombreCompania',
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