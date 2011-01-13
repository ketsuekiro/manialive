<?php

namespace ManiaLiveML\Views\Admin;

use ManiaLib\Application\Route;
use ManiaLib\Gui\Elements\BgsPlayerCard;
use ManiaLib\Gui\Elements\Entry;
use ManiaLib\Gui\Elements\Bgs1;
use ManiaLib\Gui\Elements\Label;
use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Cards\FancyPanel;
use ManiaLib\Gui\Manialink;

class Publish extends \ManiaLib\Application\View
{
	function setDefault($ui, $name)
	{
		if ($this->response->editing)
		{
			if (isset($this->response->edited_plugin->$name))
				$ui->setDefault($this->response->edited_plugin->$name);
		}
		elseif ($this->request->get($name))
			$ui->setDefault($this->request->get($name));
	}
	
	function display()
	{
		$this->renderSubView('Navigation');
		
		Manialink::beginFrame(-25, 35, 1);
		{
			$ui = new FancyPanel(80, 60);
			$ui->setSubStyle(null);
			$ui->icon->setSubStyle(Icons128x128_1::Load);
			$ui->title->setText('Publish');
			if ($this->response->editing == true)
				$ui->subtitle->setText('Edit an existing ManiaLive Plugin' );
			else
				$ui->subtitle->setText('Publish a new ManiaLive Plugin');
			$ui->save();
			
			Manialink::beginFrame(1, -14, 1);
			{
				$ui = new Label(78);
				$ui->setPosition(0, -1);
				$ui->setText("Name:\n");
				$ui->save();
				
				$ui = new Bgs1(31, 5);
				$ui->setSubStyle(Bgs1::NavButtonBlink);
				$ui->setPosition(6, 0, 1);
				$ui->save();
				
				$ui = new Entry(28);
				$ui->setPosition(7.5, -1.5, 2);
				$ui->setTextColor('9cf');
				$ui->setName('name');
				$this->setDefault($ui, 'name');
				$ui->setTextSize(2);
				$ui->save();
			}
			Manialink::endFrame();
			
			Manialink::beginFrame(48, -14, 1);
			{
				$ui = new Label(78);
				$ui->setPosition(0, -1);
				$ui->setText("Version:\n");
				$ui->save();
				
				$ui = new Bgs1(23, 5);
				$ui->setSubStyle(Bgs1::NavButtonBlink);
				$ui->setPosition(7, 0, 1);
				$ui->save();
				
				$ui = new Entry(20);
				$ui->setPosition(8.5, -1.5, 2);
				$ui->setTextColor('9cf');
				$ui->setName('version');
				$this->setDefault($ui, 'version');
				$ui->setTextSize(2);
				$ui->save();
			}
			Manialink::endFrame();
			
			Manialink::beginFrame(1, -20.7, 1);
			{
				$ui = new Label(78);
				$ui->setText("Please enter the download address of the plugin on the web:\n");
				$ui->save();
				
				$ui = new Bgs1(78, 5);
				$ui->setSubStyle(Bgs1::NavButtonBlink);
				$ui->setPosition(38, -3, 1);
				$ui->setHalign('center');
				$ui->save();
				
				$ui = new Entry(75);
				$ui->setPosition(1.5, -4.5, 2);
				$ui->setTextColor('9cf');
				$ui->setName('address');
				$this->setDefault($ui, 'address');
				$ui->setTextSize(2);
				$ui->save();
			}
			Manialink::endFrame();
			
			Manialink::beginFrame(1, -30.7, 1);
			{
				$ui = new Label(78);
				$ui->setText("Put a link to a description of the plugin on a forum or a website:\n");
				$ui->save();
				
				$ui = new Bgs1(78, 5);
				$ui->setSubStyle(Bgs1::NavButtonBlink);
				$ui->setPosition(38, -3, 1);
				$ui->setHalign('center');
				$ui->save();
				
				$ui = new Entry(75);
				$ui->setPosition(1.5, -4.5, 2);
				$ui->setTextColor('9cf');
				$ui->setName('addressMore');
				$this->setDefault($ui, 'addressMore');
				$ui->setTextSize(2);
				$ui->save();
			}
			Manialink::endFrame();
			
			Manialink::beginFrame(1, -40.7, 1);
			{
				$ui = new Label(78);
				$ui->setText("You can enter a description, of what your plugin is doing, in the field below (max. 160)");
				$ui->save();
				
				$ui = new Bgs1(78, 5);
				$ui->setSubStyle(Bgs1::NavButtonBlink);
				$ui->setPosition(38, -3, 1);
				$ui->setHalign('center');
				$ui->save();
				
				$ui = new Entry(75);
				$ui->setPosition(1.5, -4.5, 1);
				$ui->setTextSize(2);
				$ui->setName('description');
				$this->setDefault($ui, 'description');
				$ui->setTextColor('9cf');
				$ui->save();
			}
			Manialink::endFrame();
			
			$this->request->set('name', 'name');
			$this->request->set('version', 'version');
			$this->request->set('address', 'address');
			$this->request->set('addressMore', 'addressMore');
			$this->request->set('description', 'description');
			
			Manialink::beginFrame(3, -50.7, 1);
			{
				$ui = new Label(78);
				$ui->setPosition(-2);
				$ui->setText("\$oTo finish \$zthe process, please choose one of the categories below:");
				$ui->save();
				
				$this->request->set('category', 0);
				
				$ui = new BgsPlayerCard(10, 10);
				$ui->setSubStyle(BgsPlayerCard::BgActivePlayerCard);
				$ui->addPlayerId();
				$ui->setManialink($this->request->createLink(Route::CUR, 'send'));
				$ui->setPosition(14, -4, 1);
				$ui->save();
				
				$ui = new Icons128x128_1(8);
				$ui->setSubStyle(Icons128x128_1::Padlock);
				$ui->setPosition(15, -5, 2);
				$ui->save();
				
				$ui = new Label();
				$ui->setText('Administrative');
				$ui->setPosition(13.6, -12, 2);
				$ui->save();
				
				$this->request->set('category', 1);
				
				$ui = new BgsPlayerCard(10, 10);
				$ui->setSubStyle(BgsPlayerCard::BgActivePlayerCard);
				$ui->addPlayerId();
				$ui->setManialink($this->request->createLink(Route::CUR, 'send'));
				$ui->setPosition(29, -4, 1);
				$ui->save();
				
				$ui = new Icons128x128_1(8);
				$ui->setSubStyle(Icons128x128_1::Paint);
				$ui->setPosition(30, -5, 2);
				$ui->save();
				
				$ui = new Label();
				$ui->setText('Entertainment');
				$ui->setPosition(28.7, -12, 2);
				$ui->save();
				
				$this->request->set('category', 2);
				
				$ui = new BgsPlayerCard(10, 10);
				$ui->setSubStyle(BgsPlayerCard::BgActivePlayerCard);
				$ui->addPlayerId();
				$ui->setManialink($this->request->createLink(Route::CUR, 'send'));
				$ui->setPosition(44, -4, 1);
				$ui->save();
				
				$ui = new Icons128x128_1(8);
				$ui->setSubStyle(Icons128x128_1::Advanced);
				$ui->setPosition(45, -5, 2);
				$ui->save();
				
				$ui = new Label();
				$ui->setText('Feature');
				$ui->setPosition(46.3, -12, 2);
				$ui->save();
			}
			Manialink::endFrame();
		}
	}
}

?>