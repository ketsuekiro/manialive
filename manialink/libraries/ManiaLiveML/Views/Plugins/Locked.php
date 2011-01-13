<?php

namespace ManiaLiveML\Views\Plugins;

use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Cards\FancyPanel;
use ManiaLib\Gui\Manialink;

class Locked extends \ManiaLib\Application\View
{
	function display()
	{
		$this->renderSubView('Navigation');
		
		Manialink::beginFrame(-25, 10, 1);
		{
			$ui = new FancyPanel(80, 60);
			$ui->setSubStyle(null);
			$ui->icon->setSubStyle(Icons128x128_1::Padlock);
			$ui->title->setText('Locked');
			$ui->subtitle->setText('The page that you just tried to access is only available to Trackmania United players!');
			$ui->save();
		}
	}
}

?>