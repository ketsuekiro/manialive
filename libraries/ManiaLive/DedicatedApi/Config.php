<?php
/**
 * ManiaLive - TrackMania dedicated server manager in PHP
 * 
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision: 1709 $:
 * @author      $Author: svn $:
 * @date        $Date: 2011-01-07 14:06:13 +0100 (ven., 07 janv. 2011) $:
 */

namespace ManiaLive\DedicatedApi;

class Config extends \ManiaLive\Config\Configurable
{
	public $host;
	public $port;
	public $password;
	public $user;
	public $timeout;
	
	function validate()
	{
		$this->setDefault('host', 'localhost');
		$this->setDefault('port', 5000);
		$this->setDefault('user', 'SuperAdmin');
		$this->setDefault('password', 'SuperAdmin');
		$this->setDefault('timeout', 1);
	}
}

?>