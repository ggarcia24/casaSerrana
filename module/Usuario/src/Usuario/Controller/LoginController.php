<?php
namespace Usuarios\Controller;
use Zend\Mvc\Controller\AbstractActionController; use Zend\View\Model\ViewModel;
use Usuarios\Form\Login;
use Usuarios\Form\LoginValidator;
use Usuarios\Model\Login as LoginService;

class LoginController extends AbstractActionController 
{
    private $login;
    
    public function setLogin(LoginService $login) 
    {
        $this->login = $login; 
    }

}    