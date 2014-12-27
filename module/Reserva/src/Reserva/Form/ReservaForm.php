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
            //'required' => 'required',
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '10',
            'disabled' => 'disabled',
            ),
        ));

         $this->add(array(
            'name' => 'idHabitacion',
            'type' => 'Hidden',
        ));
         
        $this->add(array(
            'name' => 'idCliente',
            'type' => 'Hidden',
            'attributes' => array(
            'id' => 'idCliente'    
            ),
            
        )); 

        $this->add(array(
            'name' => 'pabellon',
            'options' => array(
                'label' => 'Pabellon:',
            ),
            'attributes' =>array(
            //'required' => 'required',
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
            'name' => 'idEstado',
            'options' => array(
                    'label' => 'Estado Reserva:',
                    //'empty_option' => 'Seleccione....',

                    
           ),
            'attributes' =>array(
            'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'telefono',
            'options' => array(
                'label' => 'Teléfono',
            ),
            'attributes' =>array(
            'id'   => 'telefono',
            'type'  => 'text',
            'class' => 'form-control',
            'maxlength' => '50',
            'disabled' => 'disabled',
            ),
        ));

        $this->add(array(
            //'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
            'label' => 'Email'
            ),
            'attributes' =>array(
            'id'   => 'email',    
            'class' => 'form-control',
            'maxlength' => '60',
            'disabled' => 'disabled',
        ), 
        ));
       
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'idTipoHuesped',
            'options' => array(
                    'label' => 'Tipo de Convenio',
                    'empty_option' => ' ',
                    
           ),
            'attributes' =>array(
                'class' => 'form-control',
                'id'    => 'idTipoHuesped',
                'disabled' => 'disabled',
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
            'id'    =>  'cantidadAdulto',
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
            'name' => 'nombreHuesped',
            'options' => array(
            'label' => 'Nombre Completo'
            ),
            'attributes' =>array(            
                'class'     => 'form-control',
                'maxlength' => '100',
                'id'        => 'nombreHuesped',
        ),
        ));

        $this->add(array(
            'name' => 'documentoHuesped',
            'options' => array(
            'label' => 'Documento'
            ),
            'attributes' =>array(
                'class'     => 'form-control',
                'maxlength' => '60',
                'id'        => 'documentoHuesped',
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
            'disabled' => 'disabled',
        ),
        ));
           $this->add(array(
            'name' => 'totalReserva',
            'options' => array(
            'label' => 'Total Reserva:'
            ),
            'attributes' =>array(      
            'id'    =>  'totalReserva',
            'class' => 'form-control',
            'maxlength' => '60',
            'disabled' => 'disabled',
        ),
        ));

        $this->add(array(
            'name' => 'grabarReserva',            
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Grabar Reserva',
                'class' => 'btn btn-success',
            ),
        ));

// Defino los campos para jquery

        $this->add(array(
            'name' => 'autocomplete',
            'type' => 'ZfSnapJquery\Form\Element\Autocomplete', 
            'options' => array(
            'label' => 'Nombre Reserva:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'jquery' => array(
       
                    'source' => '/casaserrana/public/cliente',
                    'focus' => new \Zend\Json\Expr('function( event, ui ) { $( "#autocomplete" ).val( ui.item.label ); return false; }'),
                    'select' => new \Zend\Json\Expr('function( event, ui ) { $( "#email" ).val( ui.item.email ); $( "#telefono" ).val( ui.item.telefono);$( "#idTipoHuesped" ).val( ui.item.idPadronAfiliado); $( "#idCliente" ).val( ui.item.cliente ); return false; }'),
                    
                                 ),
            )
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