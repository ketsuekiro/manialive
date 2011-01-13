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

namespace ManiaLiveML\Views\Admin;

use ManiaLib\Application\Route;
use ManiaLib\Gui\Elements\Label;
use ManiaLib\Gui\Elements\Button;
use ManiaLib\Gui\Manialink;
use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Cards\FancyPanel;

class Send extends \ManiaLib\Application\View
{
	function display()
	{
		Manialink::beginFrame(-23, 20, 1);
		{
			if ($this->response->success)
			{
				$ui = new FancyPanel(80, 60);
				$ui->setSubStyle(null);
				$ui->icon->setSubStyle(Icons128x128_1::Easy);
				$ui->title->setText('Publishing Finished!');
				$ui->subtitle->setText('Your plugin has successfully been attached to the list.');
				$ui->save();
				
				$ui = new Button();
				$ui->setPosition(23, -20);
				$ui->setHalign('center');
				$ui->setSubStyle(Button::CardButtonMediumWide);
				$ui->setText('Continue');
				$ui->setManialink($this->request->createLinkArgList('Plugins', Route::DEF));
				$ui->save();
			}
			else 
			{
				$ui = new FancyPanel(80, 60);
				$ui->setSubStyle(null);
				$ui->icon->setSubStyle(Icons128x128_1::Hard);
				$ui->title->setText('Publishing Failed!');
				$ui->subtitle->setText('Your plugin was not added to the list.');
				$ui->save();
				
				$ui = new Label(60);
				$ui->enableAutonewline();
				$ui->setTextColor('c00');
				$ui->setAlign('center', 'center');
				$ui->setTextSize(3);
				$ui->setPosition(23, -15);
				$ui->setText($this->response->errorMsg);
				$ui->save();
				
				$ui = new Button();
				$ui->setPosition(23, -20);
				$ui->setHalign('center');
				$ui->setSubStyle(Button::CardButtonMediumWide);
				$ui->setText('Try again');
				$ui->setManialink($this->request->createLink(Route::CUR, 'publish'));
				$ui->save();
			}
		}
	}
}

?>