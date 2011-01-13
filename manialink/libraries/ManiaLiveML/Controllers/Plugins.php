<?php

namespace ManiaLiveML\Controllers;

class Plugins extends \ManiaLib\Application\Controller
{
	protected $defaultAction = 'download';
	
	function onConstruct()
	{
		$this->addFilter(new \ManiaLib\Application\Filters\RegisterRequestParameters());
		$this->addFilter(new \ManiaLib\Application\Tracking\Filter());
	}
	
	function download()
	{
		$login = $this->session->get('login');
		$category = $this->request->get('category');
		if ($category == -1) $category = null;
		
		$this->request->registerReferer();
		
		$pluginService = new \ManiaLiveML\Services\PluginService();
		$count = $pluginService->countAll($category);
		
		$multipageList = new  \ManiaLib\Utils\MultipageList(4);
		$multipageList->setSize($count);
		
		list($offset, $length) = $multipageList->getLimit();
		
		$plugins = $pluginService->getList($offset, $length, $category);
		
		$this->response->category = $category;
		$this->response->playerlogin = $login;
		$this->response->plugins = $plugins;
		$this->response->multipage = $multipageList;
	}
	
	function details($id)
	{
		$pluginService = new \ManiaLiveML\Services\PluginService();
		$plugin = $pluginService->get($id);
		
		$this->response->plugin = $plugin;
	}
	
	function locked()
	{
		
	}
	
	function search()
	{
		$this->request->registerReferer();
		
		$nosearch = $this->request->get('nosearch');
		$name = $this->request->get('name');
		$author = $this->request->get('author');
		$vmin = $this->request->get('vmin');
		$vmax = $this->request->get('vmax');
		
		$this->response->search = ($name || $author || $vmax || $vmin) && (!$nosearch);
		
		$this->response->name = $name;
		$this->response->author = $author;
		$this->response->vmax = $vmax;
		$this->response->vmin = $vmin;
		
		if ($this->response->search)
		{
			$name = '%' . $name . '%';
			$author = '%' . $author . '%';
			if ($vmin == '') $vmin = 0;
			if ($vmax == '') $vmax = 1000;
			
			$pluginService = new \ManiaLiveML\Services\PluginService();
			$count = $pluginService->countSearch($name, $author, $vmin, $vmax);
			
			$multipageList = new \ManiaLib\Utils\MultipageList(4);
			$multipageList->setSize($count);
			
			list($offset, $length) = $multipageList->getLimit();
			
			$this->response->all = $count;
			if ($multipageList->getPageNumber() == 1)
			{
				$this->response->start = 1;
				$this->response->end = $this->response->all;
			}
			elseif ($multipageList->getCurrentPage() == $multipageList->getPageNumber())
			{
				$this->response->start = $offset + 1;
				$this->response->end = $this->response->all;
			}
			else
			{
				$this->response->start = $offset + 1;
				$this->response->end = $offset + $length;
			}
			
			$this->response->plugins = $pluginService->search($offset, $length, $name, $author, $vmin, $vmax);
			$this->response->multipage = $multipageList;
		}
	}
}

?>