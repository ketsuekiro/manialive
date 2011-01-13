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

use ManiaLib\Gui\Cards\Navigation as Nav;
use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Elements\Bgs1;
use ManiaLib\Application\Route;

class Navigation extends \ManiaLib\Application\View
{
	function display()
	{
		Nav\Button::$selectedTextStyle = '$9cf';
		
		$menu = new Nav\Menu();
		$menu->logo->setImage('manialive-logo.dds');
		$menu->title->setText('ManiaLive');
		$menu->subTitle->setText('Plugins');
		$menu->titleBg->setSubStyle(Bgs1::BgTitle2);
		
		$menu->quitButton->icon->setSubStyle(Icons128x128_1::Back);
		$menu->quitButton->setManialink($this->request->createLink('Home', Route::DEF));
		$menu->quitButton->text->setText('Back');
		
		$menu->addItem();
		$ui = $menu->lastItem;
		$ui->icon->setSubStyle(Icons128x128_1::Save);
		$ui->text->setText('Download');
		$ui->addPlayerId();
		$ui->setManialink($this->request->createLinkArgList(Route::CUR, 'download'));
		if ($this->request->getAction('download') == 'download'
			|| $this->request->getAction('download') == 'details'
			|| $this->request->getAction('download') == 'search')
			$ui->setSelected();
		
		if ($this->request->getAction('download') == 'download'
			|| $this->request->getAction('download') == 'search'
			|| $this->request->getAction('download') == 'details')
		{
			$category = $this->request->get('category');
			
			$menu->addItem();
			$ui = $menu->lastItem;
			$ui->icon->setPositionX(4);
			$ui->icon->setSubStyle(Icons128x128_1::Browse);
			$ui->text->setText('Search ');
			$ui->text->setTextSize(3);
			$ui->addPlayerId();
			$this->request->set('category', -1);
			$ui->setManialink($this->request->createLinkArgList(Route::CUR, 'search'));
			$ui->setSizeY(6.5);
			if ($this->request->getAction('download') == 'search') $ui->setSelected();
			$menu->addItem();
			$ui = $menu->lastItem;
			$ui->icon->setPositionX(4);
			$ui->icon->setSubStyle(Icons128x128_1::Padlock);
			$ui->text->setText('Administration');
			$ui->text->setTextSize(3);
			$ui->addPlayerId();
			if ($this->request->getAction('download') == 'download'
				&& $category == 0 && $category != null)
					$ui->setSelected();
			$this->request->set('category', 0);
			$ui->setManialink($this->request->createLinkArgList(Route::CUR, 'download', 'category'));
			$ui->setSizeY(6.5);
			
			$menu->addItem();
			$ui = $menu->lastItem;
			$ui->icon->setPositionX(4);
			$ui->icon->setSubStyle(Icons128x128_1::Paint);
			$ui->text->setText('Entertainment');
			$ui->text->setTextSize(3);
			$ui->addPlayerId();
			if ($this->request->getAction('download') == 'download'
				&& $category == 1)
					$ui->setSelected();
			$this->request->set('category', 1);
			$ui->setManialink($this->request->createLinkArgList(Route::CUR, 'download', 'category'));
			$ui->setSizeY(6.5);
			
			$menu->addItem();
			$ui = $menu->lastItem;
			$ui->icon->setPositionX(4);
			$ui->icon->setSubStyle(Icons128x128_1::Advanced);
			$ui->text->setText('Feature');
			$ui->text->setTextSize(3);
			$ui->addPlayerId();
			if ($this->request->getAction('download') == 'download'
				&& $category == 2)
					$ui->setSelected();
			$this->request->set('category', 2);
			$ui->setManialink($this->request->createLinkArgList(Route::CUR, 'download', 'category'));
			$ui->setSizeY(6.5);
		}
		
		$menu->addItem();
		$ui = $menu->lastItem;
		$ui->icon->setSubStyle(Icons128x128_1::Load);
		$ui->text->setText('Publish');
		$ui->addPlayerId();
		$ui->setManialink($this->request->createLinkArgList('Admin', 'publish'));
		if ($this->request->getAction('download') == 'publish') $ui->setSelected();
		
		$menu->save();
	}
}

?>