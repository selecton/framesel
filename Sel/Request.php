<?php

namespace Sel;

/**
 * Request
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Request {

    /**
     *
     * @var String
     */
    private $controller_name;
    /**
     *
     * @var String
     */
    private $module_name;
    /**
     *
     * @var String
     */
    private $action_name;
    /**
     *
     * @var array
     */
    private $params;

    public function __construct() {
        $this->params = array();
        $getKeys = array_keys($_GET);
        $action = array_pop($getKeys);
        $exploded = explode('/', $action);

        $this->module_name = isset($exploded[0]) && !empty($exploded[0]) ? $exploded[0] : 'default';
        $this->controller_name = isset($exploded[1]) && !empty($exploded[1]) ? $exploded[1] : 'index';
        $this->action_name = isset($exploded[2]) && !empty($exploded[2]) ? $exploded[2] : 'index';

        $params = \array_slice($exploded, 3);

        $outParams= array();

        for ($i = 0; $i < count($params); $i++) {
            if ($i % 2 == 0)
                $key = $params[$i];
            else
                $outParams[$key] = $params[$i];
        }

        $outParams = \array_merge($this->params, $_POST);

        $this->add_params($outParams);
    }


    static public function create()
    {
        
    }

    /**
     *
     * @param String $paramName
     * @param mixed $defaultValue
     * @return mixed
     */
    public function get_param($param_name, $default_value = null) {
        if (isset($this->params[$param_name]) && !empty($this->params[$param_name]))
            return $this->params[$param_name];

        return $default_value;
    }

    public function add_params(array $params)
    {
        $this->params = \array_merge($this->params, $params);
    }

    /**
     *
     * @return array
     */
    public function get_post() {
        return \is_array($_POST) ? $_POST : array();
    }

    /**
     *
     * @return Boolean
     */
    public function is_post() {
        return!empty($_POST);
    }

    public function current_url()
    {
         return $this->domain() . $_SERVER["REQUEST_URI"];
    }

    /**
     *
     * @return String
     */
    public function domain() {
        $page_url = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $page_url .= "s";
        }
        $page_url .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $page_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
        } else {
            $page_url .= $_SERVER["SERVER_NAME"];
        }
        return $page_url;
    }

    /**
     *
     * @return String
     */
    public function get_module_name()
    {
        return $this->module_name;
    }

    /**
     *
     * @param String $module_name
     */
    public function set_module_name($module_name)
    {
        $this->module_name = $module_name;
    }

    /**
     *
     * @return String
     */
    public function get_controller_name() {
        return $this->controller_name;
    }

    /**
     *
     * @param String $controller_name
     */
    public function set_controller_name($controller_name)
    {
        $this->controller_name = $controller_name;
    }

    /**
     *
     * @return String
     */
    public function get_action_name() {
        return $this->action_name;
    }

    /**
     *
     * @param String $action_name
     */
    public function set_action_name($action_name)
    {
        $this->action_name = $action_name;
    }

}