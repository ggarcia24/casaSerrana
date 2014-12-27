<?php

namespace Cliente\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Cliente implements InputFilterAwareInterface
 {

    
     
    public $idCliente;
    public $apellido;
    public $nombre;
    public $direccion;
    public $telefono;
    public $tipoDocumento;
    public $documento;
    public $idBancoPorCliente;
    public $titular;
    public $email;
    public $alimento;
    public $codigoPostal;
    public $idTarjetaPorCliente;
    public $fechaNacimiento;
    public $idPadronAfiliado;
    public $provincia;
    public $pais;

    protected $inputFilter;

     public function exchangeArray($data)
     {

        $this->idCliente = (!empty($data['idCliente'])) ? $data['idCliente'] : null;
        $this->apellido = (!empty($data['apellido'])) ? $data['apellido'] : null;
        $this->nombre  = (!empty($data['nombre'])) ? $data['nombre'] : null;
        $this->direccion = (!empty($data['direccion'])) ? $data['direccion'] : null;
        $this->telefono = (!empty($data['telefono'])) ? $data['telefono'] : null;     
        $this->tipoDocumento = (!empty($data['tipoDocumento'])) ? $data['tipoDocumento'] : null;
        $this->documento = (!empty($data['documento'])) ? $data['documento'] : null;
        $this->idBancoPorCliente = (!empty($data['idBancoPorCliente'])) ? $data['idBancoPorCliente'] : null;
        $this->titular = (!empty($data['titular'])) ? $data['titular'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
        $this->alimento = (!empty($data['alimento'])) ? $data['alimento'] : null;
        $this->codigoPostal = (!empty($data['codigoPostal'])) ? $data['codigoPostal'] : null;
        $this->idTarjetaPorCliente = (!empty($data['idTarjetaPorCliente'])) ? $data['idTarjetaPorCliente'] : null;         
        $this->fechaNacimiento = (!empty($data['fechaNacimiento'])) ? $data['fechaNacimiento'] : null;
        $this->idPadronAfiliado = (!empty($data['idPadronAfiliado'])) ? $data['idPadronAfiliado'] : null;
        $this->provincia = (!empty($data['provincia'])) ? $data['provincia'] : null;
        $this->pais = (!empty($data['pais'])) ? $data['pais'] : null;

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
                'name' => 'apellido',
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el Apellido' 
                            ),
                        ),
                    ),
                ),
            ));

            
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el Nombre' 
                            ),
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'documento',
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el Documento' 
                            ),
                        ),
                    ),
                ),
            ));            
            
            $inputFilter->add(array(
                'name' => 'telefono',
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el Telefono' 
                            ),
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'pais',
                'required' => false,
            ));
            
            $inputFilter->add(array(
                'name'     => 'provincia',
                'required' => false,
            ));

            
            $inputFilter->add(array(
                'name'     => 'idPadronAfiliado',
                'required' => false,
            ));
            
            $inputFilter->add(array(
                'name'     => 'alimento',
                'required' => false,
            ));
            
            $inputFilter->add(array(
                'name'     => 'tarjeta',
                'required' => false,
            ));
             

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }