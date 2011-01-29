<?php

namespace Sel\View\Helper;

use Sel\View\HelperAbstract;

/**
 * Hidden
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Hidden extends HelperAbstract
{

    public function direct($model_name, $field_name)
    {
        $view = $this->get_view();
        $out = '<input id="' . $model_name . '-' . $field_name . '"'
            . 'name="' . $model_name . '[' . $field_name . ']"'
            . 'type="hidden"';

        if( isset($view->$model_name) && isset($view->$model_name->$field_name) )
        {
            $out .= ' value="' . $view->$model_name->$field_name .'"';
        }

        $out .= '/>';

        return $out;
    }

}