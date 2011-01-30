<?php
namespace Sel\View\Helper;
use Sel\View\HelperAbstract;


/**
 * Textarea
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Textarea extends HelperAbstract
{

    public function direct($model_name, $field_name)
    {
        $view = $this->get_view();
        $out = '<textarea id="' . $model_name . '-' . $field_name . '"'
        . 'name="' . $model_name . '[' . $field_name . ']">';

        if( isset($view->$model_name) && isset($view->$model_name->$field_name) )
        {
            $out .= $view->$model_name->$field_name;
        }
        $out .= '</textarea>';

        return $out;
    }

}