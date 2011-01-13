<?php

namespace ManiaLiveML\Views\Home;

use ManiaLib\Gui\Elements\Button;
use ManiaLib\Gui\Elements\Label;
use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Cards\FancyPanel;
use ManiaLib\Gui\Manialink;

class Download extends \ManiaLib\Application\View
{
	function display()
	{
		$this->renderSubView('Navigation');
		
		Manialink::beginFrame(-25, 30, 1);
		{
			$ui = new FancyPanel(80, 60);
			$ui->setSubStyle(null);
			$ui->icon->setSubStyle(Icons128x128_1::Multiplayer);
			$ui->title->setText('Download');
			$ui->subtitle->setText('Get yourself connected!');
			$ui->save();
			
			$ui = new Label(78);
			$ui->setPosition(1, -15, 1);
			$ui->setTextSize(3);
			$ui->setText('You can find a download link to ManiaLive on the project\'s Google Code page.');
			$ui->save();
			
			$ui = new Icons128x128_1(8, 8);
			$ui->setSubStyle(Icons128x128_1::Upload);
			$ui->setPosition(12.5,-24,2);
			$ui->save();
			
			$ui = new Button();
			$ui->setStyle(Button::CardButtonMediumWide);
			$ui->setPosition(39, -26, 1);
			$ui->setHalign('center');
			$ui->setText("Download from Google Code");
			$ui->setUrl('http://www.manialive.com/');
			$ui->save();
		}
	}
}
?>