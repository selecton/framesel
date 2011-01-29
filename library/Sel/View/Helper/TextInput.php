<?php

namespace Sel\View\Helper;

use Sel\View\HelperAbstract;

/**
 * TextInput
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class TextInput extends HelperAbstract
{

    public function direct($model_name, $field_name, $placeholder = '')
    {
        $view = $this->get_view();
        $out = '<input id="' . $model_name . '-' . $field_name . '"'
                . 'name="' . $model_name . '[' . $field_name . ']'
                .'" type="text" placeholder="'
                . $placeholder . '"';

        if( isset($view->$model_name) && isset($view->$model_name->$field_name) )
        {
            $out .= ' value="' . $view->$model_name->$field_name .'"';
        }

        $out .= '/>';

        return $out;
    }

}