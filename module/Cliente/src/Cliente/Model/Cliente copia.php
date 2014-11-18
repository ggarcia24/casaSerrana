<?php

namespace Cliente\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Cliente implements InputFilterAwareInterface
{
    public $idCliente;
    public $apellido;
	public $nombre;
	public $domicilio;
	public $telefonoFijo;
	public $telefonoCelular;
	public $tipoDocumento;
	public $documento;
	public $idBancoPorCliente;
	public $titular;
	public $email;
	public $idAlimentoEspecial;
	public $codigoPostal;
	public $idTarjetaPorCliente;
	public $fechaNacimiento;
	public $idPadronAfiliado;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->idCliente = (!empty($data['idCliente'])) ? $data['idCliente'] : null;
        $this->apellido = (!empty($data['apellido'])) ? $data['apellido'] : null;
        $this->nombre  = (!empty($data['nombre'])) ? $data['nombre'] : null;
        $this->domicilio = (!empty($data['domicilio'])) ? $data['domicilio'] : null;
        $this->telefonoFijo = (!empty($data['telefonoFijo'])) ? $data['telefonoFijo'] : null;
        $this->telefonoCelular = (!empty($data['telefonoCelular'])) ? $data['telefonoCelular'] : null;        
        $this->tipoDocumento = (!empty($data['tipoDocumento'])) ? $data['tipoDocumento'] : null;
        $this->documento = (!empty($data['documento'])) ? $data['documento'] : null;
        $this->idBancoPorCliente = (!empty($data['idBancoPorCliente'])) ? $data['idBancoPorCliente'] : null;
        $this->titular = (!empty($data['titular'])) ? $data['titular'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
        $this->idAlimentoEspecial = (!empty($data['idAlimentoEspecial'])) ? $data['idAlimentoEspecial'] : null;
        $this->codigoPostal = (!empty($data['codigoPostal'])) ? $data['codigoPostal'] : null;
        $this->idTarjetaPorCliente = (!empty($data['idTarjetaPorCliente'])) ? $data['idTarjetaPorCliente'] : null;         
        $this->fechaNacimiento = (!empty($data['fechaNacimiento'])) ? $data['fechaNacimiento'] : null;
        $this->idPadronAfiliado = (!empty($data['idPadronAfiliado'])) ? $data['idPadronAfiliado'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->add(array(
                'name'     => 'idCliente',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));
            $inputFilter->add(array(
                'name'     => 'apellido',
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
                            'max'      => 40,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name'     => 'nombre',
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
                            'max'      => 40,
                        ),
                    ),
                ),
            ));
            $this->inputFilter = $inputFilter;

        }

        return $this->inputFilter;

    }
}