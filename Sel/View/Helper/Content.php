<?php

namespace Sel\View\Helper;

use Sel\Controller\Front;
use Sel\View\HelperAbstract;

/**
 * Content
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Content extends HelperAbstract {

    /**
     *
     * @var String
     */
    static public $module_name = '';
    /**
     *
     * @var String
     */
    static public $controller_name = '';
    /**
     *
     * @var String
     */
    static public $action_name = '';


    public function direct() {
        $request = Front::instance()->get_request();

        if (empty(self::$module_name))
            self::$module_name = $request->get_module_name();

        if (empty(self::$controller_name))
            self::$controller_name = $request->get_controller_name();

        if (empty(self::$action_name))
            self::$action_name = $request->get_action_name();

        return $this->get_view()->render(
                self::$module_name . '/'
                . self::$controller_name . '-'
                . self::$action_name . '.phtml');
    }

}