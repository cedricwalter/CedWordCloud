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

// reuse joomla code to get tag model
require_once JPATH_SITE . '/modules/mod_tags_similar/helper.php';
require_once JPATH_SITE . '/components/com_cedwordcloud/helpers/wordcloud.php';
require_once JPATH_SITE . '/components/com_cedwordcloud/helpers/rotating.php';

$cacheParams = new stdClass;
$cacheParams->cachemode = 'safeuri';
$cacheParams->class = 'ModTagssimilarHelper';
$cacheParams->method = 'getList';
$cacheParams->methodparams = $params;
$cacheParams->modeparams = array('id' => 'array', 'Itemid' => 'int');

$list = JModuleHelper::moduleCache($module, $params, $cacheParams);

if (!count($list))
{
	return;
}

$moduleclass_sfx	= htmlspecialchars($params->get('moduleclass_sfx'));


require JModuleHelper::getLayoutPath('mod_cedwordcloud_similar', $params->get('layout', 'default'));