<?php
/**
 * ManiaLive - TrackMania dedicated server manager in PHP
 * 
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision: 1709 $:
 * @author      $Author: svn $:
 * @date        $Date: 2011-01-07 14:06:13 +0100 (ven., 07 janv. 2011) $:
 */

namespace ManiaLive\Gui\Toolkit\Elements;

/**
 * BgRaceScore2 quad
 */	
class BgRaceScore2 extends Quad
{
	protected $style = Quad::BgRaceScore2;
	protected $subStyle = self::BgCardServer;
	
	const BgCardServer                = 'BgCardServer';
	const BgScores                    = 'BgScores';
	const CupFinisher                 = 'CupFinisher';
	const CupPotentialFinisher        = 'CupPotentialFinisher';
	const Fame                        = 'Fame';
	const Handle                      = 'Handle';
	const HandleBlue                  = 'HandleBlue';
	const HandleRed                   = 'HandleRed';
	const IsLadderDisabled            = 'IsLadderDisabled';
	const IsLocalPlayer               = 'IsLocalPlayer';
	const LadderRank                  = 'LadderRank';
	const Laps                        = 'Laps';
	const Podium                      = 'Podium';
	const Points                      = 'Points';
	const SandTimer                   = 'SandTimer';
	const ScoreLink                   = 'ScoreLink';
	const ScoreReplay                 = 'ScoreReplay';
	const SendScore                   = 'SendScore';
	const Spectator                   = 'Spectator';
	const Tv                          = 'Tv';
	const Warmup                      = 'Warmup';
}
?>