<?php
/**
 * ManiaLive - TrackMania dedicated server manager in PHP
 *
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision$:
 * @author      $Author$:
 * @date        $Date$:
 */

$php_ok = (function_exists('version_compare') && version_compare(phpversion(), '5.3.1', '>='));
$json_ok = (extension_loaded('json') && function_exists('json_encode') && function_exists('json_decode'));
$spl_ok = extension_loaded('spl');
$curl_ok = function_exists('curl_version');
if($curl_ok)
{
	$curl_version = curl_version();
	$curl_ssl_ok = (function_exists('curl_exec') && in_array('https', $curl_version['protocols'], true));
}
$sqlite2_ok = extension_loaded('sqlite');
$sqlite3_ok = extension_loaded('sqlite3');
$sqlite_ok = ($sqlite2_ok || $sqlite3_ok);

echo '
 _|      _|                      _|            _|        _|                        
 _|_|  _|_|    _|_|_|  _|_|_|          _|_|_|  _|            _|    _|    _|_|
 _|  _|  _|  _|    _|  _|    _|  _|  _|    _|  _|        _|  _|    _|  _|_|_|_|
 _|      _|  _|    _|  _|    _|  _|  _|    _|  _|        _|  _|  _|    _|
 _|      _|    _|_|_|  _|    _|  _|    _|_|_|  _|_|_|_|  _|    _|        _|_|_|
';
echo '-----------------------------------------------------'.PHP_EOL;
echo 'PHP Environment Compatibility Test'.PHP_EOL;
echo '-----------------------------------------------------'.PHP_EOL;
echo 'PHP 5.3.1 or newer    -> required  -> ' . ($php_ok ? ('[ Yes ] '.phpversion()) : '[ No  ]').PHP_EOL;
echo 'Standard PHP Library  -> required  -> ' . ($spl_ok ? '[ Yes ]' : '[ No  ]').PHP_EOL;
echo 'JSON                  -> required  -> ' . ($json_ok ? '[ Yes ]' : '[ No  ]').PHP_EOL;
echo 'cURL with SSL         -> required  -> ' . ($curl_ok ? ($curl_ssl_ok ? '[ Yes ] '.$curl_version['version'].' (with '.$curl_version['ssl_version'].')' : '[ No  ] '.$curl_version['version'].' (without SSL)') : '[ No  ]').PHP_EOL;
echo 'SQLite                -> optional  -> ' . ($sqlite_ok ? '[ Yes ]' : '[ No  ]').PHP_EOL;
echo '-----------------------------------------------------'.PHP_EOL;


if(!$php_ok || !$curl_ok || !$spl_ok || !$json_ok)
{
    echo 'Your system is not compatible, check your php configuration.'.PHP_EOL;
    exit;
}

// better checking if timezone is set
if(!ini_get('date.timezone'))
{
	$timezone = @date_default_timezone_get();
	echo 'Timezone is not set in php.ini. Please edit it and change/set "date.timezone" appropriately. '
			.'Setting to default: \''.$timezone.'\''.PHP_EOL;
	date_default_timezone_set($timezone);
}

if(!$sqlite_ok)
{
    echo 'SQLite is disabled, threading will not work. ManiaLive may encounter some perfomance trouble.'.PHP_EOL;
}
// enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
gc_enable();

require_once __DIR__.DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR.'autoload.php';

ManiaLiveApplication\Application::getInstance()->run();

?>