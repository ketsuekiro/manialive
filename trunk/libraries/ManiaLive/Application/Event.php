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

namespace ManiaLive\Application;

// Maybe create events for Preloop/postloop for better performance

class Event extends \ManiaLive\Event\Event
{
	const ON_INIT = 1;
	const ON_RUN = 2;
	const ON_PRE_LOOP = 3;
	const ON_POST_LOOP = 4;
	const ON_TERMINATE = 5;
	
	protected $onWhat;
	
	function __construct($source, $onWhat)
	{
		parent::__construct($source);
		$this->onWhat = $onWhat;
	}
	
	function fireDo($listener)
	{
		switch($this->onWhat)
		{
			case self::ON_PRE_LOOP: $listener->onPreLoop(); break;
			case self::ON_POST_LOOP: $listener->onPostLoop(); break;
			case self::ON_RUN: $listener->onRun(); break;
			case self::ON_INIT: $listener->onInit(); break;
			case self::ON_TERMINATE: $listener->onTerminate(); break;
		}
	}
}

?>