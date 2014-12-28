<?php

namespace Cliente\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Convenio implements InputFilterAwareInterface
 {
    public $idConvenio;
    public $nombre;
    protected $inputFilter;
        
    public function exchangeArray($data)
    {

        $this->idConvenio = (!empty($data['idTarjeta'])) ? $data['idTarjeta'] : null;        
        $this->nombre  = (!empty($data['nombre'])) ? $data['nombre'] : null;
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
        

    }
 }