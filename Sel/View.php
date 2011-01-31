<?php
namespace Sel;
use Sel\Controller\Action;

/**
 * View
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class View
{

    /**
     *
     * @var String
     */
    private $theme;

    /**
     *
     * @var String
     */
    private $script;

    /**
     *
     * @var String
     */
    private $module_name;

    /**
     *
     * @var String
     */
    private $controller_name;

    /**
     *
     * @var String
     */
    private $action_name;


    /**
     *
     * @var Sel\Controller\Action
     */
    private $controller;


    public function __construct(Action $controller)
    {
        $this->controller = $controller;
        $this->theme = 'default';
        $this->script = lcfirst($controller->get_request()->get_module_name()) . '/layout.phtml';
    }

    /**
     *
     * @return Sel\Controller\Action
     */
    public function get_controller()
    {
        return $this->controller;
    }


    /**
     *
     * @return String
     */
    public function get_theme()
    {
        return $this->theme;
    }

    /**
     * Path to the script that will gonna be rendered
     * 
     * @param String $script
     */
    public function set_script($script)
    {
        $this->script = $script;
    }

    /**
     * Path to the script that will gona be rendered
     *
     * @return String
     */
    public function get_script()
    {
        return $this->script;
    }

    /**
     * renders the $this->script file
     * 
     * @param String $script
     * @return String
     */
    public function render($script = null)
    {
        $script = $script == null ? $this->script : $script;

        ob_start();

        require 'themes/' . lcfirst($this->theme) . '/' . $script;

        $out = ob_get_contents();
        ob_get_clean();

        return $out;
    }

    /**
     *  Method for calling the helpers;
     *
     * @param String $name
     * @param array $arguments
     * @return String
     */
    public function __call($name, $arguments)
    {
        $full_helper_name = 'Sel\View\Helper\\' . \ucfirst($name);

        if( \class_exists($full_helper_name) )
        {
            $helper = new $full_helper_name($this);

            return \call_user_func_array(array($helper, 'direct'), $arguments);
        }
        return null;
    }

}