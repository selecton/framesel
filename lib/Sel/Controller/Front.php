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
    private $_request;

    /**
     *
     * @var Sel\Controller\Front
     */
    static private $_instance;

    /**
     *
     * @return Sel\Controller\Front
     */
    static public function getInstance()
    {
        if (self::$_instance == null)
            self::$_instance = new Front();
        return self::$_instance;
    }

    private function  __construct()
    {
        $this->_request = new Request();
    }

    /**
     *
     * @return Sel\Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     *
     * @return String
     */
    public function run()
    {
        $fullControllerName = 'Modules\\'
                . ucfirst($this->_request->getModuleName()) . '\\'
                . ucfirst($this->_request->getControllerName()) . 'Controller';

        $fullActionName = $this->_request->getActionName() . 'Action';
        $controller = new $fullControllerName();

        $controller->$fullActionName();

        return $controller->getView()->renderLayout();
    }

}