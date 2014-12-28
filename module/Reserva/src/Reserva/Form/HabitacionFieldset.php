<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 06/01/2015
 * Time: 12:16 AM
 */

namespace Reserva\Form;


use Reserva\Model\Habitacion;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;


class HabitacionFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('habitacion');
    }

    public function init() {
        $this->setHydrator(new ClassMethodsHydrator(false))
             ->setObject(new Habitacion());

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'numero',
            'options' => array(
                'label' => 'Número Habitación:',
            ),
            'attributes'   => array(
                //'required' => 'required',
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '10',
                'readonly' => 'true',
            )
        ));

        $this->add(array(
            'name' => 'pabellon',
            'type' => 'PabellonFieldset',
        ));
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     * @return array
     */
    public function getInputFilterSpecification() {
        return array(
            'numero' => array(
                'required' => true,
            ),
        );
    }


}