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
	private static $sdkVersion = 'v2.12';
	private static $first = false;

	public static function getHtml($params) {
		$html = '';
		if (!self::$first) {
			self::_init();
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
			case 'embedded_comments':
				$html .= self::_embedded_comments($params);
				break;
			case 'embedded_posts':
				$html .= self::_embedded_posts($params);
				break;
			case 'video':
				$html .= self::_video($params);
				break;
			case 'page':
				$html .= self::_page($params);
				break;
			case 'comment':
				$html .= self::_comment($params);
				break;
			case 'follow':
				$html .= self::_follow($params);
				break;
			default:
				$html .= 'Unsupported resource "'.self::_hashget($params, 'resource').'"';
		}
		return $html;
	}

	private static function _init() {
		$document = JFactory::getDocument();
//		$document->addCustomTag('<div id="fb-root"></div>');
		$document->addScriptDeclaration('(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = \'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version='.self::$sdkVersion.'\';
    fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));');
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

// [TODO] Not working
	private static function _quote($params) {
		$href = JFactory::getURI()->toString();
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		$layout = 'standard';
		if (!empty(self::_hashget($params, 'layout'))) { $layout = self::_hashget($params, 'layout'); }
		return '<div class="fb-quote" data-href="'.$href.'" data-layout="'.$layout.'"></div>';
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

// [TODO] Not working
	private static function _send($params) {
		$href = JFactory::getURI()->toString();
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		$layout = 'button_count';
		if (!empty(self::_hashget($params, 'layout'))) { $layout = self::_hashget($params, 'layout'); }
		$size = 'large';
		if (!empty(self::_hashget($params, 'size'))) { $size = self::_hashget($params, 'size'); }
		$colorscheme = 'light';
		if (!empty(self::_hashget($params, 'colorscheme'))) { $colorscheme = self::_hashget($params, 'colorscheme'); }
		$ref = '';
		if (!empty(self::_hashget($params, 'ref'))) { $ref = self::_hashget($params, 'ref'); }
		$kidDirectedSite = 'light';
		if (!empty(self::_hashget($params, 'kid_directed_site'))) { $kidDirectedSite = self::_hashget($params, 'kid_directed_site'); }
		return '<div class="fb-send" data-href="'.$href.'" data-layout="'.$layout.'" data-size="'.$size.'" data-colorscheme="'.$colorscheme.'" data-ref="'.$ref.'" data-kid-directed-site="'.$kidDirectedSite.'"></div>';
	}

	private static function _embedded_comments($params) {
		$href = 'https://www.facebook.com/zuck/posts/10102577175875681?comment_id=1193531464007751&amp;reply_comment_id=654912701278942';
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		$width = '560';
		if (!empty(self::_hashget($params, 'width'))) { $width = self::_hashget($params, 'width'); }
		$includeParent = 'false';
		if (!empty(self::_hashget($params, 'include-parent'))) { $includeParent = self::_hashget($params, 'include-parent'); }
		return '<div class="fb-comment-embed" data-href="'.$href.'" data-width="'.$width.'" data-include-parent="'.$includeParent.'"></div>';
	}

	private static function _embedded_posts($params) {
		$href = 'https://www.facebook.com/20531316728/posts/10154009990506729/';
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		$width = '500';
		if (!empty(self::_hashget($params, 'width'))) { $width = self::_hashget($params, 'width'); }
		$showText = 'true';
		if (!empty(self::_hashget($params, 'show-text'))) { $showText = self::_hashget($params, 'show-text'); }
		return '<div class="fb-post" data-href="'.$href.'" data-width="'.$width.'" data-show-text="'.$showText.'"><blockquote cite="'.$href.'" class="fb-xfbml-parse-ignore"><a href="'.$href.'">Link</a></blockquote></div>';
	}

	private static function _video($params) {
		$href = 'https://www.facebook.com/facebook/videos/10153231379946729/';
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		$width = '500';
		if (!empty(self::_hashget($params, 'width'))) { $width = self::_hashget($params, 'width'); }
		$showText = 'false';
		if (!empty(self::_hashget($params, 'show-text'))) { $showText = self::_hashget($params, 'show-text'); }
		return '<div class="fb-video" data-href="https://www.facebook.com/facebook/videos/10153231379946729/" data-width="'.$width.'" data-show-text="'.$showText.'">
    <div class="fb-xfbml-parse-ignore">
      <blockquote cite="'.$href.'">
        <a href="'.$href.'">Link</a>
      </blockquote>
    </div>
  </div>';
	}

	private static function _page($params) {
		$href = 'https://www.facebook.com/facebook';
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		$tabs = 'timeline';
		if (!empty(self::_hashget($params, 'tabs'))) { $tabs = self::_hashget($params, 'tabs'); }
		$smallHeader = 'false';
		if (!empty(self::_hashget($params, 'small-header'))) { $smallHeader = self::_hashget($params, 'small-header'); }
		$adaptContainerWidth = 'true';
		if (!empty(self::_hashget($params, 'adapt-container-width'))) { $adaptContainerWidth = self::_hashget($params, 'adapt-container-width'); }
		$hideCover = 'false';
		if (!empty(self::_hashget($params, 'hide-cover'))) { $hideCover = self::_hashget($params, 'hide-cover'); }
		$showFacepile = 'true';
		if (!empty(self::_hashget($params, 'show-facepile'))) { $showFacepile = self::_hashget($params, 'show-facepile'); }
		$text = 'Facebook';
		if (!empty(self::_hashget($params, 'text'))) { $text = self::_hashget($params, 'text'); }
		return '<div class="fb-page" data-href="'.$href.'" data-tabs="'.$tabs.'" data-small-header="'.$smallHeader.'" data-adapt-container-width="'.$adaptContainerWidth.'" data-hide-cover="'.$hideCover.'" data-show-facepile="'.$showFacepile.'"><blockquote cite="'.$href.'" class="fb-xfbml-parse-ignore"><a href="'.$href.'">'.$text.'</a></blockquote></div>';
	}

	private static function _comment($params) {
		$href = 'https://developers.facebook.com/docs/plugins/comments#configurator';
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		$numPosts = '5';
		if (!empty(self::_hashget($params, 'numposts'))) { $numPosts = self::_hashget($params, 'numposts'); }
		return '<div class="fb-comments" data-href="'.$href.'" data-numposts="'.$numPosts.'"></div>';
	}

// [TODO] Not working
	private static function _follow($params) {
		$href = 'https://www.facebook.com/zuck';
		if (!empty(self::_hashget($params, 'href'))) { $href = self::_hashget($params, 'href'); }
		$layout = 'standard';
		if (!empty(self::_hashget($params, 'layout'))) { $layout = self::_hashget($params, 'layout'); }
		$size = 'small';
		if (!empty(self::_hashget($params, 'size'))) { $size = self::_hashget($params, 'size'); }
		$showFaces = 'true';
		if (!empty(self::_hashget($params, 'show-faces'))) { $showFaces = self::_hashget($params, 'show-faces'); }
		return '<div class="fb-follow" data-href="'.$href.'" data-layout="'.$layout.'" data-size="'.$size.'" data-show-faces="'.$showFaces.'"></div>';
	}
}
?>
