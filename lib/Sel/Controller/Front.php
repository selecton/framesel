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
    public function run()
    {
        $full_controller_name = 'Modules\\'
                . ucfirst($this->request->get_module_name()) . '\\'
                . ucfirst($this->request->get_controller_name()) . 'Controller';

        $full_action_name = $this->request->get_action_name() . '_action';
        $controller = new $full_controller_name();

        $controller->$full_action_name();

        return $controller->get_view()->render();
    }

}