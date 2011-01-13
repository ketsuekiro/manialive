<?php

namespace ManiaLiveML\Cards;

use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Elements\Label;
use ManiaLib\Gui\Elements\BgsPlayerCard;

class Plugin extends \ManiaLib\Gui\Elements\Quad
{
	/**
	 * @var \ManiaLib\Gui\Elements\Icons128x128_1
	 */
	public $icon;
	/**
	 * @var \ManiaLib\Gui\Elements\Label
	 */
	public $title;
	/**
	 * @var \ManiaLib\Gui\Elements\BgsPlayerCard
	 */
	public $titleBg;
	/**
	 * @var \ManiaLib\Gui\Elements\Label
	 */
	public $version;
	/**
	 * @var \ManiaLib\Gui\Elements\Label
	 */
	public $author;
	
	/**
	 * @return \ManiaLiveML\Cards\Plugin
	 */
	public static function fromPlugin(\ManiaLiveML\Services\Plugin $plugin)
	{
		if (strlen($plugin->description) > 70)
			$description = substr($plugin->description, 0, 67).'...';
		else
			$description = $plugin->description;
		
		switch ($plugin->category)
		{
			case 0:
				$icon = Icons128x128_1::Padlock;
				break;
			case 1:
				$icon = Icons128x128_1::Paint;
				break;
			case 2:
			default:
				$icon = Icons128x128_1::Advanced;
				break;
		}	
			
		$version = '$<$9cf'.$plugin->name.' \ $>v'.$plugin->version;
		$author = '$ddd'.'created by $ddd'.$plugin->author;
		
		$ui = new self;
		$ui->title->setText($description);
		$ui->icon->setSubStyle($icon);
		$ui->version->setText($version);
		$ui->author->setText($author);
		
		return $ui;
	}
	
	function __construct($sizeX = 70, $sizeY = 10)
	{
		parent::__construct($sizeX, $sizeY);
		
		$this->setStyle(self::BgsPlayerCard);
		$this->setSubStyle(BgsPlayerCard::BgPlayerCardBig);
		
		$this->titleBg = new BgsPlayerCard($sizeX, 4.5);
		$this->titleBg->setSubStyle(BgsPlayerCard::BgPlayerCardBig);
		$this->addCardElement($this->titleBg);
		
		$this->title = new Label($sizeX - 2);
		$this->title->setPosition(2.5, -5.7, 2);
		$this->title->setTextColor('aaa');
		$this->title->setTextSize(2);
		$this->title->setText('No description');
		$this->addCardElement($this->title);
		
		$this->icon = new  Icons128x128_1(5.5);
		$this->icon->setPosition(1, -2.3, 1);
		$this->icon->setAlign('center', 'center');
		$this->addCardElement($this->icon);
		
		$this->version = new Label(50);
		$this->version->setPosition(4, -1.3, 2);
		$this->addCardElement($this->version);

		$this->author = new Label(30);
		$this->author->setHalign('right');
		$this->author->setPosition(68, -1.3, 2);
		$this->addCardElement($this->author);
	}
}

?>