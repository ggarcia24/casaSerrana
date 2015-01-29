<?php

namespace FacturaScriptBridge\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use \raintpl as raintpl;
use \fs_controller as fs_controller;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        //echo getcwd();
        chdir('module/FacturaScriptBridge/src/facturascripts');
        $_GET = $this->params()->fromQuery();
        $_POST = $this->params()->fromPost();
        $_REQUEST = array_merge_recursive($_GET,$_POST);
        if( !file_exists('config.php') )
        {
            header('Location: install.php');
        }
        else
        {
            /// cargamos las constantes de configuración
            require_once 'config.php';
            require_once 'base/config2.php';

            require_once 'base/fs_controller.php';
            require_once 'raintpl/rain.tpl.class.php';

            /// Cargamos la lista de plugins activos
            $GLOBALS['plugins'] = array();
            if( file_exists('tmp/enabled_plugins') )
            {
                foreach( scandir(getcwd().'/tmp/enabled_plugins') as $f)
                {
                    if( is_string($f) AND strlen($f) > 0 AND !is_dir($f) )
                    {
                        if( file_exists('plugins/'.$f) )
                        {
                            $GLOBALS['plugins'][] = $f;
                        }
                        else
                            unlink('tmp/enabled_plugins/'.$f);
                    }
                }
            }

            /// ¿Qué controlador usar?
            if( isset($_GET['page']) )
            {
                /// primero buscamos en los plugins
                $found = FALSE;
                foreach($GLOBALS['plugins'] as $plugin)
                {
                    if( file_exists('plugins/'.$plugin.'/controller/'.$_GET['page'].'.php') )
                    {
                        require_once 'plugins/'.$plugin.'/controller/'.$_GET['page'].'.php';
                        $_GET['page'] = '\\'.$_GET['page'];
                        $fsc = new $_GET['page']();
                        $found = TRUE;
                        break;
                    }
                }

                if( !$found )
                {
                    if( file_exists('controller/'.$_GET['page'].'.php') )
                    {
                        require_once 'controller/'.$_GET['page'].'.php';
                        $_GET['page'] = '\\'.$_GET['page'];
                        $fsc = new $_GET['page']();
                    }
                    else {
                        $fsc = new fs_controller();
                    }
                }
            }
            else
            {
                $fsc = new fs_controller();
                $fsc->select_default_page();
            }

            if($fsc->template)
            {
                /// configuramos rain.tpl
                raintpl::configure('base_url', NULL);
                raintpl::configure('tpl_dir', 'view/');
                raintpl::configure('path_replace', FALSE);

                /// ¿Se puede escribir sobre la carpeta temporal?
                if( is_writable('tmp') )
                {
                    raintpl::configure('cache_dir', 'tmp/');
                }
                else
                {
                    echo '<center>'
                        . '<h1>No se puede escribir sobre la carpeta tmp de FacturaScripts</h1>'
                        . '<p>Consulta la <a target="_blank" href="http://www.facturascripts.com/community/item.php?id=5215f20918c088832df79fe9">documentaci&oacute;n</a>.</p>'
                        . '</center>';
                    die('<center><iframe src="http://www.facturascripts.com/community/item.php?id=5215f20918c088832df79fe9" width="90%" height="800"></iframe></center>');
                }

                $tpl = new RainTPL();
                $tpl->assign('fsc', $fsc);
                $tpl->assign('page', $_GET['page']);

                if( isset($_POST['user']) )
                    $tpl->assign('nlogin', $_POST['user']);
                else if( isset($_GET['nlogin']) )
                    $tpl->assign('nlogin', $_GET['nlogin']);
                else if( isset($_COOKIE['user']) )
                    $tpl->assign('nlogin', $_COOKIE['user']);
                else
                    $tpl->assign('nlogin', '');

            }
        }
        if(isset($tpl) && isset($fsc)) {
            $view =  new ViewModel(array(
                'tpl' => $tpl,
                'fsc' => $fsc
            ));
            if(strpos($fsc->template, 'ajax') !== false) {
               $view->setTerminal(true);
            }
            return $view;
        } else {
            $view = new ViewModel();
            $view->setTerminal(true);
            return $view;
        }
    }
}

