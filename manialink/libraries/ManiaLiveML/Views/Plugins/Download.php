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

namespace ManiaLiveML\Views\Plugins;

use ManiaLiveML\Cards\Plugin;
use ManiaLib\Application\Route;
use ManiaLib\Gui\Elements\Label;
use ManiaLib\Gui\Layouts\Column;
use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Cards\FancyPanel;
use ManiaLib\Gui\Manialink;

class Download extends \ManiaLib\Application\View
{
	function display()
	{
		$this->renderSubView('Navigation');
		
		Manialink::beginFrame(-25, 35, 1);
		{
			$ui = new FancyPanel(80, 60);
			$ui->setSubStyle(null);
			$ui->icon->setSubStyle(Icons128x128_1::Forever);
			$ui->title->setText('Download');
			
			if ($this->response->category === null)
			{
				$ui->subtitle->setText('A list of all yet published plugins ...');
			}
			elseif ($this->response->category == 0)
			{
				$ui->subtitle->setText('Plugin list filtered for category: Administration');
			}
			elseif ($this->response->category == 1)
			{
				$ui->subtitle->setText('Plugin list filtered for category: Entertainment');
			}
			else
			{
				$ui->subtitle->setText('Plugin list filtered for category: Feature');
			}

			$ui->save();
			
			$layout = new Column();
			$layout->setMarginHeight(1);
			
			Manialink::beginFrame(3, -13.5, 1, 1, $layout);
			
			if (!count($this->response->plugins))
			{
				$ui = new Label(80);
				$ui->setText("There are no plugins available yet.\nBe the first to submit one!");
				$ui->setTextSize(3);
				$ui->setHalign('center');
				$ui->setPosition(26, -20);
				$ui->save();
			}
			else
			{
				foreach((array) $this->response->plugins as $plugin)
				{
					$this->request->set('id', $plugin->id);
					$manialink = $this->request->createLink(Route::CUR, 'details');
					
					$ui = Plugin::fromPlugin($plugin);
					if ($plugin->author == $this->response->playerlogin)
					{
						$this->request->set('plugin_id', $plugin->id);
						$edit = $this->request->createLinkArgList('Admin', 'Publish', 'plugin_id', 'playerlogin');
						$delete = $this->request->createLinkArgList('Admin', 'Delete', 'plugin_id', 'playerlogin');
						$ui->author->setText('$fc5$h['.$edit.']edit$h $fff| $fc5$h['.$delete.']delete$h');
					}
					$ui->titleBg->setManialink($manialink);
					$ui->save();
				}
			}
			
			Manialink::endFrame();

			$this->request->set('category', $this->response->category);
			$this->response->multipage->pageNavigator->setPosition(37, -62);
			$this->response->multipage->savePageNavigator();
		}
		Manialink::endFrame();
	}
}

?>