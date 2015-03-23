<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 06/01/2015
 * Time: 12:30 AM
 */

namespace Cliente\Form;


use Cliente\Model\Cliente;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Json\Expr as JsonExpr;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;


class ClienteFieldset  extends Fieldset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('cliente');

        $this
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new Cliente())
        ;

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
            'attributes' => array(
                'class' => 'idCliente'
            )
        ));

        $this->add(array(
            'name' => 'nombre',
            'type' => 'ZfSnapJquery\Form\Element\Autocomplete',
            'options' => array(
                'label' => 'Nombre Reserva:',
            ),
            'attributes'   => array(
                'id' => 'autocomplete',
                'type' => 'autocomplete',
                'class' => 'form-control nombre',
                'jquery' => array(
                    'focus'  => new JsonExpr('autocomplete_focus'),
                    'select' => new JsonExpr('autcomplete_select'),
                    'response' => new JsonExpr('autcomplete_response')
                ),
            )
        ));


        $this->add(array(
            'name' => 'telefono',
            'options' => array(
                'label' => 'Teléfono:',
            ),
            'attributes'   => array(
                'type' => 'text',
                'class' => 'form-control telefono',
                'maxlength' => '10',
                'readonly' => 'true',
            )
        ));

        $this->add(array(
            'type' => 'Email',
            'name' => 'email',
            'options' => array(
                'label' => 'Email:'
            ),
            'attributes'   => array(
                'class' => 'form-control email',
                'maxlength' => '60',
                'readonly' => 'true',
            ),
        ));

        $this->add(array(
            'type' => 'Hidden',
            'name' => 'idTipoHuesped',
        ));

        $this->add(array(
            'type' => 'Text',
            'name' => 'tipoHuesped',
            'options' => array(
                'label' => 'Tipo de Convenio:'
            ),
            'attributes'   => array(
                'class' => 'form-control tipoHuesped',
                'maxlength' => '60',
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
            'telefono' => array(
                'required' => true,
            ),
            'email' => array(
                'required' => true,
            ),
            'tipoHuesped' => array(
                'required' => true,
            ),
        );
    }

}