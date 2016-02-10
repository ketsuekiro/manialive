

# Folder Structure #

To be able to develop plug-ins for ManiaLive you need to understand how files are arranged.
Open the ManiaLive folder and take a look at what you find inside:<br>
<b>config</b> : contains the configuration file(s).<br>
<b>data</b> : holds files/sqlite databases for threading.<br>
<b>libraries</b> : contains all code (core and plug-ins) of ManiaLive.<br>
<b>logs</b> : self-explanatory, by default contains all log-files that are generated.<br>
In the next step we take a closer look onto the libraries folder. It contains “ManiaLib”, “ManiaLive” and “Maniaplanet” packages. At last you can also find a folder in there called “ManiaLivePlugins”, that of course is where you will begin writing.<br>
<br>
<h1>General Conventions</h1>

<b>Please read these conventions carefully before creating a plugin!</b><br>
It will save you a lot of work - it might not be possible for you to publish your plugin later if you did not respect the conventions!<br>
<br>
<ol><li><a href='http://en.wikipedia.org/wiki/CamelCase'>CamelCase</a> naming for classes.<br>
</li><li>Methods and properties are <a href='http://en.wikipedia.org/wiki/CamelCase'>CamelCase</a> but with lower case first letter.<br>
</li><li>Use namespaces instead of include or require statements!<br>In order for a class to be loaded automatically you need to stick to the following rules.<br>
</li><li>Class names are case sensitive and every word in the name starts with a capital letter.<br>
</li><li>Namespaces are folders in the file-system, so if you create a new class, make sure it is located in the right namespace!<br>
</li><li>Classes have to be in files that have the same name and end with .php<br>class ManiaLive\Example will be in the file Example.php in the folder ManiaLive.</li></ol>

<h1>The ManiaLivePlugins-Folder Structure</h1>

The “ManiaLivePlugins” folder will contain only sub-folders named after plug-in authors. Each of them contains sub-folders named after the plugins themselves and in each of those folders you will find at least a php file that is named like the folder it is contained by, so for instance:<br>
ManiaLivePlugins/Bob/Dedimania/Dedimania.php<br>
Will be the main file for the plugin named “Dedimania” and who's author is “Bob”.<br>
It is a good habit to always use the same author name. One way to avoid collisions with other plug-in authors is to use the unique Trackmania login.<br>
In ManiaLive sometimes there is used a plugin's id. This consists of the author name of the plug-in, a backslash and the name of the plugin (eg. Bob\Dedimania).<br>
Within the folder of a plugin you can create your own file structure (you are restricted to use some conventions listed below).<br>
<br>
<h1>Conventions for Creating Plugins</h1>

<ol><li>Every Plug-in needs to be located in the “ManiaLivePlugins" folder.<br>
</li><li>In “ManiaLivePlugins” there has to be a folder named after the plug-in's author.<br>
</li><li>A plug-in is situated in a folder named after the plugin's author. As for author name it is recommended to use the TM login to avoid naming collisions with other authors.<br>
</li><li>A Plug-in consists of a folder with the name of the plug-in.<br>
</li><li>In the folder, that is named like the plugin, there has to be a file which is named after the plugin with “.php” extension.<br>
</li><li>This file needs to have a definition for a class that also has the name of the plug-n.<br>
</li><li>The class, which has got the plugin's name, has to be inherited from the ManiaLive\PluginHandler\Plugin class.</li></ol>

<h1>Loading a Plug-in</h1>

You can load a plug-in that has been created using the conventions above by simply adding a line into your “config.ini”:<br>
manialive.plugins<a href='.md'>.md</a> = <b>Bob\Dedimania</b><br>
The bold text has to be replaced by the ID of your plugin, which is described in “The Plugin's Folder Structure”.<br>
To see what configuration is loaded check the Loader_pid.txt log in your logs folder.<br>
<br>
<h1>The Plug-in Class</h1>

<b>\ManiaLive\PluginHandler\Plugin</b> is the base class for all plugins and provides the interface for all events that can occur.<br>
There are many helper methods that are built into the Plug-in class for beginners to keep ways short. If you are an experienced programmer, you can figure out how to use the different components that are wrapped into the helpers yourself.<br>
When you create your plug-in, you can specify how the loader will be treating it during the load process.<br>
<br>
<h2>Set Plug-in Version</h2>

It is a good habit to increase a plug-in’s version number with every release and change of its features. This way all depending plugins know if they might not be supporting the current version anymore.<br>
Setting a version number is done by using the <b>setVersion(mixed $version)</b> method.<br>
<br>
<h2>Add Dependencies</h2>

If your plugin is using functionalities of a currently existing one, you can easily add a dependency to this.<br>
All dependencies are mandatory, so if a plugin, that has been added to the dependency list is not loaded - due to whatever - also every depending plugin will fail to load.<br>
To add a dependency, use the following sample:<br>
<br>
<pre><code>$dependency = new Dependency('Author\Plugin', 1, 2);<br>
$this-&gt;addDependency($dependency);<br>
</code></pre>

<h1>Make a Plug-in Configurable</h1>

If you want to be able to configure your plugin from the global config.ini, then all you will have to declare another class inheriting from ManiaLib\Utils\Singleton and defining public attributes. Usually, using Config as class name is a good idea<br>
For instance you declare a class like that:<br>
<pre><code>&lt;?php<br>
namespace ManiaLivePlugins\Example\Foobar;<br>
<br>
class Config extends \ManiaLib\Utils\Singleton<br>
{<br>
	public $setting = 0;<br>
}<br>
?&gt;<br>
</code></pre>
Now you could add a line in your config.ini<br>
<pre><code>ManiaLivePlugins\Example\Foobar\Config.setting = 42<br>
</code></pre>
and your property would be overwritten when loading the plugin!<br>
Easy, right?<br>
<br>
<h1>Events</h1>

If you have created the plugin file regarding the “Conventions for Creating Plugins” and added a line to the config.ini to load it, it won't be doing anything yet.<br>
One of the core components of ManiaLive is the event dispatching system.<br>
All of the plugin's interaction is triggered by some event taking place in the core components.<br>
When a plugin is loaded it is being hooked to the so called Dispatcher.<br>
To react on events you simply need to define a method in your class with the corresponding name, that will be called every time this event occurs.<br>
<b>Every plugin will only be notified of the event types that it is enabled for.</b><br>
On start-up the only events that will be received are the “Plugin Events”, any other category needs to be enabled.<br>
In the following the different event types and its corresponding event methods are described.<br>
<br>
<h2>Plugin Events</h2>

<h3>onInit()</h3>
Called before the plugin is actually loaded and registered for any events. After onInit is executed the loading process can still fail. This is why <b>onInit</b> should only be used to define plugin specific properties that are important for the loading process. This can for instance be the version number or dependencies.<br>
<br>
<h3>onLoad()</h3>
Your plugin has been accepted, but not all plugins have been loaded yet.<br>
So if you want to interact with some other plugin, this is still the wrong place.<br>
<br>
<h3>onReady()</h3>
Plugin loading is completely finished. If you now want to access interfaces of other plugins, this is the right place to do it.<br>
<br>
<h2>Application Events</h2>

Disabled by default.<br>
Enable them in the plugin's <b>onLoad</b> or <b>onReady</b> event:<br>
<pre><code>$this-&gt;enableApplicationEvents();<br>
</code></pre>
<h3>onRun()</h3>
Is triggered directly after <b>onReady</b>, the only difference is that you need to enable the application events.<br>
<br>
<h3>onPreLoop()</h3>
The ManiaLive application is one big loop of instructions which is repeated up to 60 times per second. <b>onPreLoop</b> is executed on begin of every round, putting any code here can drastically decrease the performance of your application, so be aware!<br>
<br>
<h3>onPostLoop()</h3>
Is executed on every loop's round end.<br>
See <b>onPreLoop</b> for more details.<br>
<br>
<h3>onTerminate()</h3>
Executed when application is terminating in the usual way.<br>
<br>
<h2>Dedicated Server Events</h2>

Disabled by default.<br>
Enable them in the plug-in's <b>onLoad</b> or <b>onReady</b> event:<br>
<pre><code>$this-&gt;enableDedicatedEvents();<br>
</code></pre>
You can find a detailed explanation of the dedicated server's events in the “ListCallbacks.html” in the same folder as the “TrackmaniaServer.exe“ can be found.<br>
To get the corresponding method for a callback, you just prefix the callback's name with an “on”. The callback “PlayerConnect” for instance becomes <b>onPlayerConnect</b>.<br>
Parameters remain unchanged.<br>
<br>
<h2>Threading Events</h2>

Disabled by default.<br>
Enable them in the plugin's <b>onLoad</b> or <b>onReady</b> event:<br>
<pre><code>$this-&gt;enableThreadingEvents();<br>
</code></pre>

<h3>onThreadStart($threadId)</h3>
A Thread has been started successfully.<br>
<br>
<h3>onThreadDies($threadId)</h3>
A thread that is not busy did not respond to a ping within a given time window.<br>
It will be restarted.<br>
<br>
<h3>onThreadTimesOut($threadId)</h3>
Thread has been working for too long and is not responding.<br>
Will be killed and restarted.<br>
<br>
<h3>onThreadRestart($threadId)</h3>
A thread that has either died or timed out is restarted.<br>
<br>
<h3>onThreadKilled($threadId)</h3>
A thread has been closed on purpose<br>
<br>
<h2>Storage Events</h2>

Disabled by default.<br>
Enable this in the plugin's <b>onLoad</b> or <b>onReady</b> event:<br>
<pre><code>$this-&gt;enableStorageEvents();<br>
</code></pre>

<h3>onPlayerNewBestScore($player, $scoreOld, $scoreNew)</h3>
Player got a new best score on the current track.<br>
<br>
<h3>onPlayerNewBestTime($player, $bestOld, $bestNew)</h3>
Player drove a new best time on the current track.<br>
<br>
<h3>onPlayerNewRank($player, $rankOld, $rankNew)</h3>
Player climbed up or moved down in the rankings table of the current track.<br>
<br>
<h2>Ticker Event</h2>

Disabled by default.<br>
Enable this in the plug-in's <b>onLoad</b> or <b>onReady</b> event:<br>
<pre><code>$this-&gt;enableTickerEvent();<br>
</code></pre>

<h3>onTick()</h3>
Occurs every second.<br>
<br>
<h1>Console and Logging</h1>

For the purpose of displaying text on the screen, there is the <b>writeConsole(string $text)</b> helper method that is inherited with the Plugin class. To log text into a plug-in specific log file, use the <b>writeLog(string $text)</b>.<br>
Never use the print or echo functions directly, because if necessary the intern Console class is going to write into the log file. For more freedom, you can also use the <b>\ManiaLive\Utilities\Console</b> and <b>\ManiaLive\Utilities\Logger</b> classes directly.<br>
<br>
<h1>Plugin Interaction</h1>

To interact between Plugins, you can use the intern method <b>setPublicMethod(string $method)</b> to expose a method from the plug-in to other loaded plug-ins. Plugins normally don't have access to each other, except you explicitly set a method to public.<br>
Once that is done, you can use <b>callPublicMethod(string $plugin_id, string $method, mixed $arg1, mixed $arg2, ...)</b> to call a method from another plugin, that has been set public before – of course.<br>
To check whether the plugin exists, you can call <b>isPluginLoaded(string $pluginId, mixed $min, mixed $max)</b> before, instead of adding the plugin to the dependencies list.<br>
You should avoid adding dependencies as much as possible. Leave the parameters min and max out if you do not care about plugin's version.<br>
<br>
<h1>Storage Usage</h1>

The storage class, is used to avoid you to send request to the server to get datas. This class contain the following properties:<br>
<br>
<ul><li><b>players</b> : which is an array containing <b>\ManiaLive\DedicatedApi\Structures\Player</b> detailed information. Those players are the people playing the current track and not those in spectator mod.<br>
</li><li><b>spectators</b> : this is an array containing <b>\ManiaLive\DedicatedApi\Structures\Player</b> detailed information.<br>Those players are the people connected as spectator on the server.<br>
</li><li><b>maps</b> : is an array of <b>\ManiaLive\DedicatedApi\Structures\Map</b>.<br>Those maps are the current tracks set on the server.<br>
</li><li><b>currentMap</b>: is a <b>\ManiaLive\DedicatedApi\Structures\Map</b> representing the current track<br>
</li><li><b>nextMap</b>: is a <b>\ManiaLive\DedicatedApi\Structures\Map</b> representing the next track, except if a restart challenge is done.<br>
</li><li><b>server</b>: is a <b>\ManiaLive\DedicatedApi\Structures\ServerOptions</b> which represents sur value in Config file of the dedicated server<br>
</li><li><b>gameInfos</b>: is a <b>\ManiaLive\DedicatedApi\Structures\GameInfos</b> which contains every information about the current game.<br>
</li><li><b>serverStatus</b>: is a <b>\ManiaLive\DedicatedApi\Structures\Status</b>. It indicate whether the server is stopped, or running<br>
</li><li><b>serverLogin</b>: is a string containing the login of the dedicated server.</li></ul>

Each property is updated when an event is fired by the dedicated server. This class is the first called by the ManiaLive core when it received a callback, so it’s data are allways up to date. If a data is stored in the storage system you shouldn’t need to call the server to get it. This class should be used as a read only system, do not try to edit or insert some data in any property.<br>
<br>
<h1>Chat Commands</h1>

You want to have interaction between the people on your dedicated server and ManiaLive, then using chat commands will be the first and simplest step!<br>
The Plugin class once again offers an easy wrapper function to have callbacks executed when a specific command is entered in the game.<br>
<b>\ManiaLive\Features\ChatCommand\Command registerChatCommand(string $commandName, string $callbackMethod, integer $parameterCount = 0, boolean $addLogin = false, array $authorizedLogin = array())</b>
This might be almost self explanatory. First parameter takes the chat command, without the “/”, that needs to be entered in game. Second parameter is the name of the method that is executed. parameterCount defines how many parameters are expected after the command, separated by spaces. These will be set as parameters for the callback. If add login is set to true, then your callback additionally needs to have the login of the player as first parameter. authorizedLogin is an array of the players that are allowed to use your command. It is suggested to use the admin list that is managed in your config.ini. You can access it by using the <b>\ManiaLive\Features\Admin\AdminGroup</b> and call its static method <b>contains(string $login)</b> to check whether the player that has tried to use the chat command is registered to the admin group.<br>
<br>
<h1>Databases</h1>

Using a database connection with ManiaLive is pretty easy.<br>
There are two types of databases that are supported by the core:<br>
<ul><li>MySQL<br>
</li><li>SQLite</li></ul>

Both connections support the same interface and can be used in the same way.<br>
If you want to create a connection, then it is recommended to use the static <b>\ManiaLive\Database\Connection \ManiaLive\Database\Connection::getConnection(string $host, string $username, string $password, string $database, string $type, int $port)</b>
Should you require the same connection twice the currently established connection will be used instead of creating a new. If several plug-ins are using the same database, they ergo will share the connection.<br>
<br>
<h1>Utilities</h1>

There are yet two more classes in the \ManiaLive\Utilities namespace that haven't been mentioned yet. They each are a collection of useful functions that you should know about when using ManiaLive.<br>
<br>
<h2>Time</h2>

You can use the Time class to convert a Trackmania timestamp into a well formatted string.<br>
<pre><code>Time::fromTM($timestamp, $signed = false)<br>
</code></pre>
Setting the second parameter to true will look for a negative value and if so attach a dash to the front of the string.<br>
<br>
<h2>Validation</h2>

This collection of methods can validate different types of variable, from the simplest bool, int and float to more complex ones as regular expression, ip, url and email adress.<br>
<br>
<h1>ManiaLib Utils</h1>

There is also a useful class in ManiaLib/Utils to be mentionned<br>
<br>
<h2>Formatting</h2>

This collection of methods removes color codes from Trackmania strings. There are always places in the code where you want to display a name of a track or a player, but with a unified look and feel. So if you want to protect your layout from TM formatting, these are the functions to use.<br>
<br>
The most important function probably is<br>
<pre><code>String::stripColors($string)<br>
</code></pre>
which removes the color fromatting from a player's nick or a challenge name.<br>
Take a look in the code documentation for the other methods.<br>
<br>
<h1>Windowing System</h1>

Now that you know the basics of ManiaLive, the last thing you need to know is how to make your progress accessible to the big crowds on your server.<br>
The dedicated server allows us by passing it xml manialinks to draw an interface for specific players.<br />
ManiaLive brings this to a new level, you don’t have to know all details of formatting manialink pages and rendering them to xml. There are just three/four types of components that are used to draw elements onto the screen:<br>
<ul><li><b>Elements</b> are the smallest units that can be drawn.<br>If you want to compare them with anything, then they are just like files on your disk.<br>
</li><li><b>Controls</b> consist of several elements or once again controls itself.<br>They can be used to group <b>components</b> (which is the umbrella term for either elements or controls) and combine them with logic, this way they can result in a versatile and reusable object, that you will be able to share between all your projects.<br>Put into comparison, this would be folders in your hard drive.<br>
</li><li><b>Layouts</b>, finally, will help you with positioning of elements and controls.<br>You can apply Layouts to any Control and it will take care of the positioning of all it's subcomponents. They probably make most sense in combination with the <i>Frame</i> Control.<br>
</li><li><b>Windows</b> can contain components and additionally can be drawn onto the screen. They also offer helpers for positioning.</li></ul>

<h2>Creating a Window</h2>

You start by creating a PHP-file that is named just like the window. Usually this file is located in the plugin folder and within a ”Gui” and further more a “Windows” folder.<br>
The “Gui” folder is the super folder for all graphical components and thus contains the “Windows” folder, which is predestined for all Windows components.<br>
Editing this file you will create a class inside that has once again the name of the window (pay attention to case sensitive naming).<br>
Specified class will need to be inherited from <b>\ManiaLive\Gui\Window</b>, the base class for all windows.<br>
For windows there are four methods that can be overwritten, to define the behaviour and look of the window depending on what is happening:<br>
<br>
<h3>onConstruct()</h3>
This will be executed only once the window is being created the first time, you don’t need to draw it on the screen. It will be performed just the first time you are mentioning this window anywhere in your code. So this is the place where you should, as the name implies, construct the window.<br>
Components are added to a Window in two steps (this also applies for adding to a Control), first you instanciate the class, then you use the Window’s<br>
<b>addComponent(ManiaLib\Gui\Drawable $component)</b>-method to assign this component.<br>
Depending on whether the size of the Window is static or may be changed during the runtime you will position its components either in <b>onConstruct</b>, <b>onResize</b>, <b>onDraw</b> or even <b>onShow</b>.<br>
<br>
<h3>onResize($oldX, $oldY)</h3>
Called when the window's size is changed using one of the setSize(), setSizeX() or setSizeY() method.<br>
<br>
<h3>onMove($oldX, $oldY, $oldZ)</h3>
Called when the window is moved by a call to setPosition(), setPosition<a href='XYZ.md'>XYZ</a>() or setPos<a href='XYZ.md'>XYZ</a>()<br>
<br>
<h3>onDraw()</h3>
Is called every time the <b>draw()</b> method of the window is being called, thus on every refresh.<br>
If you want to scale and reposition your components, then do this here.<br>
<br>
<h3>onHide()</h3>
Called when the window is being removed from the screen.<br>
If you want to disable certain events while the window is not on the screen.<br>
<br>
<h3>onShow()</h3>
Executed whenever the window has been hidden and is recovered back to the displayed state.<br>
<br>
<h2>Important Namespaces and its Classes</h2>

For each of the existing component types there are already predefined namespaces that contain a set of helpful objects that were created during the use of ManiaLive until now.<br>
<br>
<h3>\ManiaLib\Gui\Elements</h3>

For a further description of these elements, see the ManiaLib documentation.<br>
The process of instantiating and using them should is almost the same, except you don’t call the save method, but the <b>addComponent($element_or_control)</b> method of the component that you want to draw it on.<br>
<ul><li><b>Audio</b>
</li><li><b>BgRaceScore2</b>
</li><li><b>Bgs1</b>
</li><li><b>Bgs1InRace</b>
</li><li><b>BgsChallengeMedals</b>
</li><li><b>BgsPlayerCard</b>
</li><li><b>Button</b>
</li><li><b>Element</b>
</li><li><b>Entry</b>
</li><li><b>FileEntry</b>
</li><li><b>Format</b>
</li><li><b>Icons128x128_1</b>
</li><li><b>Icons128x32_1</b>
</li><li><b>Icons64x64_1</b>
</li><li><b>IncludeManialink</b>
</li><li><b>Label</b>
</li><li><b>MedalsBig</b>
</li><li><b>Music</b>
</li><li><b>Quad</b>
</li><li><b>Spacer</b>
</li><li><b>Video</b></li></ul>

<h3>\ManiaLib\Gui\Layouts</h3>

Once again, a further description to each of the Layouts you will find at the ManiaLib documentation.<br>
If you want to use a Layout, then you need to add an object instance to the Control's <b>applyLayout($layout)</b> method.<br>
<ul><li><b>Column</b>
</li><li><b>Flow</b>
</li><li><b>Line</b>
</li><li><b>Spacer</b>
</li><li><b>VerticalFlow</b></li></ul>

<h3>\ManiaLive\Gui</h3>

<ul><li><b>Panel</b><br>A window which already has elements to look like an ingame panel with a title, a main background and a close button. Don't forget to call parent::onConstruct when inheriting from it.<br>
</li><li><b>ManagedWindow</b><br>A Panel which can have only one recipient and can be minimized into a taskbar.<br>
</li><li><b>CustomUI</b><br>Each player has its own CustomUI instance. You can use this instance to show or hide default ingame UIs.</li></ul>

<h3>\ManiaLive\Gui\Controls</h3>

<ul><li><b>ButtonResizable</b><br>Same as the normal Button element, but you can change its size.<br>
</li><li><b>Frame</b><br>Add controls to a frame, position them and define size.<br>Apply a layout if you want.<br>
</li><li><b>PageNavigator</b><br>Helps you building a navigation for a multiple paged window.<br>
</li><li><b>Panel</b><br>Standard window background, you can even have a close button.<br>
</li><li><b>Tabbable</b><br>Inherit this with another control and add an instance to<br>
</li><li><b>TabbedPane</b><br>Add Tabbable controls and you will be able to choose one of them that will be displayed.</li></ul>

<h3>\ManiaLive\Gui\Windows</h3>

<ul><li><b>Dialog</b><br>Create a simple window with predefined buttons.<br>Enable the window events for the plugin and if dialog window is closed, get the answer property from the dialog.<br>
</li><li><b>Info</b><br>Just display a simple window with message inside and title.</li></ul>

<h1>Threading</h1>

Last but not least, there is something called threading in ManiaLive.<br>
Most of you probably know what that is when speaking of normal software applications.<br>
ManiaLive is different, since PHP does not support threading, there had to be a different way to do time consuming stuff (slow database queries, remote procedures, blocking connections) without having a frozen main application.<br>
Another thing is security, a crashing thread can be restarted and the main loop will rest unaffected.<br>
Although the idea of multi-threading somehow sounds more exciting than the good old PHP style it is recommended to use it as rarely as possible!<br>
Due to the fact, that this is not an inbuilt functionality and relies on many other libraries/functions and also depends on what kind of system you are using, it is on its way of becoming a bit unstable again. For this reason there is a compatibility mode that can execute the work that has been assigned to threads in a sequential way. That way, if your plug-in does make use of the threading feature, but it has been deactivated, manialive will still be able to load and use it. All the work that normally would be assigned to another process will then be executed in the main loop and thus there might be some performance loss.<br>
<br>
<h2>Creating a Thread</h2>

The ThreadHandler class contains a helper method that will create a thread:<br>
<pre><code>launchThread()<br>
</code></pre>
This method returns the ID of the thread that you'll need to give to other threading methods.<br>
This documentation will only explain how to manage threads. If you want to discover the full potential of the threading library, you will need to look up the source code files or the more detailed phpUml documentation.<br>
<br>
<h2>Create Work</h2>

Okay, so you have some stuff that you do want to be executed on the thread, but how do you need to prepare the data for the thread to be able to work with it?<br>
There is a interface <b>\ManiaLive\Threading\Runnable</b> that you need to implement. This interface has a method <b>run()</b> that you need to define. You can also add properties to the class to be able to store data or instructions. The run method is what is executed on the other process. Now that you have created your Runnable class you need to instantiate it and if needed set its properties.<br>
<br>
<h2>Assign Task to a Thread</h2>

You should have an object now that is a subtype of <b>\ManiaLive\Threading\Runnable</b>. To assing it to the thread you created, you just need to call the method.<br>
<pre><code>addTask(int $threadId, ManiaLive\Threading\Runnable $task, string $callback = null)<br>
</code></pre>
For the third parameter you can set a callback method that will be executed once the task has been finished by the thread.<br>
<br>
<h2>Managing Threads</h2>

You can activate the threading events to be informed about threads that timeout or crash.<br>
If a process crashes or times out, it will be restarted and the last task will be tried again or discarded, depending on the threading configuration and how many times it has been tried before.<br>
<br>
<h2>Killing Threads</h2>

When you don't need a thread anymore, because you won't have any other task to do or your plugin is unloaded, don't forget to kill it so it won't stay running until ManiaLive is closed.<br>
<pre><code>killThread(int $threadId)<br>
</code></pre>