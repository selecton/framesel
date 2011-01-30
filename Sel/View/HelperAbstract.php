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
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
        if( !method_exists($this, 'direct') )
        {
            throw new Exception('Helper class must implement the direct() method');
        }
    }

    /**
     *
     * @return Sel\View
     */
    public function get_view()
    {
        return $this->view;
    }

}