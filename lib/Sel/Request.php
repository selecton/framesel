<?php
namespace Sel;

/**
 * Request
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Request
{

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

    public function  __construct() {
        $action = array_pop(array_keys($_GET));
        $exploded = explode('/', $action);

        $this->_moduleName = isset($exploded[0]) && !empty($exploded[0]) ? $exploded[0] : 'default';
        $this->_controllerName = isset($exploded[1]) && !empty($exploded[1]) ? $exploded[1] : 'index';
        $this->_actionName = isset($exploded[2]) && !empty($exploded[2]) ? $exploded[2] : 'index';

        $params = \array_slice($exploded, 3);

        $this->_params = array();
        
        for($i = 0; $i < count($params); $i++)
        {
            if( $i%2 == 0 )
                $key = $params[$i];
            else
                $this->_params[$key] = $params[$i];
        }

        $this->_params = \array_merge($this->_params, $_POST);
    }

    public function getParam($paramName, $defaultValue = null)
    {
        if( isset($this->_parama[$paramName]) && !empty($this->_params[$paramName]) )
            return $this->_params[$paramName];

        return $defaultValue;
    }

    public function getPost()
    {
        return \is_array($_POST) ? $_POST : array();
    }

    /**
     *
     * @return Boolean
     */
    public function isPost()
    {
        return !empty($_POST);
    }

    /**
     *
     * @return String
     */
    public function getModuleName()
    {
        return $this->_moduleName;
    }

    /**
     *
     * @return String
     */
    public function getControllerName()
    {
        return $this->_controllerName;
    }

    /**
     *
     * @return String
     */
    public function getActionName()
    {
        return $this->_actionName;
    }

}