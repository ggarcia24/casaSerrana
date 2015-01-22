<?php

namespace Reserva\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Tarifa implements InputFilterAwareInterface {

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $monto;

    /**
     * @var string
     */
    protected $vigencia;

    /**
     * @var Categoria
     */
    protected $categoria;

    /**
     * @var int
     */
    protected $idCategoria;

    /**
     * @var Tipohuesped
     */
    protected $tipoHuesped;

    /**
     * @var int
     */
    protected $idTipoHuesped;

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Tarifa
     */
    public function setId($id) {
        // This is an ugly thing use an Hydrator insted
        if(is_int($id)) {
            $this->id = $id;
            return $this;
        }

        if(is_array($id)) {
            if(isset($id['idTarifa'])) {
                $this->id = $id['idTarifa'];
                return $this;
            }

            if(isset($id['id'])) {
                $this->id = $id['id'];
                return $this;
            }
        }
    }

    /**
     * @return int
     */
    public function getMonto() {
        return $this->monto;
    }

    /**
     * @param int $monto
     * @return Tarifa
     */
    public function setMonto($monto) {
        $this->monto = $monto;
        return $this;
    }

    /**
     * @return string
     */
    public function getVigencia() {
        return $this->vigencia;
    }

    /**
     * @param string $vigencia
     * @return Tarifa
     */
    public function setVigencia($vigencia) {
        $this->vigencia = $vigencia;
        return $this;
    }

    /**
     * @return Categoria
     */
    public function getCategoria() {
        return $this->categoria;
    }

    /**
     * @param Categoria $categoria
     * @return Tarifa
     */
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdCategoria() {
        return $this->idCategoria;
    }

    /**
     * @param int $idCategoria
     * @return Tarifa
     */
    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
        return $this;
    }

    /**
     * @return Tipohuesped
     */
    public function getTipoHuesped() {
        return $this->tipoHuesped;
    }

    /**
     * @param Tipohuesped $tipoHuesped
     * @return Tarifa
     */
    public function setTipoHuesped($tipoHuesped) {
        $this->tipoHuesped = $tipoHuesped;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdTipoHuesped() {
        return $this->idTipoHuesped;
    }

    /**
     * @param int $idTipoHuesped
     * @return Tarifa
     */
    public function setIdTipoHuesped($idTipoHuesped) {
        $this->idTipoHuesped = $idTipoHuesped;
        return $this;
    }

    public function exchangeArray($data) {
        $this->setId($data);
        $this->monto = (!empty($data['monto'])) ? $data['monto'] : null;
        $this->vigencia = (!empty($data['vigencia'])) ? $data['vigencia'] : null;
        $this->idCategoria = (!empty($data['idCategoria'])) ? $data['idCategoria'] : null;
        $this->idTipoHuesped = (!empty($data['idTipoHuesped'])) ? $data['idTipoHuesped'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'idCategoria',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir la categoria de habitacion'
                            ),
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'idTipoHuesped',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el tipo de convenio'
                            ),
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'monto',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el monto diario'
                            ),
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'vigencia',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir la vigencia'
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