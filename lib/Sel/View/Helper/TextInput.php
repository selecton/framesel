<?php
namespace Sel\View\Helper;

/**
 * TextInput
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class TextInput
{

    public function direct($model, $field)
    {
        return 'SUPER : ' . $model . '. ' . $field;
    }
    
}