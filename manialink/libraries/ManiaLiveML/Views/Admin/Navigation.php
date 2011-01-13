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
use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Elements\Bgs1;
use ManiaLib\Gui\Cards\Navigation as Nav;

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
		$ui->setManialink($this->request->createLinkArgList('Plugins', 'download'));
		if ($this->request->getAction('download') == 'download' || $this->request->getAction('download') == 'details') $ui->setSelected();
		
		$menu->addItem();
		$ui = $menu->lastItem;
		$ui->icon->setSubStyle(Icons128x128_1::Load);
		$ui->text->setText('Publish');
		$ui->setManialink($this->request->createLinkArgList(Route::CUR, 'publish'));
		if ($this->request->getAction('download') == 'publish') $ui->setSelected();
		
		$menu->save();
	}
}

?>