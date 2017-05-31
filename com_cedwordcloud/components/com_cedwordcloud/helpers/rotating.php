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

require_once 'Mobile_Detect.php';


class CedWordCloudRotating
{

	function __construct()
	{
	}



	public function getScript($generator, $params)
	{
		$rotating_shape         = $params->get('rotating-shape', 'sphere');
		$rotating_outlineColour = $params->get('rotating-outlineColour', 'rgba(255, 255, 255, 0)');
		$rotating_textColour    = $params->get('rotating-textColour', 'rgba(0, 0, 255, 1)');
		$rotating_weightMode    = $params->get('rotating-weightMode', 'none');
		$rotating_reverse       = $params->get('rotating-reverse', 'false');

		$rotating_maxBrightness = intval($params->get('rotating-maxBrightness', '1')) / 10;
		$rotating_minBrightness = intval($params->get('rotating-minBrightness', '0.1')) / 10;
		$rotating_wheelZoom     = $params->get('rotating-wheelZoom', 'true');
		$rotating_noMouse       = $params->get('rotating-noMouse', 'false');

		$detect = new Mobile_Detect;
		$touch  = "";
		if ($detect->isMobile())
		{
			$rotating_pinchZoom   = $params->get('rotating-pinchZoom', 'true');
			$rotating_dragControl = $params->get('rotating-dragControl', 'true');

			$touch = "pinchZoom: '$rotating_pinchZoom',
                      dragControl: '$rotating_dragControl',";
		}

		$rotating_shadow       = $params->get('rotating-shadow', 'rgba(0, 0, 0, 1)');
		$rotating_activeCursor = $params->get('rotating-activeCursor', 'pointer');

		$rotating_textFont = $params->get('googleFont', 'Niconne');
        $googleFont = $params->get('googleFont', 'Niconne');

        //for light: font-weight : 100; Or font-weight : lighter;
        //for normal: font-weight : 500; Or font-weight : normal;
        //for bold: font-weight : 700; Or font-weight : bold;
        //for more bolder: font-weight : 900; Or font-weight : bolder;
        $googleFontWeight = $params->get('googleFontWeight', 'normal');
        $googleFontStyle = $params->get('googleFontStyle', 'normal');
        //; font-weight: $googleFontWeight; font-style:$googleFontStyle;

        $fontFamily = "fontFamily : '$googleFont, sans-serif',";


		$rotating_gr1 = $params->get('rotating-gr1', 'rgba(255, 0, 0, 1)');
		$rotating_gr2 = $params->get('rotating-gr2', 'rgba(255, 255, 0, 1)');
		$rotating_gr3 = $params->get('rotating-gr3', 'rgba(0, 255, 0, 1)');
		$rotating_gr4 = $params->get('rotating-gr4', 'rgba(0, 0, 255, 1)');

		$script = "	
				var options = {
					    outlineColour: '$rotating_outlineColour',
			            reverse: '$rotating_reverse',
			            depth: 0.8,
			            maxSpeed: 0.05,
			            $fontFamily
			            activeCursor: '$rotating_activeCursor',
			            shadow: '$rotating_shadow',
						$touch
			            dragThreshold: 4,
			            wheelZoom: '$rotating_wheelZoom',
			            maxBrightness: $rotating_maxBrightness,
			            minBrightness: $rotating_minBrightness,
			            textColour: '$rotating_textColour',
			            weightMode: '$rotating_weightMode',
			            weight: true,
			            shape: '$rotating_shape',
			            weightGradient: {
			             0:    '$rotating_gr1', 
			             0.33: '$rotating_gr2', 
			             0.66: '$rotating_gr3', 
			             1:    '$rotating_gr4'  
			            }
					  },
					  WebFontConfig = {
					    google: {
					      families: [
					        '$rotating_textFont::latin',
					      ]
					    },
					    active: function() {
					      TagCanvas.Start('$generator->id', 'src-$generator->id', options)
					    }
					  };
					 
					(function() {
					  var wf = document.createElement('script');
					  wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
					    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
					  wf.type = 'text/javascript';
					  wf.async = 'true';
					  var s = document.getElementsByTagName('script')[0];
					  s.parentNode.insertBefore(wf, s);
					})();
				";

		return $script;
	}

}