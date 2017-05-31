<?php
/**
 * @package     CedWordCloud
 * @subpackage  com_cedwordle
 * http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL 3.0</license>
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
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
        $this->id = "cedwordcloudpopular$this->uuid";
    }

    public function getScriptUrl()
    {
        return JUri::base() . "media/com_cedwordcloud/js/wordcloud2.js?v=3.0.11";
    }

    public function getClickableScriptDeclaration($params, $list)
    {

        return null;
    }

    public function getScriptDeclaration($params, $list)
    {
        $shape = $params->get('shape', 'square');
        $minRotation = $params->get('minRotation2', 0);
        $maxRotation = $params->get('maxRotation2', 0);
        $rotateRatio = $params->get('rotateRatio', 0);
        $backgroundColor = $params->get('backgroundColor', 'rgba(255, 255, 255, 0)');

        $clearCanvas = $params->get('clearCanvas', true);
        $drawOutOfBound = $params->get('drawOutOfBound', true);


        $googleFont = $params->get('googleFont', 'Niconne');

        //for light: font-weight : 100; Or font-weight : lighter;
        //for normal: font-weight : 500; Or font-weight : normal;
        //for bold: font-weight : 700; Or font-weight : bold;
        //for more bolder: font-weight : 900; Or font-weight : bolder;
        $fontWeight = "fontWeight: '" . $params->get('googleFontWeight', 'normal') . "',";

        $fontStyle = "fontStyle: '" . $params->get('googleFontStyle', 'normal') . "',";

        $fontFamily = "fontFamily : '$googleFont, sans-serif',";

        $color = "color: '" . $params->get('color', 'random-dark') . "',";

        $gridSize = $params->get('gridSize', 2);

        //https://github.com/timdream/wordcloud2.js

        $listResult = $this->getListAsStringArray($params, $list);

        $handler = $this->getClickHandler($params);

        // issue in safari with webfont
        jimport('joomla.environment.browser');
        $browser = JBrowser::getInstance();
        $browserType = $browser->getBrowser();

        $fontsParameters = "";
        if ($browserType != 'safari') {
            $fontsParameters = "$fontFamily
          $fontWeight
          $fontStyle";
        }


        return "
        
        //chrome has also the keyword safari in user agent
        if (navigator.userAgent.indexOf('Safari') != -1 
           && navigator.userAgent.indexOf('Chrome') == -1) {
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
              clearCanvas: $clearCanvas,
              drawOutOfBound: $drawOutOfBound,
              shuffle: false,
              backgroundColor: '$backgroundColor',
              $handler
            };
        } else  {
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
              $fontWeight
              $fontStyle
              clearCanvas: $clearCanvas,
              drawOutOfBound: $drawOutOfBound,
              shuffle: false,
              backgroundColor: '$backgroundColor',
              $handler
            };
        }
        
		jQuery(document).ready(function(){
          WordCloud(document.getElementById('$this->id'), options$this->uuid);
        });
		
		";
    }

    private function getListAsStringArray($params, $list)
    {
        $listModels = $this->getTagModelList($params, $list);
        foreach ($listModels as $listModel) {
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

        $min = $this->getMinTagCount($list);
        $max = $this->getMaxTagCount($list);
        $formula = $params->get('formula', 'linear');

        $listItems = array();
        JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');
        foreach ($list as $item) {
            $url = "#";

            //custom tag
            if (isset($item->itstitle)) {
                $title = $item->itstitle;
                $url = $item->url;
            } else {
                if (isset($item->title)) //popular tag
                {
                    $title = $item->title;

                    if (property_exists($item, 'tag_id')) {
                        $url = JRoute::_(TagsHelperRoute::getTagRoute($item->tag_id . ':' . $item->alias));
                    } else {
                        //K2 support
                        $url = $item->url;
                    }
                } else {
                    if (isset($item->core_title)) //similar tag
                    {
                        $title = $item->core_title;
                        $url = JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias,
                            $item->core_catid, $item->core_language, $item->type_alias, $item->router));
                    }
                }
            }

            if ($formula == 'linear') {
                $size = ($item->count / $max) * ($maxFontSize - $minFontSize) + $minFontSize;
            } else {
                $size = log($item->count) / log($max) * ($maxFontSize - $minFontSize);
            }

            $listItems[] = [
                $title,
                $size,
                $url
            ];
        }

        return $listItems;
    }


    private function getClickHandler($params)
    {
        $handler = "";
        return $handler;
    }


    private function getMinTagCount($list)
    {
        $min = PHP_INT_MAX;
        foreach ($list as $item) {
            if ($item->count <= $min) {
                $min = $item->count;
            }
        }

        return $min;
    }

    private function getMaxTagCount($list)
    {
        $max = -PHP_INT_MAX;
        foreach ($list as $item) {
            if ($item->count >= $max) {
                $max = $item->count;
            }
        }

        return $max;
    }

}