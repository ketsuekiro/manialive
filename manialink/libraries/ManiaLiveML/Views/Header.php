<?php

namespace ManiaLiveML\Views;

use ManiaLib\Gui\Elements\Quad;

class Header extends \ManiaLib\Application\Views\Header
{
	function display()
	{
		\ManiaLib\Gui\Manialink::load();
		
		$ui = new Quad();
		$ui->setImage('cloudsonly.jpg');
		$ui->setSize(128, 96);
		$ui->setAlign('center', 'center');
		$ui->save();
	}
}

?>