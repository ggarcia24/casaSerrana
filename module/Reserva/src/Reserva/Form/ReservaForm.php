<?php
namespace Reserva\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;



class ReservaForm extends Form {

    public function init() {

        $this->add(array(
            'type' => 'ReservaFieldset',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));


        $this->add(array(
            'name' => 'grabarReserva',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Grabar Reserva',
                'class' => 'btn btn-success',
            ),
        ));

    }
}