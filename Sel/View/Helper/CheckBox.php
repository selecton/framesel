<?php
namespace Sel\View\Helper;

use Sel\View\HelperAbstract;

/**
 * CheckBox
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class CheckBox extends HelperAbstract
{

    public function direct($model_name, $field_name)
    {
        $out = '<input type="checkbox" name="' . $model_name . '[' . $field_name . ']" '
            . ' id="' . $model_name . '-' . $field_name . '"';

        if( isset($view->$model_name) && isset($view->$model_name->$field_name) && $view->$model_name->$field_name == '1')
        {
            $out .= ' checked="checked" ';
        }
        
        $out .= '/>';
        
        return $out;
    }

}