<?php
namespace Sel\View\Helper;

use Sel\View\HelperAbstract;

/**
 * ThemePath
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class ThemePath extends HelperAbstract
{

    public function direct()
    {
        return '/themes/' . $this->get_view()->get_theme();
    }

}