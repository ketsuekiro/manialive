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

namespace ManiaLiveML\Views\Home;

use ManiaLib\Gui\Elements\Label;
use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Cards\FancyPanel;
use ManiaLib\Gui\Manialink;

class About extends \ManiaLib\Application\View
{
	function display()
	{
		$this->renderSubView('Navigation');
		
		Manialink::beginFrame(-25, 30, 1);
		{
			$ui = new FancyPanel(80, 60);
			$ui->setSubStyle(null);
			$ui->icon->setSubStyle(Icons128x128_1::Custom);
			$ui->title->setText('About');
			$ui->subtitle->setText('What is ManiaLive?');
			$ui->save();
			
			$ui = new Label(78);
			$ui->setPosition(39, -13);
			$ui->enableAutonewline();
			$ui->setTextSize(3);
			$ui->setHalign('center');
			$ui->setText("\" \$o\$bdfManiaLive \$zis an application that you can use to costumize\nthe behaviour of your dedicated server. \"");
			$ui->save();
			
			$text = "A professional solution where performance and stability are some of the main aspects.\n";
			$text .= "Due to its module-based design its look and feel can take totally different shapes.\n";
			$text .= "Like in existing solutions (Aseco, FAST ...) you can use plugins to achieve for instance:\n\n";
			$text .= " - graphical user interface.\n\n";
			$text .= " - storing of online driven records, for instance with Dedimania.\n\n";
			$text .= " - controling your server from within the game.\n\n";
			$text .= " - displaying additional track, player or server information.\n\n";
			
			$ui = new Label(78);
			$ui->setPosition(1, -23);
			$ui->enableAutonewline();
			$ui->setText($text);
			$ui->save();
		}
		Manialink::endFrame();
	}
}

?>