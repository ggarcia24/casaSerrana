<?php
namespace Reserva\Form;

 use Zend\Form\Form;
  use Zend\Form\Element;

 class TipohuespedForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('tipohuesped');

        $form = new Form('my-form');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        )); 
         
       

        $this->add(array(
            'name' => 'nombre',
            'options' => array(
                'label' => 'Nombre *',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '50',
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