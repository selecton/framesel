<?php
namespace Sel\View\Helper;

use Sel\View\HelperAbstract;
use Sel\Controller\Front;

/**
 * Action
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Action extends HelperAbstract
{

    public function direct($action, $controller = null, $module = null, $params = array())
    {
        return Front::instance()->run($module, $controller, $action, $params);
    }

}