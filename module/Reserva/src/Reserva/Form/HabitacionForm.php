<?php

namespace Reserva\Form;

use Zend\Db\ResultSet\ResultSet;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\ServiceManager\ServiceLocatorInterface;


class HabitacionForm extends Form {

    protected $serviceManager;

    public function __construct(ServiceLocatorInterface $sm) {

        $this->serviceManager = $sm;

        // we want to ignore the name passed
        parent::__construct('habitacion');

        $this->add(array(
            'name' => 'idHabitacion',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'numero',
            'options' => array(
                'label' => 'Numero *',
            ),
            'attributes' =>array(
                'type'  => 'text',
                'class' => 'form-control',
                'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'plazaMaxima',
            'options' => array(
               'label' => 'Plazas Maximas: *',
            ),
            'attributes' =>array(
                'type'  => 'text',
                'class' => 'form-control',
                'maxlength' => '10',
            ),
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'idPabellon',
            'options' => array(
                'label' => 'Pabellon:',
                'empty_option' => 'Seleccione....',
                'disable_inarray_validator' => true,
                'value_options' => $this->getPabellonOptions()
            ),
            'attributes' =>array(
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'idCategoria',
            'options' => array(
                'label' => 'Categoria:',
                'empty_option' => 'Seleccione....',
                'disable_inarray_validator' => true,
                'value_options' => $this->getCategoriaOptions()
            ),
            'attributes' =>array(
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'idEstado',
            'options' => array(
                'label' => 'Estado:',
                'empty_option' => 'Seleccione....',
                'disable_inarray_validator' => true,
                'value_options' => $this->getEstadoOptions()
            ),
            'attributes' =>array(
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Enviar',
                'class' => 'btn btn-warning',
            ),
        ));
    }

    private function getPabellonOptions() {
        $pabellonTable = $this->serviceManager->get('Reserva\Model\PabellonTable');
        $pabellones = $pabellonTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($pabellones)->toArray();
    }

    private function getCategoriaOptions() {
        $categoriaTable = $this->serviceManager->get('Reserva\Model\CategoriaTable');
        $categorias = $categoriaTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($categorias)->toArray();
    }

    private function getEstadoOptions() {
        $estadoTable = $this->serviceManager->get('Cliente\Model\ConvenioTable');
        $estados = $estadoTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($estados)->toArray();
    }

}