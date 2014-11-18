<?php
namespace Cliente\Form;

 use Zend\Form\Form;
  use Zend\Form\Element;

 class ClienteForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('cliente');

        $form = new Form('my-form');

        $this->add(array(
            'name' => 'idCliente',
            'type' => 'Hidden',
        )); 
        
         $this->add(array(
            'name' => 'apellido',
            'options' => array(
                'label' => 'Apellido *',
            ),
            'attributes' =>array(
            'required' => 'required',
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'nombre',
            'options' => array(
                'label' => 'Nombre *',
            ),
            'attributes' =>array(
            'required' => 'required',
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'direccion',
            'options' => array(
                'label' => 'Domicilio',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'telefonoFijo',
            'options' => array(
                'label' => 'Teléfono Fijo',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '30',
            ),
        ));

        $this->add(array(
            'name' => 'telefonoCelular',
            'options' => array(
                'label' => 'Teléfono Celular',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '50',
            ),
        ));
     

        $this->add(array(
        'type' => 'Zend\Form\Element\Select',
        'name' => 'tipoDocumento',
        'options' => array(
                            'label' => 'Tipo de Documento',        
                            ),
        'attributes' => array(
                            'class' => 'form-control',
        'options' => array(
                            'DNI' => 'DNI, Documento Nacional de Identidad ',
                            'CI' => 'CI, Cedula de Identidad',
                            'LB' => 'LB, Libreta Cívica',
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
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '15',
            ),
        ));

        $this->add(array(
            'name' => 'idBancoPorCliente',
            'options' => array(
                'label' => 'Id Banco por Cliente',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '10',
            ),
        ));

        $this->add(array(
            'name' => 'email',            
            'options' => array(
            'label' => 'Email'
            ),
            'attributes' =>array(            
            'class' => 'form-control',
        ),
        ));


 $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'titular',
            'options' => array(
                'label' => 'Es Titular',
                'value_options' => array(
                    '0' =>'No',
                    '1' =>'Si',

                ),
            ),
            'attributes' => array(
                'value' => '0' //set checked to '1'
            )
        ));
 
        $this->add(array(
            'name' => 'idAlimentoEspecial',
            'options' => array(
                'label' => 'Id Alimento Especial',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '10',
            ),
        ));

        $this->add(array(
            'name' => 'codigoPostal',
            'options' => array(
                'label' => 'Codigo Postal',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '6',
            ),
        ));

        $this->add(array(
            'name' => 'idTarjetaPorCliente',

            'options' => array(
                'label' => 'Tarjeta',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'id'    => 'tarjeta',

            'maxlength' => '16',
            ),
        ));

        $this->add(array(
            'name' => 'fechaNacimiento',
            'options' => array(
                'label' => 'Fecha Nacimiento',
            ),
            'attributes' =>array(
            'type'  => 'date',
            'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'idPadronAfiliado',
            'options' => array(
                'label' => 'Padron',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '10',
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
 }