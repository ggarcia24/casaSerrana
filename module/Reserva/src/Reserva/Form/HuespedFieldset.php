<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 05/01/2015
 * Time: 11:12 PM
 */

namespace Reserva\Form;

use Reserva\Model\Huesped;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class HuespedFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('huesped');

        $this
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new Huesped())
        ;

        $this->add(array(
           'name' => 'id',
           'type' => 'hidden'
        ));

        $this->add(array(
           'name'       => 'nombre',
           'options' => array('label' => 'Nombre Completo'),
           'attributes' => array(
               'class' => 'form-control nombre',
               'maxlength' => '100',
           ),
        ));

        $this->add(array(
           'name' => 'documento',
           'options' => array('label' => 'Documento'),
           'attributes' => array(
                'class' => 'form-control documento',
                'maxlength' => '8',
            ),
        ));

        $this->add(array(
               'name'       => 'fechaNac',
               'options' => array('label' => 'Fecha de Nacimiento:',),
               'attributes' => array(
                   'type' => 'date',
                   'class' => 'form-control fechaNac'
               ),
           ));
        $this->add(array(
            'type' => 'button',
            'name' => 'remove',
            'options' => array(
                'label' => 'x',
            ),
            'attributes' => array(
                'onclick' => 'return remove_huesped(this);'
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
            'fechaNac' => array(
                'required' => true,
            ),
            'documento' => array(
                'required' => true,
            ),
        );
    }


}