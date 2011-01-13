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

namespace ManiaLiveML\Views;

use ManiaLib\Gui\Elements\Quad;

class Header extends \ManiaLib\Application\Views\Header
{
	function display()
	{
		\ManiaLib\Gui\Manialink::load();
		
		$ui = new Quad();
		$ui->setImage('cloudsonly.jpg');
		$ui->setSize(128, 96);
		$ui->setAlign('center', 'center');
		$ui->save();
	}
}

?>