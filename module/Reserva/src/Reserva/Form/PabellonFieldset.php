<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 06/01/2015
 * Time: 07:09 PM
 */

namespace Reserva\Form;


use Reserva\Model\Pabellon;
use Reserva\Model\PabellonTable;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class PabellonFieldset extends Fieldset implements InputFilterProviderInterface {

    protected $pabellonTable = null;

    public function __construct() {
        parent::__construct('pabellon');

        $this->setHydrator(new ClassMethodsHydrator(false))
             ->setObject(new Pabellon());
    }

    public function init() {

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'nombre',
            'options' => array(
                'label' => 'Pabellon:',
            ),
            'attributes' => array(
                //'required' => 'required',
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '50',
                'readonly' => 'true',
            ),
        ));


    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     * @return array
     */
    public function getInputFilterSpecification() {
        return array(
            'nombre' => array(
                'required' => true,
            ),
        );
    }
}