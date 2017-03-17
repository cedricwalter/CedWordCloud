<?php
/**
 * @package     CedWordCloud
 * @subpackage  com_cedwordle
 * http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL 3.0</license>
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

class CedWordCloudGenerator
{

	var $uuid;
	var $id;

	function __construct()
	{
		$this->uuid = uniqid();
		$this->id   = "cedwordcloudpopular$this->uuid";
	}

	public function getScriptUrl()
	{
		return JUri::base() . "media/com_cedwordcloud/js/wordcloud2.js?v=3.0.2";
	}

	public function getClickableScriptDeclaration($params, $list)
	{

		return null;
	}

	public function getScriptDeclaration($params, $list)
	{
		$shape           = $params->get('shape', 'square');
		$minRotation     = $params->get('minRotation2', 0);
		$maxRotation     = $params->get('maxRotation2', 0);
		$rotateRatio     = $params->get('rotateRatio', 0);
		$backgroundColor = $params->get('backgroundColor', 'rgba(255, 255, 255, 0)');

		$clearCanvas = $params->get('clearCanvas', true);
		$drawOutOfBound = $params->get('drawOutOfBound', true);

		$fontFamily = "fontFamily: 'Average, Times, serif',";

		$color = "color: '" . $params->get('color', 'random-dark') . "',";

		$gridSize = $params->get('gridSize', 2);

		//https://github.com/timdream/wordcloud2.js

		$listResult = $this->getListAsStringArray($params, $list);
		$handler    = $this->getHandler($params);

		return "
   jQuery(document).ready(function(){

        var options$this->uuid =
        {
          list : [ $listResult ],
          weightFactor:  1,
          gridSize: $gridSize,
          shape: '$shape',
          rotateRatio: $rotateRatio,
          minRotation: $minRotation,
          maxRotation: $maxRotation,
          hover: window.drawBox,
          $color
          $fontFamily
          clearCanvas: $clearCanvas,
          drawOutOfBound: $drawOutOfBound,
          shuffle: false,
          backgroundColor: '$backgroundColor',
          $handler
        };

        WordCloud(document.getElementById('$this->id'), options$this->uuid);
   });";
	}

	private function getListAsStringArray($params, $list)
	{
		$listModels = $this->getTagModelList($params, $list);
		foreach ($listModels as $listModel)
		{
			//title , size
			$listItem[] = "['$listModel[0]', $listModel[1]]";
		}
		$listResult = implode(",", $listItem);

		return $listResult;
	}

	public function getTagModelList($params, $list)
	{
		$minFontSize = $params->get('minFontSize', 5);
		$maxFontSize = $params->get('maxFontSize', 20);

		$min        = $this->getMinTagCount($list);
		$max        = $this->getMaxTagCount($list);
		$formula = $params->get('formula', 'linear');

		$listItems = array();
		JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');
		foreach ($list as $item)
		{
			$url = "#";

			//custom tag
			if (isset($item->itstitle))
			{
				$title = $item->itstitle;
				$url   = $item->url;
			}
			else
			{
				if (isset($item->title)) //popular tag
				{
					$title = $item->title;
					$url   = JRoute::_(TagsHelperRoute::getTagRoute($item->tag_id . ':' . $item->alias));
				}
				else
				{
					if (isset($item->core_title)) //similar tag
					{
						$title = $item->core_title;
						$url   = JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias,
							$item->core_catid, $item->core_language, $item->type_alias, $item->router));
					}
				}
			}

			if ($formula == 'linear')
			   $size = ($item->count / $max) * ($maxFontSize - $minFontSize) + $minFontSize;
			else
				$size = log($item->count) / log($max) * ($maxFontSize - $minFontSize) ;

			$listItems[] = [
				$title, $size,
				$url
			];
		}

		return $listItems;
	}


	private function getHandler($params)
	{
		$handler = "";
		return $handler;
	}


	private function getMinTagCount($list)
	{
		$min = PHP_INT_MAX;
		foreach ($list as $item)
		{
			if ($item->count <= $min)
			{
				$min = $item->count;
			}
		}

		return $min;
	}

	private function getMaxTagCount($list)
	{
		$max = -PHP_INT_MAX;
		foreach ($list as $item)
		{
			if ($item->count >= $max)
			{
				$max = $item->count;
			}
		}

		return $max;
	}

}