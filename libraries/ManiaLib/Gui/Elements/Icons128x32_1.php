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

namespace ManiaLib\Gui\Elements;

/**
 * Icons128x32_1 quad
 */	
class Icons128x32_1 extends \ManiaLib\Gui\Elements\Icon
{
	/**#@+
	 * @ignore
	 */
	protected $style = \ManiaLib\Gui\Elements\Quad::Icons128x32_1;
	protected $subStyle = self::RT_Cup;
	/**#@-*/
	
	const RT_Cup                      = 'RT_Cup';
	const RT_Laps                     = 'RT_Laps';
	const RT_Rounds                   = 'RT_Rounds';
	const RT_Stunts                   = 'RT_Stunts';
	const RT_Team                     = 'RT_Team';
	const RT_TimeAttack               = 'RT_TimeAttack';
	const SliderBar                   = 'SliderBar';
	const SliderBar2                  = 'SliderBar2';
	const UrlBg                       = 'UrlBg';
}

?>