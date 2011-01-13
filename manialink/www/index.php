<?php
/**
 * ManiaLive manialink, built on top of ManiaLib
 * 
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision$:
 * @author      $Author$:
 * @date        $Date$:
 */

define('APP_PATH', dirname(__FILE__).'/../');
define('APP_ID', 'manialive');

require_once APP_PATH.'libraries/autoload.php';

\ManiaLib\Application\Bootstrapper::run();

?>