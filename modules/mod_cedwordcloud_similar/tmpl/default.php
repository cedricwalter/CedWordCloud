<?php
/**
 * @package     CedWordCloud
 * @subpackage  com_cedwordle
 * http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL 3.0</license>
 * @copyright   Copyright (C) 2013-2019 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */


// Don't allow direct access to the module.
defined('_JEXEC') or die('Restricted access');

$generator = new CedWordCloudGenerator();

$document = JFactory::getDocument();
$document->addScript($generator->getScriptUrl());

$css = "https://fonts.googleapis.com/css?family=".$params->get('googleFont', 'Niconne');
$document->addStyleSheet($css);


$document->addScriptDeclaration($generator->getScriptDeclaration($params, $list));
?>

<div class="tagspopular<?php echo $moduleclass_sfx; ?>" >
    <!-- Copyright (C) 2013-2019 galaxiis.com All rights reserved. -->
    <canvas
            width="<?php echo $params->get('width', 600) ?>"
            height="<?php echo $params->get('height', 600) ?>"
            id="<?php echo $generator->id ?>">
    </canvas>
</div>