<?php
/**
 * ManiaLib - Lightweight PHP framework for Manialinks
 * 
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision: 486 $:
 * @author      $Author: maximeraoust $:
 * @date        $Date: 2011-01-13 18:09:25 +0100 (jeu., 13 janv. 2011) $:
 */

if(!defined('APP_PATH'))
{
	echo 'Fatal error: APP_PATH must be defined to your application root!';
	exit;			
}

define('NAMESPACE_SEPARATOR', '\\');

define('APP_LIBRARIES_PATH', __DIR__);

function __autoload($className)
{
	$className = str_replace(NAMESPACE_SEPARATOR, DIRECTORY_SEPARATOR, $className);
	$path = APP_LIBRARIES_PATH.DIRECTORY_SEPARATOR.$className.'.php';
	if(file_exists($path))
	{
		require_once $path;
	}
}

?>