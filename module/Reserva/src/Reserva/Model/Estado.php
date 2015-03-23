<?php

namespace Reserva\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Estado implements InputFilterAwareInterface {

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $nombre;

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
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     *
     * @return Ca
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function exchangeArray($data) {
        $this->id = (isset($data['idEstado'])) ? $data['idEstado'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        return $this;
    }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                                  'name' => 'artist', 'required' => true, 'filters' => array(
                    array('name' => 'StripTags'), array('name' => 'StringTrim'),
                ), 'validators'          => array(
                    array(
                        'name' => 'StringLength', 'options' => array(
                        'encoding' => 'UTF-8', 'min' => 1, 'max' => 100,
                    ),
                    ),
                ),
                              ));

            $inputFilter->add(array(
                                  'name' => 'title', 'required' => true, 'filters' => array(
                    array('name' => 'StripTags'), array('name' => 'StringTrim'),
                ), 'validators'          => array(
                    array(
                        'name' => 'StringLength', 'options' => array(
                        'encoding' => 'UTF-8', 'min' => 1, 'max' => 100,
                    ),
                    ),
                ),
                              ));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}