<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 09/01/2015
 * Time: 02:13 AM
 */

namespace Reserva\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement as ZendFormElement;

class FormElement extends ZendFormElement {
    /**
     * Render element by type map
     *
     * @param ElementInterface $element
     * @return string|null
     */
    protected function renderType(ElementInterface $element)
    {
        $this->addType('autocomplete','formJqueryAutocomplete');

        return parent::renderType($element);
    }

}