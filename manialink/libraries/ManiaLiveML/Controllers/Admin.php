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

namespace ManiaLiveML\Controllers;

class Admin extends \ManiaLib\Application\Controller
{
	protected $defaultAction = 'publish';
	
	function onConstruct()
	{
		\ManiaLib\Authentication\Filter::setOnFailureCallbackParameters(array('Plugins', 'Locked'));
		\ManiaLib\Authentication\Filter::setOnFailureCallback(array($this->request, 'redirectManialink'));
		
		$this->addFilter(new \ManiaLib\Application\Filters\RegisterRequestParameters());
		$this->addFilter(new \ManiaLib\Authentication\Filter());
		$this->addFilter(new \ManiaLib\Application\Tracking\Filter());
	}
	
	protected function showLockScreen()
	{
		$this->request->redirectManialink('Home', 'Locked');
	}
	
	protected function validateUrl($url) 
	{
	    $pattern = "#^(http:\/\/|https:\/\/|www\.|//)*(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d{1,5}))?([A-Z0-9_-]|\.|\/|\?|\#|=|&|%)*$#i";
	    return (bool) preg_match($pattern, $url);
	}
	
	function publish()
	{
		$this->request->registerReferer();
		$this->response->editing = false;
		$plugin_id = $this->request->get('plugin_id');
		
		if ($plugin_id && is_numeric($plugin_id))
		{
			$playerlogin = $this->session->getStrict('login', 'You need to set a playerlogin if you want to edit a published Plugin!');
			
			$service = new \ManiaLiveML\Services\PluginService();
			$this->response->edited_plugin = $service->get((int) $plugin_id);
			
			if ($this->response->edited_plugin->author != $playerlogin)
				$this->request->redirectToReferer();
				
			$this->response->editing = true;
		}
	}
	
	function send()
	{
		$plugin = new \ManiaLiveML\Services\Plugin();
		if ($this->request->get('plugin_id'))
			$plugin->id = $this->request->get('plugin_id');
		$plugin->name = $this->request->get('name');
		$plugin->author = $this->session->getStrict('login');
		$plugin->addressMore = $this->request->get('addressMore');
		$plugin->category = $this->request->get('category');
		$plugin->address = $this->request->get('address');
		$plugin->version = $this->request->get('version');
		$plugin->description = $this->request->get('description');		
		
		// FIXME Convert evrything like the line above and find a nice way to keep the form filled
		// $plugin->name = $this->request->getStrict('name', 'You need to enter a name!');
		
		if (!$plugin->name || strlen($plugin->name) < 3)
		{
			$this->response->errorMsg = 'You need to enter a name that has at least three characters!';
			$this->response->success = false;
			return;
		}
		
		if (!$plugin->addressMore && !$plugin->description)
		{
			$this->response->errorMsg = 'You need to enter at least a description or a link where to find one!';
			$this->response->success = false;
			return;
		}
		
		if (!$plugin->address)
		{
			$this->response->errorMsg = 'You need to enter an address!';
			$this->response->success = false;
			return;
		}
		
		if (!$plugin->version)
		{
			$this->response->errorMsg = 'You need to enter a version!';
			$this->response->success = false;
			return;
		}
		
		if (!is_numeric($plugin->version))
		{
			$this->response->errorMsg = 'Version needs to be a number!';
			$this->response->success = false;
			return;
		}
		
		if (!$this->validateUrl($plugin->address))
		{
			$this->response->errorMsg = 'The download url that you have entered is not valid!';
			$this->response->success = false;
			return;
		}
		
		if ($plugin->addressMore && !$this->validateUrl($plugin->addressMore))
		{
			$this->response->errorMsg = 'You did not give a description and the web-url for the details is not valid!';
			$this->response->success = false;
			return;
		}
		
		$pluginService = new \ManiaLiveML\Services\PluginService();
		
		if ($this->request->get('plugin_id') && is_numeric($this->request->get('plugin_id')))
			$this->response->success = $pluginService->update($plugin);
		else
			$this->response->success = $pluginService->create($plugin);
	}
	
	function delete($plugin_id, $confirm = 0)
	{
		if (!$confirm)
		{
			$this->chainActionAndView('Plugins', 'Download');
			
			$dh = new \ManiaLib\Application\DialogHelper('\ManiaLib\Application\Views\Dialogs\TwoButtons');
			$dh->title = 'Confirm';
			$dh->buttonLabel = 'Delete';
			$this->request->set('confirm', 1);
			$dh->buttonManialink = $this->request->createLink(Route::CUR, Route::CUR);
			$dh->button2Manialink = $this->request->getReferer();
			$dh->message = "Are you sure, that you want to remove your plugin from the list?\nAttention: This can't be undone!";
			$this->response->registerDialog($dh);
		}
		else
		{
			$plugin = new \ManiaLiveML\Services\Plugin();
			$plugin->id = $plugin_id;
			
			$pluginService = new \ManiaLiveML\Services\PluginService();
			$pluginService->delete($plugin);
			
			// do the action ..
			$this->request->set('confirm', 0);
			$this->request->redirectManialink('Plugins', 'Download');
		}
	}
}

?>