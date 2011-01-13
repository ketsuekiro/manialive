<?php

namespace ManiaLiveML\Views\Home;

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
		$menu->subTitle->setText('Home');
		$menu->titleBg->setSubStyle(Bgs1::BgTitle2);
		$menu->quitButton->setAction(0);
		
		$menu->addItem();
		$ui = $menu->lastItem;
		$ui->icon->setSubStyle(Icons128x128_1::CustomStars);
		$ui->text->setText('About');
		$ui->setManialink($this->request->createLinkArgList(Route::CUR, 'about'));
		if ($this->request->getAction('about') == 'about') $ui->setSelected();
		
		$menu->addItem();
		$ui = $menu->lastItem;
		$ui->icon->setSubStyle(Icons128x128_1::Advanced);
		$ui->text->setText('Features');
		$ui->setManialink($this->request->createLinkArgList(Route::CUR, 'features'));
		if ($this->request->getAction('about') == 'features') $ui->setSelected();
		
		$menu->addItem();
		$ui = $menu->lastItem;
		$ui->icon->setSubStyle(Icons128x128_1::Paint);
		$ui->text->setText('Plugins');
		$ui->addPlayerId();
		$ui->setManialink($this->request->createLinkArgList('plugins', Route::DEF));
		
		$menu->addItem();
		$ui = $menu->lastItem;
		$ui->icon->setSubStyle(Icons128x128_1::Upload);
		$ui->text->setText('Download');
		$ui->setManialink($this->request->createLinkArgList(Route::CUR, 'download'));
		if ($this->request->getAction('about') == 'download') $ui->setSelected();
		
		$menu->save();
	}
}

?>