<?php
namespace Reserva\Form;

 use Zend\Form\Form;
  use Zend\Form\Element;

 class ReservaForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('reserva');

        
         
   
         $this->add(array(
            'name' => 'numeroHabitacion',
            'options' => array(
                'label' => 'Número Habitación:',
            ),
            'attributes' =>array(
            'required' => 'required',
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '10',
            'disabled' => 'disabled',
            ),
        ));

        $this->add(array(
            'name' => 'pabellon',
            'options' => array(
                'label' => 'Pabellon:',
            ),
            'attributes' =>array(
            'required' => 'required',
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '50',
            'disabled' => 'disabled',
            ),
        ));

        $this->add(array(
            'name' => 'fechaIngreso',
            'options' => array(
                'label' => 'Fecha de Ingreso:',
            ),
            'attributes' =>array(
            'type'  => 'date',
            'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'fechaSalida',
            'options' => array(
                'label' => 'Fecha de Salida:',
            ),
            'attributes' =>array(
            'type'  => 'date',
            'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'nombreReserva',
            'options' => array(
                'label' => 'Nombre de la Reserva:',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '50',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'estadoReserva',
            'options' => array(
                    'label' => 'Estado Reserva:',
                    'empty_option' => 'Seleccione....',
                    'value_options' => array(
                            '1' => 'Sin Señar',
                            '2' => 'Señada',
                            '3' => 'Pagada',

                    ),
                    
           ),
            'attributes' =>array(
            'class' => 'form-control',
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
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
            'label' => 'Email'
            ),
            'attributes' =>array(            
            'class' => 'form-control',
            'maxlength' => '60',
        ),
        ));
       
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'tipoConvenio',
            'options' => array(
                    'label' => 'Tipo de Convenio',
                    'empty_option' => 'Seleccione....',
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
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'titular',
            'options' => array(
                'label' => 'Media Pensión',
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
            'name' => 'cantidadAdulto',
            'options' => array(
                'label' => 'Cantidad Adultos:',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '10',
            ),
        ));
/*
        $this->add(array(
            'type' => 'Zend\Form\Element\Range',
            'type' => 'Range',
             'name' => 'cantidadAdulto',
            'options' => array(
             'label' => 'Cantidad Adultos'
     ),
     'attributes' => array(
             'min' => 0, // default minimum is 0
             'max' => 10, // default maximum is 100
             'step' => 1 // default interval is 1
     )
 ));
 */

        $this->add(array(
            'name' => 'cantidadMenor',
            'options' => array(
                'label' => 'Menores de 5:',
            ),
            'attributes' =>array(
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '10',
            ),
        ));

     


        $this->add(array(
            'name' => 'huesped',
            'options' => array(
            'label' => 'Agregar Huéspedes'
            ),
            'attributes' =>array(            
            'class' => 'form-control',
            'maxlength' => '60',
        ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\TextArea',    
            'name' => 'huespedes',
            'options' => array(
            'label' => 'Lista Huespedes'
            ),
            'attributes' =>array(            
            'class' => 'form-control',
            'rows' => '6',
        ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\TextArea',    
            'name' => 'comentario',
            'options' => array(
            'label' => 'Comentarios:'
            ),
            'attributes' =>array(            
            'class' => 'form-control',
            'rows' => '6',
        ),
        ));

 

        
         $this->add(array(
            'name' => 'total',
            'options' => array(
            'label' => 'Total:'
            ),
            'attributes' =>array(            
            'class' => 'form-control',
            'maxlength' => '60',
            'disabled' => 'disabled',
        ),
        ));
          $this->add(array(
            'name' => 'descuento',
            'options' => array(
            'label' => 'Descuento'
            ),
            'attributes' =>array(            
            'class' => 'form-control',
            'maxlength' => '60',
        ),
        ));
           $this->add(array(
            'name' => 'totalReserva',
            'options' => array(
            'label' => 'Total Reserva:'
            ),
            'attributes' =>array(            
            'class' => 'form-control',
            'maxlength' => '60',
            'disabled' => 'disabled',
        ),
        ));




       

        $this->add(array(
            'name' => 'agregarHuesped',            
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Agregar Huésped',
                'class' => 'btn btn-warning',
            ),
        ));

        $this->add(array(
            'name' => 'borrarHuesped',            
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Borrar Huésped',
                'class' => 'btn btn-warning',
            ),
        ));
        $this->add(array(
            'name' => 'grabarReserva',            
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Grabar Reserva',
                'class' => 'btn btn-warning',
            ),
        ));

        $this->add(array(
            'name' => 'generarPago',            
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Generar Pago',
                'class' => 'btn btn-warning',
            ),
        ));
        $this->add(array(
            'name' => 'imprimir',            
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Imprimir',
                'class' => 'btn btn-warning',
            ),
        ));

        $this->add(array(
            'name' => 'cancelar',            
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Cancelar',
                'class' => 'btn btn-warning',
            ),
        ));








     }
 }