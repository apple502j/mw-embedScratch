<?php
/*
    Copyright (C) 2018 Apple502j All rights reversed.
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
    
    Embedding Scratch in MediaWiki
    <scratch> Tag
    
    Some parts are from ScratchSig
    https://github.com/LLK/mw-ScratchSig2/blob/master/ScratchSig2.php
    
*/

if (!defined('MEDIAWIKI')) {
    die();
}
class EmbedScratch{
	public static function parserEmbedScratch (&$parser) {
	    $parser->setHook('scratch', array(__CLASS__,'renderEmbedScratch'));
	    return true;
	}
	
	public static function renderEmbedScratch ($input, $argv, $parser) {
		$project = '';
		$width = $width_max = 485;
		$height = $height_max = 402;
	
		
		if ( !empty( $argv['project'] ) ){
			$project=$argv['project'];
		} elseif (!empty($input)){
			$project=$input;
		}
		$project = htmlspecialchars($project, ENT_QUOTES);
		if (
			!empty( $argv['width'] ) &&
			settype( $argv['width'], 'integer' ) &&
			( $width_max >= $argv['width'] )
		)
		{
			$width = $argv['width'];
		}
		if (
			!empty( $argv['height'] ) &&
			settype( $argv['height'], 'integer' ) &&
			( $height_max >= $argv['height'] )
		)
		{
			$height = $argv['height'];
		}
		if (!empty($project)) {
			return (
				"<div style=\"max-width:{$width}px\">"
				. "<div style=\"position:relative;padding-top:"
				. $height / $width * 100
				. "%\">"
				. "<iframe "
				. "allowtransparency=\"true\" "
				. "width=\"100%\" height=\"100%\" "
				. "src=\"https://scratch.mit.edu/projects/{$project}/embed/\" "
				. "frameborder=\"0\" "
				. "allowfullscreen "
				. "scrolling=\"no\" "
				. "bgcolor=\"#000000\" "
				. "style=\"overflow:hidden;position:absolute;top:0;left:0;\""
				. ">"
				. "</iframe>"
				. "</div></div>"
			);
		} else {
			return "";
		}
	}
}
