<?php

namespace ManiaLiveML\Views\Plugins;

use ManiaLib\Application\Route;
use ManiaLib\Gui\Elements\Button;
use ManiaLib\Gui\Elements\Label;
use ManiaLib\Gui\Elements\BgsPlayerCard;
use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Cards\FancyPanel;
use ManiaLib\Gui\Manialink;

class Details extends \ManiaLib\Application\View
{
	function display()
	{
		$this->renderSubView('Navigation');	
		
		Manialink::beginFrame(-25, 35, 1);
		{
			if ($this->response->plugin)
			{
				$plugin = $this->response->plugin;
				
				$ui = new FancyPanel(80, 60);
				$ui->setSubStyle(null);
				switch ($plugin->category)
				{
					case 0:
						$ui->icon->setSubStyle(Icons128x128_1::Padlock);
						$ui->subtitle->setText('Category: Administration');
						break;
					case 1:
						$ui->icon->setSubStyle(Icons128x128_1::Paint);
						$ui->subtitle->setText('Category: Entertainment');
						break;
					case 2:
					default:
						$ui->icon->setSubStyle(Icons128x128_1::Advanced);
						$ui->subtitle->setText('Category: Feature');
						break;
				}
				$ui->title->setText($plugin->name);
				$ui->save();
				
				Manialink::beginFrame(3, -2);
				{	
					$ui = new BgsPlayerCard(70, 4);
					$ui->setPosition(0, -12);
					$ui->setSubStyle(BgsPlayerCard::BgPlayerCardBig);
					$ui->save();
					
					$ui = new Label(66);
					$ui->setText('Details to "' . $plugin->name . '"');
					$ui->setPosition(2, -12.8, 1);
					$ui->save();
					
					$ui = new BgsPlayerCard(70, 40);
					$ui->setPosition(0, -12);
					$ui->setSubStyle(BgsPlayerCard::BgPlayerCardBig);
					$ui->save();
					
					$ui = new Label();
					$ui->setText('Author');
					$ui->setPosition(3, -17.7, 1);
					$ui->setTextColor('ddd');
					$ui->setTextSize(2);
					$ui->save();
					
					$ui = new Label();
					$ui->setText($plugin->author);
					$ui->setPosition(3, -20, 1);
					$ui->setTextColor('aaa');
					$ui->setTextSize(2);
					$ui->save();
					
					$ui = new Label();
					$ui->setText('Version');
					$ui->setPosition(3, -24, 1);
					$ui->setTextColor('ddd');
					$ui->setTextSize(2);
					$ui->save();
					
					$ui = new Label();
					$ui->setText($plugin->version);
					$ui->setPosition(3, -26.3, 1);
					$ui->setTextColor('aaa');
					$ui->setTextSize(2);
					$ui->save();
					
					$ui = new Label(79);
					$ui->setText('Details Link');
					$ui->setPosition(3, -30.3, 1);
					$ui->setTextColor('ddd');
					$ui->setTextSize(2);
					$ui->save();
					
					$ui = new Label(64);
					if (!$plugin->addressMore)
						$plugin->addressMore = 'For details see the description at the bottom.';
					else
						$ui->setUrl($plugin->addressMore);
					$ui->setText($plugin->addressMore);
					$ui->setPosition(3, -32.6, 1);
					$ui->setTextColor('aaa');
					$ui->setTextSize(2);
					$ui->save();
					
					$ui = new Label(64);
					$ui->setText('Download Link');
					$ui->setPosition(3, -36.6, 1);
					$ui->setTextColor('ddd');
					$ui->setTextSize(2);
					$ui->save();
					
					$ui = new Label(64);
					$ui->setText($plugin->address);
					$ui->setUrl($plugin->address);
					$ui->setPosition(3, -38.9, 1);
					$ui->setTextColor('aaa');
					$ui->setTextSize(2);
					$ui->save();
					
					$ui = new Label(64);
					$ui->setText('Description:');
					$ui->setPosition(3, -42.9, 1);
					$ui->setTextColor('ddd');
					$ui->setTextSize(2);
					$ui->save();
					
					$ui = new Label(64);
					if (!$plugin->description) $plugin->description = 'Please see the Details Link for a description.';
					$ui->setText($plugin->description);
					$ui->enableAutonewline();
					$ui->setMaxline(2);
					$ui->setPosition(3, -45.2);
					$ui->setTextColor('aaa');
					$ui->setTextSize(2);
					$ui->save();
				}
			}
			
			$ui = new Button();
			$ui->setStyle(Button::CardButtonSmall);
			$ui->setText('Show Overview');
			$ui->setHalign('center');
			$ui->setManialink($this->request->getReferer());
			$ui->setPosition(35, -55);
			$ui->save();
		}
	}
}

?>