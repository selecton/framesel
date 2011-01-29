<?php

set_include_path(
        get_include_path()
        . PATH_SEPARATOR . '../library/'
        . PATH_SEPARATOR . '../application/'
);

spl_autoload_extensions('.php');
spl_autoload_register();

use Sel\Controller\Front;

require_once 'php-activerecord/ActiveRecord.php';

error_reporting(E_ALL | E_NOTICE | E_STRICT);

ActiveRecord\Config::initialize(function($cfg) {
                    $cfg->set_model_directory('../application/Models/');
                    $cfg->set_connections(array(
                        'development' => 'mysql://root:@localhost/framesel'
                    ));
                });

echo Front::instance()->run();