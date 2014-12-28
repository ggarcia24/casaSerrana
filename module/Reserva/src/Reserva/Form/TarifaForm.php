<?php
namespace Reserva\Form;

 use Zend\Form\Form;
  use Zend\Form\Element;

 class TarifaForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('tarifa');

         $this->add(array(
            'name' => 'idTarifa',
            'type' => 'Hidden',
         ));

         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'idCategoria',
             'options' => array(
                 'label' => 'Categoria:',
                 'empty_option' => 'Seleccione....',
                 'disable_inarray_validator' => true


             ),
             'attributes' =>array(
                 'class' => 'form-control',
             ),
         ));

         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'idTipoHuesped',
             'options' => array(
                 'label' => 'Tipo de Convenio',
                 //'empty_option' => 'Seleccione....',
                 'value_options' => array(
                     '1' => 'Afiliado',
                     '2' => 'Particular',
                     '3' => 'Congreso',
                 ),

             ),
             'attributes' =>array(
                 'class' => 'form-control',
             ),
         ));

         $this->add(array(
            'name' => 'monto',
            'options' => array(
                'label' => 'Monto:',
            ),
            'attributes' =>array(
                'required' => 'required',
                'type'  => 'text',
                'class' => 'form-control',
                'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'vigencia',
            'options' => array(
                'label' => 'Vigencia:',
            ),
            'attributes' =>array(
            'type'  => 'date',
            'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Submit ZfSnapJquery form!',
            ),
        ));
     }
 }