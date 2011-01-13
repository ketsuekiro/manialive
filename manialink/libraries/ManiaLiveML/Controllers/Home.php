<?php

namespace ManiaLiveML\Controllers;

class Home extends \ManiaLib\Application\Controller
{
	protected $defaultAction = 'about';
	
	function onConstruct()
	{
		$this->addFilter(new \ManiaLib\Application\Filters\RegisterRequestParameters());
		$this->addFilter(new \ManiaLib\Application\Tracking\Filter());
	}
	
	function about() {}
	
	function features() {}
	
	function download() {}
}


?>