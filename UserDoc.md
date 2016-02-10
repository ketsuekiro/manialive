

# Requirements #

  * Php at minimum version **5.3.1**<br>with cURL extension enabled (since <a href='https://code.google.com/p/manialive/source/detail?r=194'>r194</a>)<br>
<ul><li>Windows or Linux System.<br>
</li><li>Trackmania Dedicated Server<br>
</li><li>Php SQLite Extension<code>*</code></li></ul>


<sub>*only needed if Threading enabled.</sub><br>
<br>
<h1>Installation</h1>

<h2>Fresh</h2>

For a fresh installation go to the Downloads page and get the latest ManiaLive package.<br>
In addition you also might want to download the Standard Plugins package.<br>
Extract the ManiaLive archive somewhere you have access to.<br>
To install the plugins, just extract them into the ManiaLive folder that you have just created.<br>
<br>
<h2>Upgrade</h2>

When using ManiaLive it will display priodic messages when there's a new version ready.<br>
If you want to upgrade to the new version without much effort, it is recommended to use the update script.<br>

<h3>Windows</h3>

Just go to the update folder and execute the update.bat<br>
<br>
<table><thead><th> <img src='http://files.manialive.com/doc/0_update_win.png' /> </th></thead><tbody></tbody></table>

<h3>Linux</h3>

On Linux we weren't able to serve you with a launcher script yet, because it fails possibility to interact with the console.<br>
You will need to execute the php file by hand:<br>
<pre><code>florian@ubuntu:~/ManiaLive$ cd update<br>
florian@ubuntu:~/ManiaLive/update$ php update.php<br>
###############################<br>
# ManiaLive Updater<br>
###############################<br>
<br>
&gt; Checking local ManiaLive version ...<br>
&gt; ManiaLive is at version 1830<br>
&gt; Checking remote ManiaLive version ...<br>
&gt; Remote ManiaLive is at version 2028<br>
&gt; Searching ManiaLive release package ...<br>
&gt; Downloading 'ManiaLive_1.0_r2028.zip' ...<br>
&gt; OK.<br>
<br>
Everything is in place.<br>
[local: 1830] ---&gt; [remote: 2028]<br>
Do you want to update ManiaLive now? (y/n):<br>
</code></pre>

If the command php is unkown, you can also try this to get the path to your php executable:<br>
<pre><code>florian@ubuntu:~/ManiaLive/update$ which php<br>
/usr/bin/php<br>
florian@ubuntu:~/ManiaLive/update$ /usr/bin/php update.php<br>
...<br>
</code></pre>

<h1>First start</h1>
To get you started very quickly most configuration is already done. In fact, if you are running a just downloaded Trackmania Dedicated Server and you haven't done any changes apart from setting a server name, you should already be good to go.<br>
If you have made some small changes for example the xml-rpc port or the Super Admin Password you can use the command line configuration. Here are the parameters you can add in the launch script<br>
<br>
<ul><li>--help: displays the ManiaLive command line help<br>
</li><li>--rpcport=xxx : xxx represents the xmlrpc to use for the connection to the server<br>
</li><li>--address=xxx : xxx represents the address of the server, it should be an IP address or localhost<br>
</li><li>--user=xxx : xxx represents the name of the user to use for the communication. It should be User, Admin or SuperAdmin<br>
</li><li>--password=xxx : xxx represents the password relative to --user Argument<br>
</li><li>--dedicated_cfg=xxx : xxx represents the name of the Dedicated configuration file to use to get the connection data. This file should be present in the Dedicated's config file.<br>
</li><li>--manialive_cfg=xxx : xxx represents the name of the ManiaLive's configuration file. This file should be present in the ManiaLive's config file.</li></ul>

Here is a sample of how to start a ManiaLive instance:<br>
<br>
<code>php.exe bootstrapper.php --dedicated_cfg=dedicated_cfg.txt --manialive_cfg=config.ini</code>

<h1>Introduction to Configuration</h1>

Otherwise you might want to take a look into the config folder which is located inside the application root and find the config-example.ini. This file will define the whole configurable behaviour of ManiaLive and its plugins.<br>

<table><thead><th> <img src='http://files.manialive.com/doc/1_rename_config.png' /> </th></thead><tbody></tbody></table>

ManiaLive will look for a config.ini by default. So if you install ManiaLive on your system for the first time, you need to copy and rename the example so that ManiaLive is able to find it.<br>
If you are familiar with programming, you should be able to understand how to make changes very easily, for those who don't, there are only a few types of elements you need to understand:<br>
<br>
<h2>Elements</h2>

To be interpreted correctly, each element has to be put on a single line and may itself not contain any line breaks.<br>
<br>
<h3>Comment</h3>

The easiest of all is probably the comment.<br>
Beginning with a semicolon at the first character of the line and whatever text afterwards, it is used for making descriptions or formatting.<br>
<pre><code>; This is a line of the configuration that will be ignored.<br>
</code></pre>
<h3>Assignment</h3>
An assignment can be made by just writing the option name onto the left side of an equality sign and the value you want to set for it on the right side. Some options expect text, some numbers and others may only be switches which you can set using “On” or “Off”.<br>
<pre><code>config.logsPath = C:\Logs<br>
</code></pre>
<h3>Assigning more than one value</h3>
There are options which can take more than one value, for instance there might be an option to set the logins of the administrators that are allowed to control the server from an in-game interface. Using the global option style you would always overwrite the previously set value. To add another value to an option you simply add opening and closing brackets right after the name. This is not supported by every option, there should be comments with examples how to use each option.<br>
<pre><code>manialive.admins[] = login1<br>
manialive.admins[] = login2<br>
</code></pre>
<h3>Configuring Sub-Modules</h3>
Module and Option are divided by a simple full stop. Right after, without space, there follows the name of the setting. Then once again equals sign and the value you want to set. Previously defined rules apply.<br>
<pre><code>server.port = 5000<br>
</code></pre>
<h3>Plugin Option</h3>
To configure plugins you to know the config classes for them. A widely used convention is to call it Config, so most the time you'll be able to it this way<br>
<pre><code>ManiaLivePlugins\Author\Plugin\Config.message = 'Hello World'<br>
</code></pre>
For plugin configuration, you can also declare some aliases to make it easier. Those two lines are equivalent to the previous line<br>
<pre><code>alias aplugin = ManiaLivePlugins\Author\Plugin\Config<br>
aplugin.message = 'Hello World'<br>
</code></pre>
<h3>Host Overrides</h3>
Finally there's the possibility to add configuration that is only applied on a specific computer. “[hostname: aHost]” where aHost is the name of your computer on the local network. On windows you can get that name by simply typing “hostname” on the console.<br>
Everything after this tag (until the next one) will be only executed on your machine.<br>
<br>
<h1>Startup Configuration</h1>
Here you will find a short list of the available built in settings.<br>
<br>
phpPath sets the path to your php executable file. If not set, then ManiaLive will use “php.exe” on Windows and “php” on Linux. Due to this, ManiaLive will not find it if you haven't added the php path to your system environment. You can then either do that, or overwrite phpPath to use the absolute path.<br>
<br>
With the option logsPath you can define where ManiaLive will put all the log-files. Default value is the logs folder within the application root folder.<br>
<br>
LogPrefix, if defined, puts this text in front of the name of every log-file that is created.<br>
<br>
You can set runtimeLog, if you are running ManiaLive as a background daemon and you don't have direct console output, then this will forward everything that normally is written onto the screen into a file called log_Runtime. Depending on if you use logsPath or logsPrefix the path to or name of the file may differ.<br>
<br>
globalErrorLog is a switch that can be “On” or “Off”.<br>
If activated it will create an error-log in your logs folder “GlobalErrorLog.txt”. There is a error log for every ManiaLive instance that you start, the global error log will contain errors from all instances.<br>
<br>
maxErrorCount sets the peak number of errors that may occur before the program is stopped.<br>
<br>
<h2>Module Configuration</h2>
<h3>Dedicated Server</h3>

Establishes the dedicated server connection and can be configured with the following options: server.host, server.port, server.user, server.password.<br>
<br>
<h3>Administrators</h3>
The admins sub-module manages a list of administrators. You can add new admins to the logins list, by adding a line:<br>
<pre><code>manialive.admins[] = 'login'<br>
</code></pre>

<h3>Plugins</h3>
Is a module, that dynamically loads plugins on application startup. Add a new plugin, that you want to load, by adding a line:<br>
<pre><code>manialive.plugins[] = 'Author\Plugin'<br>
</code></pre>
Each plugin that is loaded needs to be located in the “ManiaLivePlugins” folder and has to have two sub-folders, one named after the author and one after the plugin itself.<br>
In an author's folder there may be several plugin folders.<br>
<br>
<table><thead><th> <img src='http://files.manialive.com/doc/3_plugins.png' /> </th></thead><tbody></tbody></table>

<h3>Threading</h3>
This module will, if supported by the plugin, assign blocking or work with heavy calculations to other processes. This way the application's ability to respond is reserved.<br>
If you are experiencing any problems, then try to disable threading on first step, the application then will switch in compatibility mode and will, very simple, try to emulate threading behaviour.<br>
Options supported are: threading.enabled, threading.busyTimeout, threading.maxTries, threading.sequentialTimeout.<br>
<br>
<h3>ManiaHome</h3>
You can enable this for creating a link between your server and ManiaHome. If you did, all achievements that are made on your server can be announced by plugins that are making use of this feature. This way, for instance, a plugin that manages records can inform all friends of a certain player that he just drove a new record on a server's track.<br>
Options supported: maniahome.enabled, maniahome.user, maniahome.password, maniahome.manialink<br>
<br>
<h1>First Launch</h1>
Within your ManiaLive folder there will be two launcher files. One for windows and one for linux systems.<br>
<br>
If your php path is not set in your system environment, then you can set the path to it in the run.ini file (this applies to both, windows and linux)<br>
<br>
<table><thead><th> <img src='http://files.manialive.com/doc/4_set_php.png' /> </th></thead><tbody></tbody></table>

This path will be also used for threading, as long as you don't override it in the config.ini file.<br>
<br>
<h2>Windows</h2>
For windows you should be able to launch ManiaLive by simple double-clicking on “run.bat”.<br>
<br>
<h2>Linux</h2>
On linux it is almost the same.<br>
First you need to make the run file executeable.<br>
<pre><code>florian@ubuntu:~$ cd ManiaLive<br>
florian@ubuntu:~/ManiaLive$ chmod +x run<br>
florian@ubuntu:~/ManiaLive$<br>
</code></pre>
Now you can use the script to start ManiaLive.<br>
<pre><code>florian@ubuntu:~/ManiaLive$ ./run<br>
Launching ManiaLive Daemon with the following arguments:<br>
</code></pre>
If you want to stop ManiaLive again, you can use a command line argument:<br>
<pre><code>florian@ubuntu:~/ManiaLive$ ./run --stop<br>
Stopping Manialive Daemon ...<br>
</code></pre>
Since you won't get any error when you are running ManiaLive as daemon (except you want to check the logs each time) you probably want to run it in the command line until it's stable.<br>
That can be achieved by another argument:<br>
<pre><code>florian@ubuntu:~/ManiaLive$ ./run --nodaemon<br>
Launching ManiaLive with the following arguments:<br>
[19:09:58] XML-RPC connection established<br>
[19:09:58] Successfully authentified with XML-RPC server<br>
[19:09:58|Dedimania] Starting authentication on server ...<br>
[19:09:58|Dedimania] Please wait, opening session ...<br>
</code></pre>

<h2>Troubleshooting</h2>

<h3>It is not safe to rely on the system's timezone settings.</h3>

You did not set a timezone in your php.ini file.<br>
An easy explanation on how to fix this is <a href='http://blog.randell.ph/2010/04/15/warning-date-it-is-not-safe-to-rely-on-the-systems-timezone-settings/'>here</a>.<br>
<br>
<h3>Fatal error: Exception thrown without stack frame in Unknown on line 0</h3>

This exception can happen when shutting down ManiaLive on Linux while using the TeamSpeak plugin.<br>
<br>
<h1>Logging</h1>
When there's an error, then usually the first thing that you want to do is to check the log-files. But where to find them?<br>
If you haven't changed the config settings for log-files, then the default place is the “logs” folder in the ManiaLive root. By default it contains the “log_Command.txt” which keeps track of the chat commands that have been used on the server, “log_Error.txt” if there have been errors during execution and “Loader_pid.txt” documenting the load process of the config-file for every instance that has been launched.<br>
If you have changed logsPath then all logs except the global error log and the loader logs will be created in this path. If you set a prefix then the names will vary.