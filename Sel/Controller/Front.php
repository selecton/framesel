<?php
namespace Sel\Controller;
use Sel\Request;

/**
 * Front
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Front
{

    /**
     *
     * @var Sel\Request
     */
    private $request;

    /**
     *
     * @var Sel\Controller\Front
     */
    static private $instance;

    private $first_run = true;

    protected function  __construct()
    {
        $this->request = new Request();
    }

    /**
     *
     * @return Sel\Controller\Front
     */
    static public function instance()
    {
        if( self::$instance === null )
            self::$instance = new Front();
        return self::$instance;
    }

    /**
     *
     * @return Sel\Request
     */
    public function get_request()
    {
        return $this->request;
    }

    /**
     *
     * @return String
     */
    public function run($module = null, $controller = null, $action = null, $params = array())
    {
        $module = $module == null ? $this->request->get_module_name() : $module;
        $controller = $controller == null ? $this->request->get_controller_name() : $controller;
        $action = $action == null ? $this->request->get_action_name() : $action;

        $full_controller_name = 'Modules\\'
                . ucfirst($module) . '\\'
                . ucfirst($controller) . 'Controller';

        $full_action_name = $action . '_action';

        $request = clone $this->request;
        $request->set_module_name($module);
        $request->set_controller_name($controller);
        $request->set_action_name($action);
        $request->add_params($params);

        $controllerObj = new $full_controller_name($request);
        $controllerObj->$full_action_name();

        $view = $controllerObj->get_view();
        
        if( $this->first_run )
        {
            $this->first_run = false;
            return $view->render();
        }
        else
        {
            return $view->content();
        }

        
    }

}