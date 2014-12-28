<?php

namespace Reserva\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Habitacion implements InputFilterAwareInterface {

    /**
     * @var int $id
     */
    protected $id;

    /**
     * @var int $numero
     */
    protected $numero;

    /**
     * @var Pabellon $pabellon
     */
    protected $pabellon;

    /**
     * @var int $idPabellon
     */
    protected $idPabellon;

    /**
     * @var int $plazaMaxima
     */
    protected $plazaMaxima;

    /**
     * @var Categoria $categoria
     */
    protected $categoria;

    /**
     * @var int $idCategoria
     */
    protected $idCategoria;

    /**
     * @var Estado $estado
     */
    protected $estado;

    /**
     * @var int $idEstado
     */
    protected $idEstado;

    /**
     * @var InputFilter $inputFilter
     */
    protected $inputFilter;

    const DISPONIBLE = 1;
    const RESERVADA = 2;
    const RESERVADA_SENIA = 3;
    const OCUPADA = 4;
    const NO_DISPONIBLE = 5;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Habitacion
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * @param int $numero
     * @return Habitacion
     */
    public function setNumero($numero) {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return Pabellon
     */
    public function getPabellon() {
        return $this->pabellon;
    }

    /**
     * @param Pabellon $pabellon
     * @return Habitacion
     */
    public function setPabellon($pabellon) {
        $this->pabellon = $pabellon;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdPabellon() {
        return $this->idPabellon;
    }

    /**
     * @param int $idPabellon
     */
    public function setIdPabellon($idPabellon) {
        $this->idPabellon = $idPabellon;
    }

    /**
     * @return int
     */
    public function getPlazaMaxima() {
        return $this->plazaMaxima;
    }

    /**
     * @param int $plazaMaxima
     * @return Habitacion
     */
    public function setPlazaMaxima($plazaMaxima) {
        $this->plazaMaxima = $plazaMaxima;
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
     * @return Habitacion
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
     */
    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    /**
     * @return Estado
     */
    public function getEstado() {
        return $this->estado;
    }

    /**
     * @param Estado $estado
     * @return Habitacion
     */
    public function setEstado($estado) {
        $this->estado = $estado;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdEstado() {
        return $this->idEstado;
    }

    /**
     * @param int $idEstado
     */
    public function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function exchangeArray($data) {
        $this->id = (isset($data['idHabitacion'])) ? $data['idHabitacion'] : null;
        $this->numero = (isset($data['numero'])) ? $data['numero'] : null;
        $this->plazaMaxima = (isset($data['plazaMaxima'])) ? $data['plazaMaxima'] : null;
        $this->idPabellon = (isset($data['idPabellon'])) ? $data['idPabellon'] : null;
        $this->idCategoria = (isset($data['idCategoria'])) ? $data['idCategoria'] : null;
        $this->idEstado = (isset($data['idEstado'])) ? $data['idEstado'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();


            $inputFilter->add(array(
                                  'name' => 'numero', 'required' => true, 'filters' => array(
                    array('name' => 'StripTags'), array('name' => 'StringTrim'),
                ), 'validators'          => array(
                    array(
                        'name' => 'NotEmpty', 'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el numero de habitacion'
                        ),
                    ),
                    ),
                ),
                              ));

            $inputFilter->add(array(
                                  'name' => 'plazaMaxima', 'required' => true, 'filters' => array(
                    array('name' => 'StripTags'), array('name' => 'StringTrim'),
                ), 'validators'          => array(
                    array(
                        'name' => 'NotEmpty', 'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir las plazas maximas'
                        ),
                    ),
                    ),
                ),
                              ));

            $inputFilter->add(array(
                                  'name' => 'idPabellon', 'required' => true, 'filters' => array(
                    array('name' => 'StripTags'), array('name' => 'StringTrim'),
                ), 'validators'          => array(
                    array(
                        'name' => 'NotEmpty', 'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el pabellon'
                        ),
                    ),
                    ),
                ),
                              ));

            $inputFilter->add(array(
                                  'name' => 'idCategoria', 'required' => true, 'filters' => array(
                    array('name' => 'StripTags'), array('name' => 'StringTrim'),
                ), 'validators'          => array(
                    array(
                        'name' => 'NotEmpty', 'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir la categoria de habitacion'
                        ),
                    ),
                    ),
                ),
                              ));

            $inputFilter->add(array(
                                  'name' => 'idEstado', 'required' => true, 'filters' => array(
                    array('name' => 'StripTags'), array('name' => 'StringTrim'),
                ), 'validators'          => array(
                    array(
                        'name' => 'NotEmpty', 'options' => array(
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