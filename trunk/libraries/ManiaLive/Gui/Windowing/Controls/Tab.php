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

namespace ManiaLive\Gui\Windowing\Controls;

/**
 * Extend this to build your own tabs,
 * that you can later add to the tabview component.
 * 
 * @author Florian Schnell
 */
abstract class Tab extends \ManiaLive\Gui\Windowing\Control
{
	protected $title;
	
	function setTitle($title)
	{
		$this->title = $title;
	}
	
	function getTitle()
	{
		return $this->title;
	}
	
	function onActivate() {}
	
	function onDeactivate() {}
}

?>