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

namespace ManiaLive\Features\Admin;

class Config extends \ManiaLive\Config\Configurable
{
	public $logins;
	
	function validate()
	{
		$this->setDefault('logins', array());
	}
}

?>