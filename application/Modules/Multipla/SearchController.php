<?php
namespace Modules\Multipla;

use Sel\Controller\Action;


/**
 * SearchController
 *
 * @author Szymon Wygnański
 */
class SearchController extends Action
{

    public function do_search_action()
    {
        $this->redirect('index', 'products');
    }

    public function form_action()
    {

    }

}