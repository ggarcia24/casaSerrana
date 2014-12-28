<?php
namespace Cliente\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cliente\Model\Cliente;
use Cliente\Model\ClienteTable;
use Cliente\Form\ClienteForm;
use Zend\View\Model\JsonModel;

class ClienteController extends AbstractActionController {
    protected $clienteTable;

    public function indexAction() {
        /* @var ClienteTable $clienteTable */
        $clienteTable = $this->getClienteTable();
        if (!$this->getRequest()->isXmlHttpRequest()) {
            return new ViewModel(array(
                 'clientes' => $clienteTable->fetchAll()
            ));
        } else {
            $term = $this->getRequest()->getQuery('term', '');
            $clientesBuscados = $clienteTable->findByTerm($term);
            $res = array();
            foreach ($clientesBuscados as $clienteBuscado) {
                $res[] = array(
                    'label' => $clienteBuscado["nombre"] . ' ' . $clienteBuscado["apellido"],
                    'value' => $clientesBuscados
                );
            }
            $result = new JsonModel($res);
            return $result;
        }
    }

    public function addAction() {
        $cliente = new Cliente();
        $form = new ClienteForm($this->getServiceLocator());
        $form->bind($cliente);
        $form->get('send')->setValue('Agregar');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($cliente->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                try {
                    $this->getClienteTable()->saveCliente($cliente);
                } catch (\Exception $ex)  {
                    $this->flashMessenger()->addMessage('Documento Existente, Ingrese otro Documento');
                    return $this->redirect()->toRoute('cliente', array('action' => 'edit'));
                }
                $this->getClienteTable()->saveCliente($cliente);
                //viendo tarjetas
//                 $tarjetaPorCliente= new TarjetaPorCliente();
//                 $tarjetaPorCliente->exchangeArray($form->getData());
//                 $i=1;
//                 while($i <= 10)
//                 {
//                     $this->getTarjetaTable()->saveTarjeta($tarjetaPorCliente);
//                     $i++;
//                     
//                 }
            }
        }

        return array(
            'form' => $form,
            'flashMessages' => $this->flashMessenger()->getMessages(),
        );
    }

    public function editAction() {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cliente', array(
                'action' => 'add'
            ));
        }
        // Get the Album with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $cliente = $this->getClienteTable()->getCliente($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('cliente', array(
                'action' => 'index'
            ));
        }
        $form = new ClienteForm($this->getServiceLocator());
        $form->bind($cliente);
        $form->get('send')->setAttribute('value', 'Edit');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($cliente->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                try {
                    $this->getClienteTable()->saveCliente($cliente);
                } catch (\Exception $ex)  {
                    $this->flashMessenger()->addMessage('Documento Existente, Ingrese otro Documento');
                    return $this->redirect()->toRoute('cliente', array('action' => 'edit'));
                }
               return $this->redirect()->toRoute('cliente');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
            'flashMessages' => $this->flashMessenger()->getMessages(),
        );
    }

    public function deleteAction() {
        $id = (int)$this->params()->fromRoute("id", 0);
        $this->getClienteTable()->deleteCliente($id);
        return $this->redirect()->toRoute('cliente', array('controler' => 'cliente', 'action' => 'index'));
    }

    public function getClienteTable() {
        if (!$this->clienteTable) {
            $sm = $this->getServiceLocator();
            $this->clienteTable = $sm->get('Cliente\Model\ClienteTable');
        }
        return $this->clienteTable;
    }

}