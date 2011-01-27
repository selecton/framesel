<?php
namespace Sel\View;
use Sel\View;
use Sel\Exception;

/**
 * HelperAbstract
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
abstract class HelperAbstract
{

    /**
     *
     * @var Sel\View
     */
    private $_view;

    public function __construct(View $view)
    {
        $this->_view = $view;
    }

    /**
     *
     * @return Sel\View
     */
    public function getView()
    {
        return $this->_view;
    }

    public function direct()
    {
        throw new Exception('Override this method');
    }

}