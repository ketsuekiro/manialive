<?php
namespace ManiaLive\Utilities;

abstract class String
{
	/**
	 * Allows to safely put any TM-formatted string into another TM-formatted string
	 * without conflicts (conflict example: you put a nickname in the middle of the
	 * sentance, the nickname has some bold characters and all the end of the
	 * sentance becomes bold)
	 * @param string Unprotected string
	 * @param string Protected string
	 */
	static function protectStyles($string)
	{
		return "\$<$string\$>";
	}

	/**
	 * Removes the protecting styles ($< and $>) from a string
	 * @param string Protected string
	 * @return string Unprotected string
	 */
	static function unprotectStyles($string)
	{
		return str_replace(array (
		'$<',
		'$>'
		), "", $string);
	}

	/**
	 * Removes some TM styles (wide, bold and shadowed) to avoid wide words
	 * @param string
	 * @return string
	 */
	static function stripWideFonts($string)
	{
		return str_replace(array (
		'$w',
		'$o',
		'$s'
		), "", $string);
	}

	/**
	 * Removes TM links
	 * @param string
	 * @return string
	 */
	static function stripLinks($string)
	{
		return preg_replace(
		'/\\$[hlp](.*?)(?:\\[.*?\\](.*?))?(?:\\$[hlp]|$)/ixu', '$1$2', 
		$string);
	}

	/**
	 * Removes all color in string
	 * @param string $str
	 * @return string
	 */
	static function stripColors($string){
		return preg_replace('/\\$([tinmgz]|[0-9a-fA-F]{3}|[0-9a-fA-F].{2}|[0-9a-fA-F].[0-9a-fA-F]|[0-9a-fA-F]{2}.|[^$hlpwos<>]?)/i',"", $string);
	}
	
	/**
	 * Removes all label formating from the string
	 * @param string $string
	 * @return string
	 */
	static function stripAllTmStyle($string)
	{
		$string = self::unprotectStyles($string);
		$string = self::stripLinks($string);
		$string = self::stripWideFonts($string);
		return self::stripColors($string);
	}
	
}