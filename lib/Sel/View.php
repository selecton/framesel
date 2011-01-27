<?php
namespace Sel;
use Sel\Controller\Front;

/**
 * View
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class View
{

    private $_theme;

    /**
     *
     * @var String
     */
    private $_layoutScript;

    /**
     *
     * @var String
     */
    private $_moduleName;

    /**
     *
     * @var String
     */
    private $_controllerName;

    /**
     *
     * @var String
     */
    private $_actionName;


    public function __construct()
    {
        $this->_theme = 'default';
        $this->_layoutScript = 'Themes/' . ucfirst($this->_theme) . '/' . ucfirst($this->getModuleName()) . '/layout.phtml';
    }

     /**
     *
     * @param String $script
     */
    public function setLayoutScript($script)
    {
        $this->_layoutScript = $script;
    }

    /**
     *
     * @return String
     */
    public function getLayoutScript()
    {
        return $this->_layoutScript;
    }

    public function renderLayout()
    {
        return $this->render($this->_layoutScript);
    }

    /**
     *
     * @param String $script
     * @return String
     */
    public function render($script)
    {
        ob_start();

        require $script;

        $out = ob_get_contents();
        ob_get_clean();

        return $out;
    }

    public function content()
    {
        $request = Front::getInstance()->getRequest();
        
        return $this->render( 'Themes/'
                . ucfirst($this->_theme) . '/'
                . ucfirst( $this->getModuleName() ) .'/'
                . $this->getControllerName() . '-' . $this->getActionName() . '.phtml');
    }

    /**
     *
     * @param String $module
     */
    public function setModuleName($module)
    {
        $this->_moduleName = $module;
    }

    /**
     *
     * @return String
     */
    public function getModuleName()
    {
        if( $this->_moduleName == null )
        {
            return Front::getInstance()->getRequest()->getModuleName();
        }
        return $this->_moduleName;
    }

    /**
     *
     * @param String $controller
     */
    public function setControllerName($controller)
    {
        $this->_controllerName = $controller;
    }

    /**
     *
     * @return String
     */
    public function getControllerName()
    {
        if( $this->_controllerName == null )
        {
            return Front::getInstance()->getRequest()->getControllerName();
        }
        return $this->_controllerName;
    }

    /**
     *
     * @param String $action 
     */
    public function setActionName($action)
    {
        $this->_actionName = $action;
    }

    /**
     *
     * @return String
     */
    public function getActionName()
    {
        if( $this->_actionName == null )
        {
            return Front::getInstance()->getRequest()->getActionName();
        }
        return $this->_actionName;
    }

    public function __call($name, $arguments)
    {
        $fullHelperName = 'Sel\View\Helper\\' . \ucfirst($name);

        if( \class_exists($fullHelperName) )
        {
            $helper = new $fullHelperName($this);

            return \call_user_func_array(array($helper, 'direct'), $arguments);
        }
        return null;
    }

}