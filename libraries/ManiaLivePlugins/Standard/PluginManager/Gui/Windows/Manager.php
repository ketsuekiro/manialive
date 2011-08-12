<?php
/**
 * Plugin Manager - Plugin mades to load or unload ManiaLive plugins
 * 
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision$:
 * @author      $Author$:
 * @date        $Date$:
 */

namespace ManiaLivePlugins\Standard\PluginManager\Gui\Windows;

use ManiaLive\PluginHandler\PluginHandler;

use ManiaLivePlugins\Standard\PluginManager\Gui\Controls\Plugin;
use ManiaLive\Gui\Windowing\Controls\Pager;
use ManiaLib\Gui\Elements\Label;
use ManiaLive\Gui\Windowing\Controls\Panel;

class Manager extends \ManiaLive\Gui\Windowing\ManagedWindow
{
	protected $label;
	protected $pager;
	
	static function CreateFromPlugins($login, $plugins)
	{
		$window = parent::Create($login);
		
		$window->pager->clearItems();
		foreach ($plugins as $class)
		{
			$id = PluginHandler::getPluginIdFromClass($class);
				$plugin = new Plugin(PluginHandler::getPluginIdFromClass($class),
				PluginHandler::getInstance()->isPluginLoaded($id), $class);
			
			$window->pager->addItem($plugin);
		}
		
		return $window;
	}
	
	function initializeComponents()
	{	
		$this->setTitle('Plugin Manager');
		$this->setMaximizable();
		
		$this->label = new Label();
		$this->label->setPosition(3, 7);
		$this->label->enableAutonewline();
		$this->addComponent($this->label);
		
		$this->pager = new Pager();
		$this->pager->setPosition(2, 14);
		$this->pager->setStretchContentX(true);
		$this->addComponent($this->pager);
	}
	
	function onDraw()
	{
		$count = 0;
		$updates = PluginHandler::getInstance()->getRepositoryUpdates();
		
		foreach ($updates as $update)
		{
			$count += count($update->plugins);
		}
		
		$text = 'This helps you load and unload plugins that are stored on your computer.' . "\n";
		
		if ($count > 0)
		{
			$text .= 'There are $<$0f0' . $count . ' new updates$> available for the plugins that your are running!';
		}
		else
		{
			$text .= 'All your plugins seem to be up to date.';
		}
		$this->label->setText($text);
	}
	
	function onResize()
	{
		$this->label->setSizeX($this->sizeX - 6);
		$this->pager->setSize($this->sizeX - 4, $this->sizeY - 16);
	}
	
	function clearPlugins()
	{
		$items = $this->pager->clearItems();
		foreach ($items as $item) $item->destroy();
	}
	
	function addPlugin(Plugin $plugin)
	{
		$this->pager->addItem($plugin);
	}
}
?>