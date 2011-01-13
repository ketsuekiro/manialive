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
use ManiaLib\Gui\Elements\BgsPlayerCard;
use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Cards\FancyPanel;
use ManiaLib\Gui\Manialink;

class Features extends \ManiaLib\Application\View
{
	function display()
	{
		$this->renderSubView('Navigation');
		
		Manialink::beginFrame(-25, 33, 1);
		{
			$ui = new FancyPanel(80, 60);
			$ui->setSubStyle(null);
			$ui->icon->setSubStyle(Icons128x128_1::United);
			$ui->title->setText('Features');
			$ui->subtitle->setText('What does it offer?');
			$ui->save();
			
			$features = array
			(
				'Framework for creating server side applications.',
				'Easy and fast configuration - see online howto.',
				'Full up-to-date wrapper for the dedicated server XmlRpc Interface.',
				'Performance and stability optimized.',
				'Build clean and fast client GUI on base of ManiaLib.',
				'Supports "multithreading" to ensure maximal responsiveness.',
				'Plugin based application, that can be adopted without much programing knowledge.',
				'Integration of ManiaHome offers a new social component to online gaming.'
				
			);
			
			foreach ($features as $i => $feature)
			{
				Manialink::beginFrame(3, -14 + ($i * -5.5), 1);
				{			
					$ui = new BgsPlayerCard(70, 4.5);
					$ui->setSubStyle(BgsPlayerCard::BgPlayerCardBig);
					$ui->save();
					
					$ui = new Icons128x128_1(5.5);
					$ui->setSubStyle(Icons128x128_1::Create);
					$ui->setPosition(1, -2, 1);
					$ui->setAlign('center', 'center');
					$ui->save();
					
					$ui = new Label(68);
					$ui->setText($feature);
					$ui->setPosition(4, -1.3, 2);
					$ui->save();
				}
				Manialink::endFrame();
			}
		}
		Manialink::endFrame();
	}
}
?>