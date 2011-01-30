<?php
namespace Sel\View\Helper;

use Sel\View\HelperAbstract;
use ActiveRecord\Model;
use Sel\Exception;


/**
 * FormFieldErrors
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class FormFieldErrors extends HelperAbstract
{

    public function direct($model_name, $field_name)
    {
        $view = $this->get_view();
        $out = '';

        if( !isset($view->$model_name) )
        {
            return '';
        }

        if( !($view->$model_name instanceof Model) )
        {
            return '';
        }

        if( !isset($view->$model_name->$field_name) )
        {
            return '';
        }

        if(  $view->$model_name->is_valid() )
        {
            return '';
        }

        if( ! $view->$model_name->errors->is_invalid($field_name) )
        {
            return '';
        }

        $errors = $view->$model_name->errors->on($field_name);
        $errors = \is_array($errors) ? $errors : array($errors);

        $out = '<ul>' . "\n";

        foreach($errors as $error)
        {
            $out .= '<li>' . $error . '</li>' . "\n";
        }
        $out .= '</ul>' . "\n";

        return $out;
    }

}