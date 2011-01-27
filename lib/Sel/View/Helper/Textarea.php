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

    public function direct($modelName, $fieldName)
    {
        $view = $this->getView();
        $out = '<textarea id="' . $modelName . '-' . $fieldName . '"'
        . 'name="' . $modelName . '[' . $fieldName . ']">';

        if( isset($view->$modelName) && isset($view->$modelName->$fieldName) )
        {
            $out .= $view->$modelName->$fieldName;
        }
        $out .= '</textarea>';

        return $out;
    }

}