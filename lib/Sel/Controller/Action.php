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
    
    public function __construct()
    {
        $this->view = new View();
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
        $request = $this->get_request();
        $module = $module == null ? $request->get_module_name() : $module;
        $controller = $controller == null ? $request->get_controller_name() : $controller;

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

        header('Location: ' . $request->domain() . '/?' . $module . $controller . $action . $paramsString);
        exit;
    }

    /**
     *
     * @return Sel/Request
     */
    public function get_request()
    {
        return Front::instance()->get_request();
    }

    /**
     *
     * @param String $paramName
     * @param mixed $defaultValue
     * @return mixed
     */
    public function get_param($paramName, $defaultValue = null)
    {
        return $this->get_request()->get_param($paramName, $defaultValue);
    }

    public function render($action, $controller = null, $module = null)
    {
        $request = $this->get_request();
        
        Content::$module_name = $module == null ? $request->get_module_name() : $module;
        Content::$controller_name = $controller == null ? $request->get_controller_name() : $controller;
        Content::$action_name = $action;
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