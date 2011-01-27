<?php

namespace Models;

use ActiveRecord\Model;

/**
 * Post
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class Post extends Model {

    static public $validates_presence_of = array(
        array('title')
    );

}