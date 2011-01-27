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
    private $_controllerName;
    /**
     *
     * @var String
     */
    private $_moduleName;
    /**
     *
     * @var String
     */
    private $_actionName;
    /**
     *
     * @var array
     */
    private $_params;

    public function __construct() {
        $action = array_pop(array_keys($_GET));
        $exploded = explode('/', $action);

        $this->_moduleName = isset($exploded[0]) && !empty($exploded[0]) ? $exploded[0] : 'default';
        $this->_controllerName = isset($exploded[1]) && !empty($exploded[1]) ? $exploded[1] : 'index';
        $this->_actionName = isset($exploded[2]) && !empty($exploded[2]) ? $exploded[2] : 'index';

        $params = \array_slice($exploded, 3);

        $this->_params = array();

        for ($i = 0; $i < count($params); $i++) {
            if ($i % 2 == 0)
                $key = $params[$i];
            else
                $this->_params[$key] = $params[$i];
        }

        $this->_params = \array_merge($this->_params, $_POST);
    }

    /**
     *
     * @param String $paramName
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getParam($paramName, $defaultValue = null) {
        if (isset($this->_params[$paramName]) && !empty($this->_params[$paramName]))
            return $this->_params[$paramName];

        return $defaultValue;
    }

    /**
     *
     * @return array
     */
    public function getPost() {
        return \is_array($_POST) ? $_POST : array();
    }

    /**
     *
     * @return Boolean
     */
    public function isPost() {
        return!empty($_POST);
    }

    public function currentURL()
    {
         return $this->domain() . $_SERVER["REQUEST_URI"];
    }

    /**
     *
     * @return String
     */
    public function domain() {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"];
        }
        return $pageURL;
    }

    /**
     *
     * @return String
     */
    public function getModuleName() {
        return $this->_moduleName;
    }

    /**
     *
     * @return String
     */
    public function getControllerName() {
        return $this->_controllerName;
    }

    /**
     *
     * @return String
     */
    public function getActionName() {
        return $this->_actionName;
    }

}