<?php

namespace Sel\View\Helper;

use Sel\View\HelperAbstract;

/**
 * Url
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Url extends HelperAbstract
{

    public function direct($module, $controller, $action, $params = array())
    {
        $out = '/?' . $module . '/' . $controller . '/' . $action;

        foreach($params as $key=>$val)
        {
            $out .= '/' . $key . '/' . $val;
        }

        return $out;

    }

}