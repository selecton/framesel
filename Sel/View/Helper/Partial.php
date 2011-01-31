<?php
namespace Sel\View\Helper;

use Sel\View\HelperAbstract;
use Sel\View;

/**
 * Partial
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Partial extends HelperAbstract
{

    public function direct($script, $params = array())
    {
        $view = new View($this->get_view()->get_controller());
        foreach($params as $key=>$val)
        {
            $view->$key = $val;
        }
        $view->set_script($script);
        return $view->render();
    }

}