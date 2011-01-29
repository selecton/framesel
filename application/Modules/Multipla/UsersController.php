<?php
namespace Modules\Multipla;

use Sel\Controller\Action;

/**
 * UsersController
 *
 * @author Szymon Wygnański
 */
class UsersController extends Action
{

    protected function init()
    {
        $this->view->set_script('multipla/layout_main.phtml');
    }

    public function add_action()
    {
        $this->render('edit');
    }

    public function edit_action()
    {

    }

    public function save_action()
    {
        $this->render('edit');
    }

}