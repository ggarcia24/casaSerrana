<?php
namespace Reserva\Form;

use Zend\Db\ResultSet\ResultSet;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\ServiceManager\ServiceLocatorInterface;

class TarifaForm extends Form {

    protected $serviceManager;

    public function __construct(ServiceLocatorInterface $sm) {

        $this->serviceManager = $sm;

        parent::__construct('tarifa');

        $this->add(array(
            'name' => 'idTarifa',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'idCategoria',
            'options' => array(
                'label' => 'Categoria:',
                'empty_option' => 'Seleccione...',
                'disable_inarray_validator' => true,
                'value_options' => $this->getCategoriaOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'idTipoHuesped',
            'options' => array(
                'label' => 'Tipo de Convenio:',
                'empty_option' => 'Seleccione...',
                'disable_inarray_validator' => true,
                'value_options' => $this->getTipoHuespedOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'monto',
            'options' => array(
                'label' => 'Monto:',
            ),
            'attributes'   => array(
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'vigencia',
            'options' => array(
                'label' => 'Vigencia:',
            ),
            'attributes'   => array(
                'type' => 'date',
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Enviar',
                'class' => 'btn btn-warning',
            ),
        ));
    }

    private function getCategoriaOptions() {
        $categoriaTable = $this->serviceManager->get('Reserva\Model\CategoriaTable');
        $categorias = $categoriaTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($categorias)->toArray();
    }

    private function getTipoHuespedOptions() {
        $convenioTable = $this->serviceManager->get('Cliente\Model\ConvenioTable');
        $convenios = $convenioTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($convenios)->toArray();
    }
}