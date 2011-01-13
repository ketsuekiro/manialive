<?php
namespace ManiaLiveML\Views\Plugins;

use ManiaLib\Gui\Elements\Icons64x64_1;
use ManiaLiveML\Cards\Plugin;
use ManiaLib\Gui\Elements\Button;
use ManiaLib\Gui\Elements\Entry;
use ManiaLib\Gui\Elements\Label;
use ManiaLib\Gui\Elements\BgsPlayerCard;
use ManiaLib\Gui\Manialink;
use ManiaLib\Gui\Layouts\Column;
use ManiaLib\Gui\Cards\FancyPanel;
use ManiaLib\Application\Route;

class Search extends \ManiaLib\Application\View
{
	function display()
	{
		$this->renderSubView('Navigation');
		
		if ($this->response->search)
		{
			Manialink::beginFrame(-25, 35, 1);
			{
				$fpanel = new FancyPanel(80, 60);
				$fpanel->setSubStyle(null);
				$fpanel->icon->setStyle(Icons64x64_1::Icons64x64_1);
				$fpanel->icon->setSubStyle(Icons64x64_1::Stereo3D);
				$fpanel->title->setText('Search');
				
				$layout = new Column();
				$layout->setMarginHeight(1);
				
				if ($this->response->all == 0)
				{
					$fpanel->subtitle->setText('No results to show!');
					
					$ui = new Label(60);
					$ui->setText("There seem to be no plugins in our database that match your search!\nPlease keep your search more general and \$h[" . $this->request->createLinkArgList(Route::CUR, 'search') . "]try again.\$h");
					$ui->setPosition(10, -20, 1);
					$ui->save();
				}
				else
				{
					
					if ($this->response->multipage->getPageNumber() == 1)
					{
						if ($this->response->all == 1)
							$fpanel->subtitle->setText('Showing one result');
						else
							$fpanel->subtitle->setText('Showing ' . $this->response->all . ' results');
					}
					else
					{
						if ($this->response->start == $this->response->end)
							$fpanel->subtitle->setText('Showing result ' . $this->response->start . ' of ' . $this->response->all);
						else
							$fpanel->subtitle->setText('Showing results ' . $this->response->start . ' to ' . $this->response->end . ' out of ' . $this->response->all);
					}
					
					$ui = new Button();
					$ui->setStyle(Button::TextButtonNav);
					$ui->setText('Edit Search');
					$this->request->set('nosearch', 1);
					$ui->setManialink($this->request->createLinkArgList(Route::CUR, Route::CUR, 'name', 'author', 'vmin', 'vmax', 'nosearch'));
					$ui->setPosition(71, -8.5, 1);
					$ui->setHalign('right');
					$ui->save();
					
					Manialink::beginFrame(3, -13.5, 1, 1, $layout);
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
				}
				
				$this->response->multipage->pageNavigator->setPosition(37, -62);
				$this->request->delete('nosearch');
				$this->response->multipage->savePageNavigator();
			}
			
			$fpanel->save();
			
			Manialink::endFrame();
			
			return;
		}
		
		Manialink::beginFrame(-25, 35, 1);
		{
			$ui = new FancyPanel(80, 60);
			$ui->setSubStyle(null);
			$ui->icon->setStyle(Icons64x64_1::Icons64x64_1);
			$ui->icon->setSubStyle(Icons64x64_1::Stereo3D);
			$ui->title->setText('Search');
			$ui->subtitle->setText('May we help you?');
			$ui->save();
			
			Manialink::beginFrame(4, -20, 1);
			{
				$ui = new BgsPlayerCard(70, 4);
				$ui->setSubStyle(BgsPlayerCard::BgPlayerCardBig);
				$ui->save();
				
				$ui = new Label();
				$ui->setText('Search Parameters');
				$ui->setPosition(2, -0.8, 1);
				$ui->save();
				
				$ui = new BgsPlayerCard(70, 23);
				$ui->setSubStyle(BgsPlayerCard::BgPlayerCardBig);
				$ui->save();
				
				Manialink::beginFrame(4, -6, 1);
				{
					$ui = new Label();
					$ui->setText('Name:');
					$ui->save();
					
					$ui = new Entry(15);
					$ui->setName('name');
					$ui->setTextSize(2);
					$ui->setDefault($this->response->name);
					$ui->setTextColor('fc5');
					$ui->setPosition(7, 0, 1);
					$ui->save();
				}
				Manialink::endFrame();
				
				Manialink::beginFrame(4, -11, 1);
				{
					$ui = new Label();
					$ui->setText('Author:');
					$ui->save();
					
					$ui = new Entry(15);
					$ui->setName('author');
					$ui->setTextSize(2);
					$ui->setDefault($this->response->author);
					$ui->setTextColor('fc5');
					$ui->setPosition(7, 0, 1);
					$ui->save();
				}
				Manialink::endFrame();
				
				Manialink::beginFrame(36, -6, 1);
				{
					$ui = new Label(30);
					$ui->setText('Version above:');
					$ui->save();
					
					$ui = new Entry(5);
					$ui->setDefault($this->response->vmin);
					$ui->setName('vmin');
					$ui->setTextColor('fc5');
					$ui->setTextSize(2);
					$ui->setPosition(12.5, 0, 1);
					$ui->save();
				}
				Manialink::endFrame();
				
				Manialink::beginFrame(36, -11, 1);
				{
					$ui = new Label(30);
					$ui->setText('Version below:');
					$ui->save();
					
					$ui = new Entry(5);
					$ui->setTextSize(2);
					$ui->setDefault($this->response->vmax);
					$ui->setName('vmax');
					$ui->setTextColor('fc5');
					$ui->setPosition(12.5, 0, 1);
					$ui->save();
				}
				Manialink::endFrame();
				
				$ui = new Button();
				$ui->setStyle(Button::CardButtonMedium);
				$this->request->set('name', 'name');
				$this->request->set('author', 'author');
				$this->request->set('vmin', 'vmin');
				$this->request->set('vmax', 'vmax');
				$ui->setManialink($this->request->createLinkArgList(Route::CUR, Route::CUR, 'name', 'author', 'vmin', 'vmax'));
				$ui->setText('Search');
				$ui->setPosition(22, -17);
				$ui->save();
			}
			Manialink::endFrame();
		}
		Manialink::endFrame();
	}
}

?>