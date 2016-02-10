# Windowing Example #

## WindowExample.php ##
Plugin that will display the 'SimpleWindow' to any player that joins the server.
```
<?php

// namespace as of php 5.3
// see also the 'Conventions for Creating Plug-Ins'
// and 'The Libraries-Folder Structure'
namespace ManiaLivePlugins\Examples\WindowExample;

// renaming
use ManiaLivePlugins\Examples\WindowExample\Gui\Windows\SimpleWindow;

// see the 'Conventions for Creating Plug-Ins' on what class name to use
class WindowExample extends \ManiaLive\PluginHandler\Plugin
{
	function onInit() {}
	
	function onLoad()
	{
		// enable the server callbacks so we can trigger
		// the window creation when a new player joins
		$this->enableDedicatedEvents();
	}
	
	function onPlayerConnect($login, $isSpectator)
	{
		// use the factory to create a new window for player
		// that just joined our server.
		$window = SimpleWindow::Create($login);
		
		// modify the window's height from the default size
		$window->setSizeY(13);
		
		// set some properties that have been attached.
		$window->setTitle('Welcome');
		$window->setText("Welcome on my server,\nI hope you enjoy your stay!");
		
		// center the window on the screen and display it.
		$window->centerOnScreen();
		$window->show();
	}
}

?>
```

## SimpleWindow.php ##
A window, that consists of a title bar and some text as content.
```
<?php
// this line defines the namespace, this needs to match the relative path to
// where your file is located, in general you only need to change the part
// marked in yellow.
namespace ManiaLivePlugins\Examples\WindowExample\Gui\Windows;

// you need to rename every component, that you are using in the code.
// for more elements to use, you can check the
// “Important Namespaces and its Classes”-section.
use ManiaLib\Gui\Elements\Icons64x64_1;
use ManiaLib\Gui\Elements\Label;

// here the actual creation process starts.
// important: don’t forget to inherit the Window class.
// in this case we are extending the ManagedWindow, this will
// automatically put the window background and a cross to close it.
class SimpleWindow extends \ManiaLive\Gui\ManagedWindow
{
	// protected properties for every component that you add to your window.
	// note: you can set public here to be able to access them from outside
	// the class. it’s faster, but architecture doesn’t like it ...
	protected $text;

	// the described initializeComponents method. Called on the first time
	// the window is used.
	// we initialize the components and add them to the window, so once the
	// window is rendered, all its components will be too.
	protected function onConstruct()
	{
		// calling parent method to create default elements
		parent::onConstruct()
		// set a default size for the window.
		$this->setSize(40, 30);

		// add a text to the window, we don’t define size and
		// position yet.
		$this->text = new Label();
		$this->text->enableAutonewline();
		$this->addComponent($this->text);
	}

	// we haven’t got stuff to do when the window is being closed.
	protected function onHide() {}

	// when the size of the window is changed we will also need to
        // resize all its components.
	protected function onResize($oldX, $oldY)
	{
		// position and resize text ...
		$this->text->setPosition(2, 6);
		$this->text->setSize($this->sizeX - 4, $this->sizeY - 6);
	}

	// setter for the message text, our components are protected, remember?
	function setText($text)
	{
		$this->text->setText($text);
	}
}
?>
```