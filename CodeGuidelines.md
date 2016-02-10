

# Basis #

## Editor Settings ##

### Linefeeds ###
Be sure your editor use UNIX line ending format (LF, “\n”). This means that lines are not terminated by Windows Line ending (CR/LF, “\r\n”) or Mac (CR, “\r”). Notepad++, or eclipse allow you to set this.

### File encoding ###
To be sure to handle every character be sure to encoding every source file in UTF-8 w/o BOM charset. It will avoid some incompatibility with every input of special characters we have.

## Documentation ##
Please use as much documentation as possible to make your code as clear as possible.

## Namespaces ##
All classes and functions must have a namespace of the root folder in the libraries folder you are working in. e.g.: you are creating a plugin, so your root folder in the libraries is ManiaLivePlugins, your file should have ManiaLivePlugins as basis namespace.
Here is an example:
```
<?php
namespace ManiaLivePlugins/Author/MyPlugin;
class MyPlugin {}
?>
```
This file should be placed in the folder libraries/ManiaLivePlugins/Author/MyPlugin

## File Locations ##

Here is the description of the architecture of the libraries folder; this folder is the only one which has to contain source code, except bootstrapper.php and utils.inc.php which are non-object source code.
  * ManiaHome: contains the ManiaHome client to send notifications
  * ManiaLive: contains the core code to run ManiaLive
    * Application: contains the AbstractApplication class, this defined the entire application, the command line interpretation, etc.
    * Config: contains the config file interpreter and the basic Config class
    * Data: contains every class related to the data, such as the Storage class and its Event class
    * Database: contains every class used to connect to a database. It contains driver for MySQL and SQLlite databases
    * DedicatedApi: contains the heart of the application. This folder contains all the classes needed to connect ManiaLive to the dedicated server. It also contains all the structures used by the server.
    * Event: contains the basis to use events in ManiaLive
    * Features: contains other feature needed by ManiaLive, such as the Ticker, the Chat Command Interpreter, or the Admin group
    * Gui: contains a special version of ManiaLib. It’s also in this folder you will be able to find every classes related to the Windowing system and the groups.
    * PluginHandler: contains classes needed to use the plugins
    * Threading: contains the classes used to manage threads.
    * Utilities: contains toolbox classes.
  * ManiaLiveApplication: contains the application that will be run
  * ManiaLivePlugins: contains every plugin you want to add
# Code Layout/Guidelines #
## Naming ##
### Variable and methods Name ###
Every variables and methods should use the mixedCase
Example:
```
$myVariable ; //Correct
$MyVariable; //Incorrect
$my_variable; //Incorrect
```
For a variable containing an array of the same type of data, please use a plural name.
Example:
```
$player = new Player(); //Singular for single object
$players = array(); //Plural for array
$players[] = $player;
$players[] = $player;
$players[] = $player;
```

### Classes and Namespaces Name ###
Every Classes or Namespace should use Camel Case (http://en.wikipedia.org/wiki/CamelCase)
Example:
```
class MyClass {} //Correct
class myClass {} //Incorrect
class my_class {} //Incorrect
```

## Code Layout ##

### Braces usage ###
Always include the braces. Even if the body of some construct is only on line long, do not  drop the braces. Example:
```
//All the following are incorrect
if(condition) do_stuff();
if(condition)
 do_stuff();
while(condition)
	do_stuff();
for($i = 0; $i < $size; $i++)
	do_stuff($i);
```
```
//These are all correct
if(condition)
{
	do_stuff();
}
while(condition)
{
	do_stuff();
}
for($i = 0; $i < $size; $i++)
{
	do_stuff($i);
} 
```
Always put the braces on a new line, except if there is nothing inside
```
//Incorrect
if(condition){
	do_stuff();
}
//correct
if(condition)
{
	do_stuff();
}
//correct
function myEmptyMethod() {}
```
### Use spaces between tokens ###
This is another simple, easy step that helps keep code readable without much effort. Whenever you write an assignment, expression, etc.. Always leave one space between the tokens. Basically, write code as if it was English. Put spaces between variable names and operators. Don't put spaces just after an opening bracket or before a closing bracket. Don't put spaces just before a comma or a semicolon. This is best shown with a few examples,
Examples:
```
// Each pair shows the wrong way followed by the right way. 
$i=0;
$i = 0;

if($i<7) ...
if ($i < 7) ...

if ( ($i < 7)&&($j > 8) ) ...
if ($i < 7 && $j > 8) ...

do_stuff( $i, 'foo', $b );
do_stuff($i, 'foo', $b);

for($i=0; $i<$size; $i++) ...
for ($i = 0; $i < $size; $i++) ...

$i=($j < $size)?0:1;
$i = ($j < $size) ? 0 : 1;
```

### Operator precedence ###
Do you know the exact precedence of all the operators in PHP? Neither do I. Don't guess. Always make it obvious by using brackets to force the precedence of an equation so you know what it does. Remember to not over-use this, as it may harden the readability. Basically, do not enclose single expressions.
Examples:
```
// what's the result? who knows. 
$bool = ($i < 7 && $j > 8 || $k == 4);
	

// now you can be certain what I'm doing here.
$bool = (($i < 7) && (($j < 8) || ($k == 4)));
	

// But this one is even better, because it is easier on the eye but the intention is preserved
$bool = ($i < 7 && ($j < 8 || $k == 4));
```