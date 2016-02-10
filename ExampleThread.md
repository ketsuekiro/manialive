# Threading Example #

## ThreadingExample.php ##
This plugin creates lots of work and then assignes it to a thread.
If threading is enabled you will realize that the loop is still executed very often.
You can now try to disable threading, then you will see how the main application and its reaction time would be effected.
```
<?php

// it is important to put plugins into the right namespace
// otherwise they can't be loaded!
// see 'The Libraries-Folder Structure' and 'Conventions for Creating Plugins'
// in the developer doc.
namespace ManiaLivePlugins\Examples\ThreadingExample;

// rename \ManiaLive\Threading\ThreadHandler to just ThreadHandler.
// see php manual for at least 5.3 in namespaces.
use ManiaLive\Threading\ThreadHandler;

// the class' name has to be the same as the name of the file.
// see the 'Conventions for Creating Plug-ins' in the developer doc.
class ThreadingExample extends \ManiaLive\PluginHandler\Plugin
{
	private $started = 0;
	private $threadId;
	
	function onInit() {}
	
	function onLoad()
	{
		// we need to enable the application events in order
		// to be notified of the onPreLoop event.
		$this->enableApplicationEvents();
		
		// this command launches a new thread for our jobs.
		$this->threadId = ThreadHandler::getInstance()->createThread();
	}
	
	// occures every time the application has finished a loop.
	// that means that it has reacted on gui interaction, server
	// callbacks etc.
	function onPreLoop()
	{
		$this->writeConsole('one loop!');
	}
	
	// once all plugins are loaded we start
	// to create our workload.
	function onReady()
	{
		$threadHandler = ThreadHandler::getInstance();
		for ($i = 0; $i < 100; $i++)
		{
			// we initialize a instance of our dirty work runnable.
			$work = new DirtyWork(1000000);
			
			// and we send every one to the thread we started above.
			// second parameter defines the method that will be
			// invoked when the work has been completed.
			$threadHandler->addTask($work, 'onWorkDone');
			
			// count the work instances.
			++$this->started;
		}
	}
	
	function onWorkDone($command)
	{
		// counting down, if we haven't any left, then
		// we have finished all the jobs!
		if (--$this->started == 0)
			$this->writeConsole('All jobs have been done!');
		else
			$this->writeConsole("{$this->started} threads remain ...");
	}
}
?>
```

## DirtyWork.php ##
An instance of this class can be sent to any thread that is running.
If does nothing more than counting.
```
<?php

// namespace as in the ThreadingExample.php because
// the files are in the same folder!
namespace ManiaLivePlugins\Examples\ThreadingExample;

// every class that will be send to another process
// needs to extend the runnable class and overwrite
// its run() method.
class DirtyWork implements \ManiaLive\Threading\Runnable
{
	// you can have parameters.
	public $max;
	
	// you can have constructors.
	function __construct($max)
	{
		$this->max = $max;
	}
	
	// this is the code that is executed on the
	// threading dedicated process.
	function run()
	{
		$i = 0;
		while ($i < $this->max)
		{
			$i++;
		}
	}
}
?>
```