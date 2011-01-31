<?php
namespace Sel\View\Helper;
use Sel\View\HelperAbstract;

/**
 * Password
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Password extends HelperAbstract
{

    public function direct($model_name, $field_name)
    {
        return '<input type="password" id="' . $model_name . '-' . $field_name . '" name="' . $model_name . '[' . $field_name . ']" />';
    }

}