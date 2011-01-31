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

    public function direct() {
        $view = $this->get_view();
        $request = $view->get_controller()->get_request();

        if (!isset($view->content_script)) {
            $view->content_script = $request->get_module_name() . '/'
                    . $request->get_controller_name() . '-'
                    . $request->get_action_name()
                    . '.phtml';
        }

        return $view->render($view->content_script);
    }

}