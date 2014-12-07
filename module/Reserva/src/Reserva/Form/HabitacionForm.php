<?php
namespace Reserva\Form;

 use Zend\Form\Form;
  use Zend\Form\Element;




 class HabitacionForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('habitacion');

         $form = new Form('my-form');

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
            'type' => 'Zend\Form\Element\Select',
            'name' => 'idPabellon',
            'options' => array(
                                'label' => 'Pabellon:',
                                'empty_option' => 'Seleccione....',
                                'disable_inarray_validator' => true
                                ),
            'attributes' =>array(
                                'class' => 'form-control',
                         
                         )  

                
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
            'name' => 'idEstado',
            'options' => array(
                    'label' => 'Estado:',
                    'empty_option' => 'Seleccione....',
                    'disable_inarray_validator' => true
                    
           ),
            'attributes' =>array(
            'class' => 'form-control',
            ),
        ));



       



//BOTON
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