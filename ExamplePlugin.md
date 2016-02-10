# Example Plugin #

## PluginExample.php ##
Contains examples how to interact with other plugins, use the storage class and also how plugins basically work.
```
<?php

namespace ManiaLivePlugins\Examples\PluginExample;

// this is a renaming, you could also write
// \ManiaLive\Utilities\Console::println() every time
// you use Console::println()
use ManiaLive\Utilities\Console;

// contains a few string helper functions for trackmania
use ManiaLive\Utilities\String;

// the class its name will be the name of the plugin.
// the file that contains the class will need to have the same name.
class PluginExample extends \ManiaLive\PluginHandler\Plugin
{
	function onInit()
	{
		// this needs to be set in the init section
		$this->setVersion(1.0);
	}
	
	function onLoad()
	{
		// we need to explicitly enable the storage events,
		// see the events section in the ManiaLive DeveloperDocs.
		$this->enableStorageEvents();
		
		// register a chat command so a player can send a private message to another one.
		// this will only work if the WindowExample plugin has been loaded.
		if ($this->isPluginLoaded('Examples\WindowExample', 1))
			$this->registerChatCommand('sendmsg', 'chatSendMessage', 2, true);
	}
	
	// when we registered the command we set the forth parameter to true, which means
	// that we want the login of the player that used the chat command as first parameter.
	// further more we said that we expect two parameters, which are also delivered.
	function chatSendMessage($login, $target_login, $message)
	{
		// we can also use the storage class to get a specific
		// player by its login. You can do much more with it!
		$source_player = $this->storage->getPlayerObject($login);
		
		// and send a window using the plugin to each of them.
		// see the WindowExample on how the interface is set up.
		$this->callPublicMethod(
			'Examples\WindowExample',
			'displayWindow',
			$target_login,
			'Message from ' . String::stripAllTmStyle($source_player->nickName),
			$message
		);
	}
	
	function onPlayerNewBestTime($player, $best_old, $best_new)
	{
		// prepare a message
		$message = 'Player ' . String::stripAllTmStyle($player->nickName) . ' just drove a new personal best time!';
		
		// see whether the WindowExample has been loaded at least at version 1
		if ($this->isPluginLoaded('Examples\WindowExample', 1))
		{
			// if it has, then first we need to get every player from the storage class
			foreach ($this->storage->players as $player)
			{
				// and send a window using the plugin to each of them.
				// see the WindowExample on how the interface is set up.
				$this->callPublicMethod(
					'Examples\WindowExample',
					'displayWindow',
					$player->login,
					'Best Time!',
					$message
				);
			}
		}
		else
		{
			// if there is no WindowExample plugin, then send a message on console.
			$this->connection->chatSendServerMessage($message);
		}
	}
}
?>
```