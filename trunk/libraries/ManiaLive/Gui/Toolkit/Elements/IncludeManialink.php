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

namespace ManiaLive\Gui\Toolkit\Elements;

/**
 * Include
 * Manialink include tag, used to include another Manialink file inside a Manialink
 */
class IncludeManialink extends Element
{
	function __construct()
	{
	}

	protected $xmlTagName = 'include';
	protected $halign = null;
	protected $valign = null;
	protected $posX = null;
	protected $posY = null;
	protected $posZ = null;
}

?>