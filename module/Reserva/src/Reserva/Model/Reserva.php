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
     * @var array Habitacion
     */
    protected $habitaciones;

    /**
     * @var array
     */
    protected $huespedes;

    /**
     * @var array Pago
     */
    public $pagos;

    /**
     * @var string
     */
    protected $arrival_date;

    /**
     * @var string
     */
    protected $departure_date;

    /**
     * @var int
     */
    protected $cantidadAdultos;

    /**
     * @var int
     */
    protected $cantidadMenores;

    /**
     * @var string
     */
    protected $comentario;

    /**
     * @var string
     */
    protected $created_date;

    /**
     * @var string
     */
    protected $updated_date;

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
    public function getHabitaciones() {
        return $this->habitaciones;
    }

    /**
     * @param array
     * @return Reserva
     */
    public function setHabitaciones(array $habitaciones) {
        $this->habitaciones = $habitaciones;
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

    /**
     * @return string
     */
    public function getArrivalDate() {
        return $this->arrival_date;
    }

    /**
     * @param string $arrival_date
     * @return Reserva
     */
    public function setArrivalDate($arrival_date) {
        $this->arrival_date = $arrival_date;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepartureDate() {
        return $this->departure_date;
    }

    /**
     * @param string $departure_date
     * @return Reserva
     */
    public function setDepartureDate($departure_date) {
        $this->departure_date = $departure_date;
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

    public function exchangeArray($data) {
        $this->id = (isset($data['idReserva'])) ? $data['idReserva'] : null;
        $this->idCliente = (isset($data['idCliente'])) ? $data['idCliente'] : null;
        $this->arrival_date = (isset($data['arrival_date'])) ? $data['arrival_date'] : null;
        $this->departure_date = (isset($data['departure_date'])) ? $data['departure_date'] : null;
        $this->cantidadAdultos = (isset($data['cantidadAdulto'])) ? $data['cantidadAdulto'] : null;
        $this->cantidadMenores = (isset($data['cantidadMenores'])) ? $data['cantidadMenores'] : null;
        $this->comentario = (isset($data['comentario'])) ? $data['comentario'] : null;
        $this->created_date = (isset($data['created_date'])) ? $data['created_date'] : null;
        $this->updated_date = (isset($data['updated_date'])) ? $data['updated_date'] : null;
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
                'name' => 'arrival_date',
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
                'name' => 'departure_date',
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