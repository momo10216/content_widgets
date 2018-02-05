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

class Widget {

	public static function getHtml($params) {
		return '<script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/currency.js"></script>
<div class="coinmarketcap-currency-widget" data-currency="'.self::_hashget($params, 'currency').'" data-base="'.self::_hashget($params, 'base').'" ></div>';
	}

	private function _hashget($hashmap, $key) {
		if (isset($hashmap[$key])) {
			return $hashmap[$key];
		}
		return '';
	}
}
?>
