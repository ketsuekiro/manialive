# History of Changes #

## Version 1.0 ##
Initial release, no changes!

## ManiaLive 1.0b - [r1453](https://code.google.com/p/manialive/source/detail?r=1453) (29 dec. 2010) ##
  * Player object is not destroy on disconnection but at the end of the loop
  * Possibility to send message in different languages (chatSendServerMessageToLanguage & chatSendToLanguage) to a list of player (just put the list as a second argument)
  * Checking for updates regularly.
  * Error reporting is set on startup.
  * plugins can be in subpackages/folders.
  * added method to force z position for a control
  * removed debug messages


## ManiaLive 1.0b - [r1462](https://code.google.com/p/manialive/source/detail?r=1462) (1 jan. 2011) ##
  * added automatic database keep-alive.
  * added method to convert rank to string to the Utilities\String class.
  * chat commands are no longer case sensitive.
  * added "man" command
  * fixed [issue 2](https://code.google.com/p/manialive/issues/detail?id=2): http://code.google.com/p/manialive/issues/detail?id=2&can=1

## ManiaLive 1.0b - [r1545](https://code.google.com/p/manialive/source/detail?r=1545) (4 jan. 2011) ##
  * CRT [issue 10](https://code.google.com/p/manialive/issues/detail?id=10): http://code.google.com/p/manialive/issues/detail?id=10
  * addDependency [issue 9](https://code.google.com/p/manialive/issues/detail?id=9): http://code.google.com/p/manialive/issues/detail?id=9
  * sendBill [issue 8](https://code.google.com/p/manialive/issues/detail?id=8): http://code.google.com/p/manialive/issues/detail?id=8
  * cancelVote [issue 7](https://code.google.com/p/manialive/issues/detail?id=7): http://code.google.com/p/manialive/issues/detail?id=7
  * execute call optimisation
  * fixed callPublicMethod to return result.

## ManiaLive 1.0b - [r1627](https://code.google.com/p/manialive/source/detail?r=1627) (5 jan. 2011) ##
  * fixed [issue 6](https://code.google.com/p/manialive/issues/detail?id=6).
  * refixed [issue 8](https://code.google.com/p/manialive/issues/detail?id=8).
  * fixed [issue 11](https://code.google.com/p/manialive/issues/detail?id=11).
  * added method to request constructor method for the control class.
  * fixed a bug when a spectator could not close a window.
  * added possibility to set dependency on a specific manialive version.

## ManiaLive 1.0b - [r1685](https://code.google.com/p/manialive/source/detail?r=1685) (6 jan. 2011) ##
  * clean code to respect guidelines
  * add Filter module abstraction (see http://fr2.php.net/manual/en/book.filter.php) (can be used to check command line parameters)
  * added automatic update script
  * changed the run scripts to use a centralized php path (run.ini)
  * fixed issue in the Thread.php: 'Index unknown'
  * fixed bug when spectator could not interact with windowing system (may be related to [issue 13](https://code.google.com/p/manialive/issues/detail?id=13)).

## ManiaLive 1.0b - [r1830](https://code.google.com/p/manialive/source/detail?r=1830) (13 jan. 2011) ##
  * manialib has been moved to its own library folder and is completely independent now.
  * fixed issues in the updater script.
  * updater script is now user interactive.
  * improved windowing performance.

## ManiaLive 1.0b - [r2028](https://code.google.com/p/manialive/source/detail?r=2028) (25 jan. 2011) ##
  * secured require\_once in the autoload method
  * now plugins class can be named Plugin (e.g: the full class name will be \ManiaLivePlugins\MyName\MySuperPluginName\Plugin)
  * add unregister method to ChatCommand\Interpreter
  * Plugins can now be loaded and unloaded while running
  * add onUnload method called when plugin is unset
  * Implemented new threading methods for plugins
  * automatic plugin destruction and freeing of resources that have been required through the plugin interface.
  * ManagedWindow, will be displayed on screen center. Only one ManagedWindow can be shown at a time. Every further window will be moved into the "Taskbar" for fast access.
  * Windowing system speed and stability improvements.
  * Fixed memory leaks.
  * Plugin events for loading and unloading.


## ManiaLive 1.0b - [r179](https://code.google.com/p/manialive/source/detail?r=179) (7 feb. 2011) ##
  * dialog window now uses autonewline.
  * windowhandler has been updated.
  * general architectural improvements of the windowing system.
  * managedwindow will now always have background and window border with buttons.
  * managedwindows can be maximized.
  * windows can be buzzed now, which will generate blue flashing.
  * dialog windows can be displayed without reference/parent windows.
  * renamed onShow to onDraw and onRecover to onShow.
  * threads have access to the Loader::config values now - introduced data sending to threads.
  * using new run script for linux using hand-detaching instead of ssdaemon
  * features new manialib version.
  * fixed [issue 14](https://code.google.com/p/manialive/issues/detail?id=14) uses login now instead id.
  * when calling public methods of plugins the pluginid is added as last parameter now.
  * from the next release on version numbering will happen based on the google code revision.

## ManiaLive 1.0b - [r189](https://code.google.com/p/manialive/source/detail?r=189) (15 feb. 2011) ##
  * implemented f7 shortcut to hide/show all windows.
  * use webservice to compare manialive version.
  * updated the automatic update script to get the manialive version and downloadurl from the webservice.
  * use webservices to get new plugin updates from the remote repository.
  * implmented time sanity checks into the storage class.
  * preformance improvements.
  * swapped to newer version of manialib.
  * edited callvote in connection to be more dynamic.
  * improved panel control.
  * performance and architecture updates.

## ManiaLive 1.0b - [r194](https://code.google.com/p/manialive/source/detail?r=194) (24 feb. 2011) ##
  * add compatibility with server build.
  * add the currentVote to the storage class.
  * fixed bug when loading single plugins, that a new version has been announced.
  * implemented cache and integrated it into plugin architecture.
  * plugin errors in onLoad won't crash whole manialive anymore.
  * version checks are failsafe now.
  * implemented onPlayerFinishLap event in storage class.

## ManiaLive 1.0b - [r209](https://code.google.com/p/manialive/source/detail?r=209) (4 apr. 2011) ##
  * add exists method to Cache
  * fix some bug in window handler
  * add LAN mod to disable updater
  * use login instead of playerId for method ignore and blacklist
  * change help display behaviour
  * change register chatCommand behaviour, is command parameter is null, command is automatically registered from the number of required parameters to the number of optional parameters
  * update ManiaLib version included in ManiaLive

## ManiaLive 1.0 - [r214](https://code.google.com/p/manialive/source/detail?r=214) (5 may 2011) ##
  * correct bug in forceMod method
  * correct error reported by 4lturbo http://forum.maniaplanet.com/viewtopic.php?f=46&t=765&start=10#p14759
  * change algorithm to allow the creation of an offline guest
  * add system compatibility on runtime
  * fix bugs in storage engine in lap mod
  * change manialib revision used to [revision 493](https://code.google.com/p/manialive/source/detail?r=493)
  * Remove package Filter in ManiaLive/Utilities, duplicate code with ManiaLib/Filters (it may represent a compatibility break with some plugins)
  * Refactor Singleton class ManiaLive\Utilities\Singleton is now deprecated use ManiaLib\Utils\Singleton instead

## ManiaLive 1.0 - [r223](https://code.google.com/p/manialive/source/detail?r=223) (31 may 2011) ##
  * improve utf-8 support in TM String stripping
  * update ManiaLib Version
  * improve data update (improvement submit by oliverde8 http://forum.maniaplanet.com/viewtopic.php?f=46&t=1235&p=20664#p20633)
  * correct [issue 31](https://code.google.com/p/manialive/issues/detail?id=31), ChatSendMessage now use login to send message to one player
  * update ManiaHome Client to use the latest version of the API
  * correct Storage class to have a better support of the lap mod