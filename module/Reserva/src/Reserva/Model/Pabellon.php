<?php

namespace Reserva\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Pabellon implements InputFilterAwareInterface {

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
        // This is an ugly thing use an Hydrator insted
        if(is_int($id)) {
            $this->id = $id;
            return $this;
        }

        if(is_array($id)) {
            if(isset($id['idPabellon'])) {
                $this->id = $id['idPabellon'];
                return $this;
            }

            if(isset($id['id'])) {
                $this->id = $id['id'];
                return $this;
            }
        }
    }

    /**
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function exchangeArray($data) {
        $this->setId($data);
        $this->nombre = (!empty($data['nombre'])) ? $data['nombre'] : null;
    }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

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
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Por favor introducir el nombre del Pabellon' 
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
