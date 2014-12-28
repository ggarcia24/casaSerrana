<?php

namespace Reserva\Model;

// Add these import statements
use Cliente\Model\Cliente;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Reserva implements InputFilterAwareInterface {

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $idCliente;

    /**
     * @var Cliente
     */
    protected $cliente;

    /**
     * @var int
     */
    protected $idHabitacion;

    /**
     * @var Habitacion
     */
    protected $habitacion;

    /**
     * @var int
     */
    protected $idTarifa;

    /**
     * @var Tarifa
     */
    protected $tarifa;

    /**
     * @var int
     */
    protected $idEstado;

    /**
     * @var Estado
     */
    protected $estado;

    /**
     * @var int
     */
    protected $idTipoHuesped;

    /**
     * @var Tipohuesped
     */
    protected $tipoHuesped;

    /**
     * @var string
     */
    protected $fechaIn;

    /**
     * @var string
     */
    protected $fechaOut;

    /**
     * @var int
     */
    protected $cantidadAdultos;

    /**
     * @var int
     */
    protected $cantidadMenores;
    //public $idPago;

    /**
     * @var string
     */
    protected $comentario;

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @var array
     */
    protected $huespedes;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $idReserva
     * @return Reserva
     */
    public function setId($idReserva) {
        $this->id = $idReserva;
        return $this;
    }

    /**
     * @return Cliente
     */
    public function getCliente() {
        return $this->cliente;
    }

    /**
     * @param Cliente $cliente
     * @return Reserva
     */
    public function setCliente(Cliente $cliente) {
        $this->cliente = $cliente;
        return $this;
    }

    /**
     * @return Habitacion
     */
    public function getHabitacion() {
        return $this->habitacion;
    }

    /**
     * @param Habitacion $habitacion
     * @return Reserva
     */
    public function setHabitacion(Habitacion $habitacion) {
        $this->habitacion = $habitacion;
        return $this;
    }

    /**
     * @return Tarifa
     */
    public function getTarifa() {
        return $this->tarifa;
    }

    /**
     * @param Tarifa $tarifa
     * @return Reserva
     */
    public function setTarifa(Tarifa $tarifa) {
        $this->tarifa = $tarifa;
        return $this;
    }

    /**
     * @return Estado
     */
    public function getEstado() {
        return $this->estado;
    }

    /**
     * @param Estado $estado
     * @return Reserva
     */
    public function setEstado(Estado $estado) {
        $this->estado = $estado;
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
     * @return Reserva
     */
    public function setTipoHuesped(Tipohuesped $tipoHuesped) {
        $this->tipoHuesped = $tipoHuesped;
    }

    /**
     * @return string
     */
    public function getFechaIn() {
        return $this->fechaIn;
    }

    /**
     * @param string $fechaIn
     * @return Reserva
     */
    public function setFechaIn($fechaIn) {
        $this->fechaIn = $fechaIn;
    }

    /**
     * @return string
     */
    public function getFechaOut() {
        return $this->fechaOut;
    }

    /**
     * @param string $fechaOut
     * @return Reserva
     */
    public function setFechaOut($fechaOut) {
        $this->fechaOut = $fechaOut;
    }

    /**
     * @return int
     */
    public function getCantidadAdultos() {
        if($this->cantidadAdultos === null && is_array($this->huespedes)) {
            $result = 0;
            /* @var Huesped $huesped */
            foreach($this->huespedes as $huesped) {
                if($huesped->esAdulto()) {
                    $result++;
                }
            }
            $this->cantidadAdultos = $result;
        }
        return $this->cantidadAdultos;
    }

    /**
     * @param int $cantidadAdultos
     * @return Reserva
     */
    public function setCantidadAdultos($cantidadAdultos = 0) {
        $this->cantidadAdultos = $cantidadAdultos;
        return $this;
    }

    /**
     * @return int
     */
    public function getCantidadMenores() {
        if($this->cantidadMenores === null && is_array($this->huespedes)) {
            $result = 0;
            /* @var Huesped $huesped */
            foreach($this->huespedes as $huesped) {
                if($huesped->esMenor()) {
                    $result++;
                }
            }
            $this->cantidadAdultos = $result;
        }
        return $this->cantidadAdultos;
    }

    /**
     * @param int $cantidadMenores
     * @return Reserva
     */
    public function setCantidadMenores($cantidadMenores = 0) {
        $this->cantidadMenores = $cantidadMenores;
        return $this;
    }

    /**
     * @return string
     */
    public function getComentario() {
        return $this->comentario;
    }

    /**
     * @param string $comentario
     * @return Reserva
     */
    public function setComentario($comentario = '') {
        $this->comentario = $comentario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHuespedes() {
        return $this->huespedes;
    }

    /**
     * @param mixed $huespedes
     * @return Reserva
     */
    public function setHuespedes($huespedes) {
        $this->huespedes = $huespedes;
    }

    public function exchangeArray($data) {
        $this->id = (isset($data['idReserva'])) ? $data['idReserva'] : null;
        $this->idCliente = (isset($data['idCliente'])) ? $data['idCliente'] : null;
        $this->idHabitacion = (isset($data['idHabitacion'])) ? $data['idHabitacion'] : null;
        $this->idTarifa = (isset($data['idTarifa'])) ? $data['idTarifa'] : null;
        $this->idEstado = (isset($data['idEstado'])) ? $data['idEstado'] : null;
        $this->idTipoHuesped = (isset($data['idTipoHuesped'])) ? $data['idTipoHuesped'] : null;
        $this->fechaIn = (isset($data['fechaIngreso'])) ? $data['fechaIngreso'] : null;
        $this->fechaOut = (isset($data['fechaSalida'])) ? $data['fechaSalida'] : null;
        $this->cantidadAdultos = (isset($data['cantidadAdulto'])) ? $data['cantidadAdulto'] : null;
        $this->cantidadMenores = (isset($data['cantidadMenores'])) ? $data['cantidadMenores'] : null;
        //$this->idPago = (isset($data['idPago'])) ? $data['idPago'] : null;
        $this->comentario = (isset($data['comentario'])) ? $data['comentario'] : null;
    }


        // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'cantidadAdulto',
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
                        'name' => 'NotEmpty',
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
                        'name' => 'NotEmpty',
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