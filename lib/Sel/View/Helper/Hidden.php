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

    public function direct($modelName, $fieldName)
    {
        $view = $this->getView();
        $out = '<input id="' . $modelName . '-' . $fieldName . '"'
            . 'name="' . $modelName . '[' . $fieldName . ']"'
            . 'type="hidden"';

        if( isset($view->$modelName) && isset($view->$modelName->$fieldName) )
        {
            $out .= ' value="' . $view->$modelName->$fieldName .'"';
        }

        $out .= '/>';

        return $out;
    }

}