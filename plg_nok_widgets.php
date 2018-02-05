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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgContentplg_nok_widgets extends JPlugin {
	private $_fields = array('widget');

	public function onContentPrepare($context, &$article, &$params, $limitstart) {
		$app = JFactory::getApplication();
	  	$globalParams = $this->params;
		$found = false;
		$document = JFactory::getDocument();
		foreach ($this->_fields as $field) {
			$hits = preg_match_all('#{'.$field.'[\s]+([^}]*)}#s', $article->text, $matches);
			if (!empty($hits)) {
				for ($i=0; $i<$hits; $i++) {
					$found = true;
					$entryParamsText = $matches[1][$i];
					$plgParams = $this->_get_params($globalParams, $entryParamsText);
					switch ($field) {
						case 'widget':
							$html = $this->_loadAndRunWidgetClass($plgParams);
							$article->text = str_replace($matches[0][$i], $html, $article->text);
							break;
						default:
							break;
					}
				}
			}
		}
		return $found;
	}

	private function _get_params($globalParams, $entryParamsText) {
		// Initialize with the global paramteres
		//$entryParamsList['width'] = $globalParams->get('width');

		// Overwrite with the local paramteres
		$items = explode('] ', $entryParamsText);
		foreach ($items as $item) {
			if ($item != '') {
				$item	= explode('[', $item);
				$name 	= trim($item[0], '=[]');
				$value	= trim($item[1], '[]');
				$entryParamsList[$name] = $value;
			}
		}
		return $entryParamsList;
	}

	private function _loadAndRunWidgetClass($params) {
		$dir = JPATH_PLUGINS.'/content/plg_nok_widgets/widgets/';
		switch ($this->_hashget($params, 'provider')) {
			case 'coinmarketcap.com':
				JLoader::register('WidgetCoinMarketCap', $dir.'coinmarketcap.com.php', true);
				return WidgetCoinMarketCap::getHtml($params);
				break;
			case 'youtube.com':
				JLoader::register('WidgetYouTube', $dir.'youtube.com.php', true);
				return WidgetYouTube::getHtml($params);
				break;
			default:
				return '';
		}
	}

	private function _hashget($hashmap, $key) {
		if (isset($hashmap[$key])) {
			return $hashmap[$key];
		}
		return '';
	}
}
?>
