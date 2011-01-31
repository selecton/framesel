<?php
namespace Sel\Controller;

use Sel\View;
use Sel\Request;
use Sel\Controller\Front;
use Sel\View\Helper\Content;

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
    protected $view;

    /**
     * @var Sel\Request
     */
    private $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->view = new View($this);
        $this->init();
    }

    /**
     * Override this method
     */
    protected function init()
    {
        
    }

    /**
     * changing location to $_SERVER['HTTP_REFERER']
     */
    public function go_back()
    {
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        header('Location: ' . $referer);
        exit;
    }

    /**
     *
     * @param String $action
     * @param String $controller
     * @param String $module
     * @param array $params
     */
    protected function redirect($action, $controller = null, $module = null, $params = array())
    {
        $module = $module == null ? $this->request->get_module_name() : $module;
        $controller = $controller == null ? $this->request->get_controller_name() : $controller;

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

        header('Location: ' . $this->request->domain() . '/?' . $module . $controller . $action . $paramsString);
        exit;
    }

    /**
     *
     * @return Sel/Request
     */
    public function get_request()
    {
        return $this->request;
    }

    /**
     *
     * @param String $paramName
     * @param mixed $defaultValue
     * @return mixed
     */
    public function get_param($paramName, $defaultValue = null)
    {
        return $this->request->get_param($paramName, $defaultValue);
    }

    public function render($action, $controller = null, $module = null)
    {
        $controller = $controller == null ? $this->request->get_controller_name() : $controller;
        $module = $module == null ? $this->request->get_module_name() : $module;

        $this->view->content_script = $module . '/' . $controller . '-' . $action . '.phtml';
    }

    /**
     *
     * @return Sel\View
     */
    public function get_view()
    {
        return $this->view;
    }

}