<?php
namespace Modules\Multipla;

use Sel\Controller\Action;

/**
 * IndexController
 *
 * @author Szymon Wygnański
 */
class IndexController extends Action
{

    public function index_action()
    {
        $this->view->set_script('multipla/layout_main.phtml');
    }

    public function header_action()
    {
        
    }

}