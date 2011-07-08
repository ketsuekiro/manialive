<?php
/**
 * ManiaLib - Lightweight PHP framework for Manialinks
 * 
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision$:
 * @author      $Author$:
 * @date        $Date$:
 */

namespace ManiaLib\Gui;

/**
 * GUI Toolkit
 * Manialink GUI Toolkit main class
 */
abstract class Manialink
{
	/**#@+
	 * @ignore
	 */
	public static $domDocument;
	public static $parentNodes;
	public static $parentLayouts;
	public static $linksEnabled = true;
	
	public static $langsURL;
	public static $imagesURL;
	public static $mediaURL;
	
	protected static $swapPosY = false;
	protected static $dicos = array();
	/**#@-*/
	
	/**
	 * Loads the Manialink GUI toolkit. This should be called before doing
	 * anything with the toolkit.
	 * @param bool Whether you want to create the root "<manialink>" element in the XML
	 * @param int The timeout value in seconds. Use 0 if you have dynamic pages to avoid caching
	 */
	final public static function load($createManialinkElement = true, $timeoutValue=0)
	{
		if(class_exists('\ManiaLib\Application\Config'))
		{
			$config = \ManiaLib\Application\Config::getInstance();
			self::$langsURL = $config->getLangsURL();
			self::$imagesURL = $config->getImagesURL();
			self::$mediaURL = $config->getMediaURL();
		}
		
		// Load the XML object
		self::$domDocument = new \DOMDocument('1.0', 'utf-8');
		self::$parentNodes = array();
		self::$parentLayouts = array();

		if($createManialinkElement)
		{
			$manialink = self::$domDocument->createElement('manialink');
			self::$domDocument->appendChild($manialink);
			self::$parentNodes[] = $manialink;
				
			$timeout = self::$domDocument->createElement('timeout');
			$manialink->appendChild($timeout);
			$timeout->nodeValue = $timeoutValue;
		}
		else
		{
			$frame = self::$domDocument->createElement('frame');
			self::$domDocument->appendChild($frame);
			self::$parentNodes[] = $frame;
		}
	}

	/**
	 * Renders the Manialink
	 * @param boolean Wehther you want to return the XML instead of printing it
	 */
	final public static function render($return = false)
	{
		if(self::$dicos)
		{
			array_map(array('Manialink', 'includeManialink'), self::$dicos);
		}
		if($return)
		{
			return self::$domDocument->saveXML();
		}
		else
		{
			header('Content-Type: text/xml; charset=utf-8');
			echo self::$domDocument->saveXML();
		}
	}

	/**
	 * Creates a new Manialink frame, with an optionnal associated layout
	 *
	 * @param float X position
	 * @param float Y position
	 * @param float Z position
	 * @param float Scale (default is null or 1)
	 * @param \ManiaLib\Gui\Layouts\AbstractLayout The optionnal layout associated with the frame. If
	 * you pass a layout object, all the items inside the frame will be
	 * positionned using constraints defined by the layout
	 */
	final public static function beginFrame($x=0, $y=0, $z=0, $scale=null, \ManiaLib\Gui\Layouts\AbstractLayout $layout=null)
	{
		// Update parent layout
		$parentLayout = end(self::$parentLayouts);
		if($parentLayout instanceof \ManiaLib\Gui\Layouts\AbstractLayout)
		{
			// If we have a current layout, we have a container size to deal with
			if($layout instanceof \ManiaLib\Gui\Layouts\AbstractLayout)
			{
				$ui = new \ManiaLib\Gui\Elements\Spacer($layout->getSizeX(), $layout->getSizeY());
				$ui->setPosition($x, $y, $z);

				$parentLayout->preFilter($ui);
				$x += $parentLayout->xIndex;
				$y += $parentLayout->yIndex;
				$z += $parentLayout->zIndex;
				$parentLayout->postFilter($ui);
			}
		}

		// Create DOM element
		$frame = self::$domDocument->createElement('frame');
		if($x || $y || $z)
		{
			if (self::$swapPosY)
				$frame->setAttribute('posn', $x.' '.(-$y).' '.$z);
			else
				$frame->setAttribute('posn', $x.' '.$y.' '.$z);
		}
		end(self::$parentNodes)->appendChild($frame);
		if($scale)
		{
			$frame->setAttribute('scale', $scale);
		}

		// Update stacks
		self::$parentNodes[] = $frame;
		self::$parentLayouts[] = $layout;
	}

	/**
	 * Closes the current Manialink frame
	 */
	final public static function endFrame()
	{
		if(!end(self::$parentNodes)->hasChildNodes())
		{
			end(self::$parentNodes)->nodeValue = ' ';
		}
		array_pop(self::$parentNodes);
		array_pop(self::$parentLayouts);
	}
	
	/**
	 * Redirects the user to the specified Manialink
	 */
	final public static function redirect($link, $render = true)
	{
		self::$domDocument = new \DOMDocument('1.0', 'utf-8');
		self::$parentNodes = array();
		self::$parentLayouts = array();

		$redirect = self::$domDocument->createElement('redirect');
		$redirect->appendChild(self::$domDocument->createTextNode($link));
		self::$domDocument->appendChild($redirect);
		self::$parentNodes[] = $redirect;

		if($render)
		{
			if(ob_get_contents())
			{
				ob_clean();
			}
			header('Content-Type: text/xml; charset=utf-8');
			echo self::$domDocument->saveXML();
			// TODO MANIALIB Maybe exiting here is not the best option
			exit;
		}
		else
		{
			return self::$domDocument->saveXML();
		}
	}

	/**
	 * Append some XML code to the document
	 * @param string Some XML code
	 */
	static function appendXML($XML)
	{
		$doc = new \DOMDocument('1.0', 'utf-8');
		$doc->loadXML($XML);
		$node = self::$domDocument->importNode($doc->firstChild, true);
		end(self::$parentNodes)->appendChild($node);
	}

	/**
	 * Disable all Manialinks, URLs and actions of GUIElement objects as long as it is disabled
	 */
	static function disableLinks()
	{
		self::$linksEnabled = false;
	}

	/**
	 * Enable links
	 */
	static function enableLinks()
	{
		self::$linksEnabled = true;
	}
	
	/**
	 * Normal Manialink behavior for the Y positioning of Elements.
	 * This will decrease Y coordinates from top to bottom.
	 * This method is mainly used by ManiaLive.
	 */
	final public static function setNormalPositioning()
	{
		self::$swapPosY = false;
	}
	
	/**
	 * Swapped Manialink behavior for the Y positioning of Elements.
	 * This will increase from top to bottom.
	 * This method is mainly used by ManiaLive.
	 */
	final public static function setSwappedPositioning()
	{
		self::$swapPosY = true;
	}
	
	/**
	 * Returns whether Y-Positioning is swapped for all
	 * Elements currently drawn.
	 * This method is mainly used by ManiaLive.
	 */
	final public static function isYSwapped()
	{
		return self::$swapPosY;
	}
	
	/**
	 * Shortcut for including files in manialinks
	 */
	static function includeManialink($url)
	{
		$ui = new \ManiaLib\Gui\Elements\IncludeManialink();
		$ui->setUrl($url);
		$ui->save();
	}
	
	/**
	 * Add a dictionnary file, will be included when rendering
	 */
	static function addDico($url)
	{
		self::$dicos[] = $url;
	}
	
	/**
	 * Manialink's version of var_dump. Just pass a data and it will output it to teh screen
	 */
	static function var_dump($data /*, ... polymorphic */)
	{
//		ob_start();
//		call_user_func_array('var_dump', func_get_args());
//		$content = ob_get_contents();
//		$content = strip_tags($content);
//		ob_end_clean();
		
		self::load();
		$ui = new Elements\Label(128, 96);
		$ui->enableAutonewline();
		$ui->setAlign('center', 'center');
		$ui->setText(print_r($data, true));
		$ui->save();
		self::render();
	}
}

?>