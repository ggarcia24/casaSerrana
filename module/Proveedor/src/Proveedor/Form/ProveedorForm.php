<?php
namespace Proveedor\Form;

 use Zend\Form\Form;
  use Zend\Form\Element;

 class ProveedorForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('proveedor');

          parent::__construct('cliente');

        $form = new Form('my-form');

        $this->add(array(
            'name' => 'idProveedor',
            'type' => 'Hidden',
        )); 
        
         
         
         $this->add(array(
            'name' => 'cuit',
            'options' => array(
                'label' => 'CUIT *',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'nombreCompania',
            'options' => array(
                'label' => 'Nombre Compañia*',
            ),
            'attributes' =>array(
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
        'name' => 'provincia',
        'options' => array(
                            'label' => 'Provincia',        
                            ),
        'attributes' => array(
                            'class' => 'form-control',
        'options' => array(
                            1 => 'Cordoba',
                            2 => 'Corrientes',
                            3 => 'Buenos Aires',
                            4 => 'La Rioja',
        ),
        'value' => 1
        )
        ));

        $this->add(array(
            'name' => 'localidad',
            'options' => array(
                'label' => 'Localidad',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '15',
            ),
        ));

     

        
        $this->add(array(
            'name' => 'email',
            
            'options' => array(
            'label' => 'Email'
            ),
            'attributes' =>array(            
            'class' => 'form-control',
            'type' => 'text'
                
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
            'name' => 'nombreContacto',
            'options' => array(
                'label' => 'Nombre de Contacto',
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
 }