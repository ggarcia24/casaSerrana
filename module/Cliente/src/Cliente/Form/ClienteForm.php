<?php
namespace Cliente\Form;

use Zend\Db\ResultSet\ResultSet;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;
use Zend\Form\Element;

class ClienteForm extends Form {

    protected $serviceManager;

    public function __construct(ServiceLocatorInterface $sm) {

        $this->serviceManager = $sm;

        // we want to ignore the name passed
        parent::__construct('cliente');

        $this->add(array(
            'name' => 'idCliente',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'apellido',
            'options' => array(
                'label' => 'Apellido *',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'nombre',
            'options' => array(
                'label' => 'Nombre *',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'direccion',
            'options' => array(
                'label' => 'Domicilio',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'localidad',
            'options' => array(
                'label' => 'Ciudad',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'idPais',
            'required' => false,
            'allow_empty' => true,
            'options' => array(
                'label' => 'Pais:',
                'empty_option' => 'Seleccione...',
                'disable_inarray_validator' => true,
                'value_options' => $this->getPaisOptions()
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'idProvincia',
            'required' => false,
            'options' => array(
                'label' => 'Provincia:',
                'empty_option' => 'Seleccione....',
                'disable_inarray_validator' => true,
                'value_options' => $this->getProvinciaOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'telefono',
            'options' => array(
                'label' => 'Teléfono',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '30',
            ),
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'tipoDocumento',
            'options' => array(
                'label' => 'Tipo de Documento',
            ),
            'attributes'   => array(
                'class'    => 'form-control',
                'options' => array(
                    'DNI' => 'DNI, Documento Nacional de Identidad ',
                    'CI' => 'CI, Cedula de Identidad',
                    'LB'  => 'LB, Libreta Cívica',
                    'LE' => 'LE, Libreta de Enrolamiento',
                ),
                'value' => 'DNI'
            )
        ));


        $this->add(array(
            'name' => 'documento',
            'options' => array(
                'label' => 'Documento',
            ),
            'attributes'   => array(
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '15',
            ),
        ));


        $this->add(array(
            'type' => 'Select',
            'name' => 'idBancoPorCliente',
            'options' => array(
                'label' => 'Banco:',
                'empty_option' => 'Seleccione....',
                'disable_inarray_validator' => true,
                'value_options' => $this->getBancoPorClienteOptions()
            ),
            'attributes'=> array(
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'Email'
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));


        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'titular',
            'options' => array(
                'label' => 'Es Titular',
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
            'type' => 'Select',
            'name' => 'idAlimentoEspecial',
            'options' => array(
                'label' => 'Alimento Especial:',
                'empty_option' => 'Seleccione...',
                'disable_inarray_validator' => true,
                'value_options' => $this->getAlimentoEspecialOptions()
            ),
            'attributes'   => array(
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'codigoPostal',
            'options' => array(
                'label' => 'Codigo Postal',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'maxlength' => '6',
            ),
        ));

        $this->add(array(
            'name' => 'idTarjetaPorCliente',
            'options' => array(
                'label' => 'Numero de Tarjeta',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'idTarjetaPorCliente',
                'maxlength' => '16',
            ),
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'tarjeta',
            'options' => array(
                'label' => 'Tarjeta:',
                'empty_option' => 'Seleccione...',
                'disable_inarray_validator' => true,
                'value_options' => $this->getTarjetaPorClienteOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));


        $this->add(array(
            'name' => 'fechaNacimiento',
            'options' => array(
                'label' => 'Fecha Nacimiento',
            ),
            'attributes'   => array(
                'type' => 'date',
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'idTipoHuesped',
            'required' => false,
            'options' => array(
                'label' => 'Tipo de Convenio:',
                'empty_option' => 'Seleccione...',
                'disable_inarray_validator' => true,
                'value_options' => $this->getTipoHuespedOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
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

    private function getBancoPorClienteOptions() {
        $bancoTable = $this->serviceManager->get('Cliente\Model\BancoTable');
        $bancos = $bancoTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($bancos)->toArray();
    }

    private function getTipoHuespedOptions() {
        $convenioTable = $this->serviceManager->get('Cliente\Model\ConvenioTable');
        $convenios = $convenioTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($convenios)->toArray();
    }

    private function getTarjetaPorClienteOptions() {
        $tarjetaTable = $this->serviceManager->get('Cliente\Model\TarjetaTable');
        $tarjetas = $tarjetaTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($tarjetas)->toArray();
    }

    private function getAlimentoEspecialOptions() {
        $alimentoTable = $this->serviceManager->get('Cliente\Model\AlimentoTable');
        $alimentos = $alimentoTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($alimentos)->toArray();
    }

    private function getPaisOptions() {
        $paisTable = $this->serviceManager->get('Cliente\Model\PaisTable');
        $paises = $paisTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($paises)->toArray();
    }

    private function getProvinciaOptions() {
        $provinciaTable = $this->serviceManager->get('Cliente\Model\ProvinciaTable');
        $provincias = $provinciaTable->fetchAllWithAlias();
        $results = new ResultSet();
        return $results->initialize($provincias)->toArray();
    }
}