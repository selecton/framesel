<?php
namespace Sel\Controller;

use Sel\View;
use Sel\Request;
use Sel\Controller\Front;

/**
 * Action
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Action
{

    

    /**
     *
     * @var Sel\View
     */
    protected $_view;
    
    public function __construct()
    {
        $this->_view = new View();
        $moduleName = Front::getInstance()->getRequest()->getModuleName();

        

        $this->_init();
    }

    /**
     * Override this method
     */
    protected function _init()
    {
        
    }

    protected function _redirect($action, $controller = null, $module = null, $params = array())
    {
        $module = $module == null ? $this->getRequest()->getModuleName() : $module;
        $controller = $controller == null ? $this->getRequest()->getControllerName() : $controller;

        if( $module == 'default' )
            $module = '';

        if( $controller == 'index' )
            $controller = '';
        else
            $controller = '/' . $controller;

        if( $action == 'index' )
            $action = '';
        else
            $action = '/' . $action;

        $paramsString = '';
        foreach($params as $key=>$val)
        {
            $paramsString .= '/' . $key . '/' . $val;
        }

        header('Location: /?' . $module . $controller . $action . $paramsString);
        exit;
    }

    /**
     *
     * @return Sel/Request
     */
    public function getRequest()
    {
        return Front::getInstance()->getRequest();
    }

    public function getParam($paramName, $defaultValue = null)
    {
        return Front::getInstance()->getRequest()->getParam($paramName, $defaultValue);
    }

    public function render($action, $controller = null, $module = null)
    {
        $this->_view->setActionName($action);
        $this->_view->setControllerName($controller);
        $this->_view->setModuleName($module);
    }


    /**
     *
     * @return Sel\View
     */
    public function getView()
    {
        return $this->_view;
    }

}