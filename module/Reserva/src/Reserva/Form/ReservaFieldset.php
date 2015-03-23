<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 06/01/2015
 * Time: 12:13 AM
 */

namespace Reserva\Form;


use Reserva\Model\Reserva;
use Reserva\Model\ReservaTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;


class ReservaFieldset extends Fieldset implements InputFilterProviderInterface {

    protected $serviceManager = null;

    public function __construct(ServiceLocatorInterface $sm) {

        parent::__construct('reserva');
        $this->serviceManager = $sm;
        $this->setHydrator(new ClassMethodsHydrator(false))->setObject(new Reserva());

    }

    public function init() {

        $this->add(array(
            'name' => 'habitaciones',
            'type' => 'Collection',
            'options' => array(
                'Habitaciones',
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'target_element' => array(
                    'type' => 'Reserva\Form\HabitacionFieldset'
                )
            )
        ));

        $this->add(array(
            'name' => 'agregarHuesped',
            'type' => 'button',
            'options' => array(
                'label' => 'Agregar Huesped'
            ),
            'attributes' => array(
                'onclick' => 'return add_huesped()'
            )
        ));

        $this->add(array(
            'name' => 'cliente',
            'type' => 'ClienteFieldset',
            'attributes' => array(
                'id' => 'clienteFieldset'
            )
        ));

        $this->add(array(
            'name' => 'fechaIn',
            'options' => array(
                'label' => 'Fecha de Ingreso:',
            ),
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'fechaOut',
            'options' => array(
                'label' => 'Fecha de Salida:',
            ),
            'attributes'   => array(
                'type' => 'date',
                'class' => 'form-control',
            ),
        ));

        $results = new ResultSet();
        $this->add(array(
            'type' => 'Select',
            'name' => 'idEstado',
            'options' => array(
                'label' => 'Estado Reserva:',
                'empty_option' => 'Seleccione....',
                'value_options' => $results->initialize(
                    $this->serviceManager->get('Reserva\Model\EstadoTable')->fetchAllWithAlias()
                )->toArray()
            ),
            'attributes'   => array(
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'titular',
            'options' => array(
                'label' => 'Media Pensión',
                'value_options' => array(
                    '0' => 'No',
                    '1' => 'Si',
                ),
            ),
            'attributes'   => array(
                'value' => '0' //set checked to '1'
            )
        ));

        $this->add(array(
            'type' => 'Text',
            'name' => 'cantidadAdulto',
            'options' => array(
                'label' => 'Cantidad Adultos:',
            ),
            'attributes'   => array(
                'class' => 'form-control',
                'maxlength' => '10',
                'readonly' => 'true',
                'value' => 0
            ),
        ));
        $this->add(array(
            'type' => 'Text',
            'name' => 'cantidadMenor',
            'options' => array(
                'label' => 'Menores de 5:',
            ),
            'attributes'   => array(
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '10',
                'readonly' => 'true',
                'value' => 0
            ),
        ));

        $this->add(array(
            'type' => 'Collection',
            'name' => 'huespedes',
            'options' => array(
                'label' => 'Lista de Huespedes',
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'target_element' => array(
                    'type' => 'Reserva\Form\HuespedFieldset',
                ),
            ),
            'attributes' => array(
                'id' => 'huespedesFieldset'
            )
        ));

        $this->add(array(
            'name' => 'agregarHuesped',
            'type' => 'button',
            'options' => array(
                'label' => 'Agregar Huesped'
            ),
            'attributes' => array(
                'onclick' => 'return add_huesped()'
            )
        ));

        $this->add(array(
            'type' => 'TextArea',
            'name' => 'comentario',
            'options' => array(
                'label' => 'Comentarios:'
            ),
            'attributes'   => array(
                'id' => 'comentarios',
                'class' => 'form-control',
                'rows' => '6',
            ),
        ));

        $this->add(array(
            'name' => 'total',
            'options' => array(
                'label' => 'Total:'
            ),
            'attributes'   => array(
                'type' => 'Text',
                'class' => 'form-control',
                'maxlength' => '10',
                'readonly' => 'true',
            ),
        ));

        $this->add(array(
            'name' => 'descuento',
            'options' => array(
                'label' => 'Descuento'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'maxlength' => '10',
                'readonly' => 'true',
            ),
        ));

        $this->add(array(
            'name' => 'totalReserva',
            'options' => array(
                'label' => 'Total Reserva:'
            ),
            'attributes'   => array(
                'class' => 'form-control',
                'maxlength' => '10',
                'readonly' => 'readonly',
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
            'fechaIn' => array(
                'required' => true,
            ),
            'fechaOut' => array(
                'required' => true,
            ),
            'idEstado' => array(
                'required' => true,
            ),
            'cantidadAdulto' => array(
                'required' => true,
            ),
            'cantidadMenor' => array(
                'required' => true,
            ),
            'total' => array(
                'required' => true,
            ),
            'descuento' => array(
                'required' => true,
            ),
            'totalReserva' => array(
                'required' => true,
            ),
        );
    }

}