<?php
namespace Sel\View\Helper;

use Sel\View\HelperAbstract;

/**
 * ShortenTekst
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class ShortenText extends HelperAbstract
{

    public function direct($text, $length)
    {
        
        if( $length >= \strlen($text) )
            return $text;

        while( ($text[$length] != ' ' && $text[$length] != "\n") || $length == 0)
            $length--;

        return \substr($text, 0, $length) . '...';
    }

}