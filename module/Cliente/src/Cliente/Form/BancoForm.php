<?php
namespace Cliente\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class BancoForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('banco');

        $form = new Form('my-form');

        $this->add(array(
            'name' => 'idBanco',
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