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

    public function direct($modelName, $fieldName)
    {
        $view = $this->getView();
        $out = '';

        if( !isset($view->$modelName) )
        {
            return '';
        }

        if( !($view->$modelName instanceof Model) )
        {
            return '';
        }

        if( !isset($view->$modelName->$fieldName) )
        {
            return '';
        }

        if(  $view->$modelName->is_valid() )
        {
            return '';
        }

        if( ! $view->$modelName->errors->is_invalid($fieldName) )
        {
            return '';
        }

        $errors = $view->$modelName->errors->on($fieldName);
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