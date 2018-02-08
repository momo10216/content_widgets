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

class WidgetFacebook {
	private static $fbSdkVersion = 'v2.12';
	private static $first = false;

	public static function getHtml($params) {
		$html = '';
		if (!self::$first) {
			$html = '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version='.self::$fbSdkVersion.'\';
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>';
			self::$first = true;
		}
		switch (self::_hashget($params, 'resource')) {
			case 'like':
				$html .= self::_like($params);
				break;
			case 'quote':
				$html .= self::_quote($params);
				break;
			case 'save':
				$html .= self::_save($params);
				break;
			case 'send':
				$html .= self::_send($params);
				break;
			case 'share':
				$html .= self::_share($params);
				break;
			default:
				$html .= 'Unsupported resource "'.self::_hashget($params, 'resource').'"';
		}
		return $html;
	}

	private static function _hashget($hashmap, $key) {
		if (isset($hashmap[$key])) {
			return $hashmap[$key];
		}
		return '';
	}

	private static function _save($params) {
		$size = 'large';
		$uri = JFactory::getURI()->toString();
		if (!empty(self::_hashget($params, 'size'))) { $size = self::_hashget($params, 'size'); }
		if (!empty(self::_hashget($params, 'uri'))) { $uri = self::_hashget($params, 'uri'); }
		return '<div class="fb-save" data-uri="'.$uri.'" data-size="'.$size.'"></div>';
	}

	private static function _quote($params) {
		return '<div class="fb-quote"></div>';
	}

	private static function _like($params) {
		$size = 'large';
		$layout = 'standard';
		$action = 'like';
		$href = JFactory::getURI()->toString();
		$showFaces = 'true';
		$share = 'true';
		if (!empty(self::_hashget($params, 'size'))) { $size = self::_hashget($params, 'size'); }
		if (!empty(self::_hashget($params, 'layout'))) { $layout = self::_hashget($params, 'layout'); }
		if (!empty(self::_hashget($params, 'action'))) { $action = self::_hashget($params, 'action'); }
		if (!empty(self::_hashget($params, 'show-faces'))) { $showFaces = self::_hashget($params, 'show-faces'); }
		if (!empty(self::_hashget($params, 'share'))) { $share = self::_hashget($params, 'share'); }
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		return '<div class="fb-like" data-href="'.$href.'" data-layout="'.$layout.'" data-action="'.$action.'" data-size="'.$size.'" data-show-faces="'.$showFaces.'" data-share="'.$share.'"></div>';
	}

	private static function _share($params) {
		$size = 'large';
		$layout = 'button_count';
		$href = JFactory::getURI()->toString();
		$mobileIframe = 'false';
		$text = 'Share';
		if (!empty(self::_hashget($params, 'size'))) { $size = self::_hashget($params, 'size'); }
		if (!empty(self::_hashget($params, 'layout'))) { $layout = self::_hashget($params, 'layout'); }
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		if (!empty(self::_hashget($params, 'mobile-iframe'))) { $mobileIframe = self::_hashget($params, 'mobile-iframe'); }
		if (!empty(self::_hashget($params, 'text'))) { $text = self::_hashget($params, 'text'); }
		return '<div class="fb-share-button" data-href="'.$href.'" data-layout="'.$layout.'" data-size="'.$size.'" data-mobile-iframe="'.$mobileIframe.'"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($href).'&amp;src=sdkpreparse">'.$text.'</a></div>';
	}

	private static function _send($params) {
		$size = 'large';
		$layout = 'button_count';
		$href = JFactory::getURI()->toString();
		if (!empty(self::_hashget($params, 'size'))) { $size = self::_hashget($params, 'size'); }
		if (!empty(self::_hashget($params, 'layout'))) { $layout = self::_hashget($params, 'layout'); }
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		return '<div class="fb-send" data-href="'.$href.'" data-layout="'.$layout.'" data-size="'.$size.'"></div>';
	}

}
?>
