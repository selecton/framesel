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

    public function direct($modelName, $fieldName, $placeholder = '')
    {
        $view = $this->getView();
        $out = '<input id="' . $modelName . '-' . $fieldName . '"'
                . 'name="' . $modelName . '[' . $fieldName . ']'
                .'" type="text" placeholder="'
                . $placeholder . '"';

        if( isset($view->$modelName) && isset($view->$modelName->$fieldName) )
        {
            $out .= ' value="' . $view->$modelName->$fieldName .'"';
        }

        $out .= '/>';

        return $out;
    }

}