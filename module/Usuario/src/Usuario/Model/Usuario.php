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

         $this->idProveedor  = (isset($data['idProveedor']))  ? $data['idProveedor']  : null;
         $this->nombreCompania  = (isset($data['nombreCompania']))  ? $data['nombreCompania']  : null;
         $this->cuit  = (isset($data['cuit']))  ? $data['cuit']  : null;
         $this->nombreContacto  = (isset($data['nombreContacto']))  ? $data['nombreContacto']  : null;
         $this->telefonoFijo  = (isset($data['telefonoFijo']))  ? $data['telefonoFijo']  : null;
         $this->telefonoCelular  = (isset($data['telefonoCelular']))  ? $data['telefonoCelular']  : null;
         $this->provincia  = (isset($data['provincia']))  ? $data['provincia']  : null;
         $this->localidad  = (isset($data['localidad']))  ? $data['localidad']  : null;
         $this->email  = (isset($data['email']))  ? $data['email']  : null;
         $this->direccion  = (isset($data['direccion']))  ? $data['direccion']  : null;
         $this->codigoPostal  = (isset($data['codigoPostal']))  ? $data['codigoPostal']  : null;
         
     }

     // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
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