<?php
/**
* @version	$Id$
* @package	Joomla
* @subpackage	Content-Widgets
* @copyright	Copyright (c) 2018 Norbert Kuemin. All rights reserved.
* @license	http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE
* @author	Norbert Kuemin
* @authorEmail	momo_102@bluemail.ch
*/

// No direct access
defined('_JEXEC') or die('Restricted access');

class WidgetYouTube {

	public static function getHtml($params) {
		return '<iframe width="'.self::_hashget($params, 'width').'" height="'.self::_hashget($params, 'height').'" src="https://www.youtube.com/embed/'.self::_hashget($params, 'id').'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
	}

	private static function _hashget($hashmap, $key) {
		if (isset($hashmap[$key])) {
			return $hashmap[$key];
		}
		return '';
	}
}
?>
