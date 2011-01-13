<?php

define('APP_PATH', dirname(__FILE__).'/../');
define('APP_ID', 'manialive');

require_once APP_PATH.'libraries/autoload.php';

\ManiaLib\Application\Bootstrapper::run();

?>