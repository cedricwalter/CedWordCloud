<?php
/**
 * @package     CedWordCloud
 * @subpackage  com_cedwordle
 *
 * @copyright   Copyright (C) 2013-2019 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');
require_once (JPATH_COMPONENT . '/controller.php');

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root() . 'media/com_cedwordcloud/css/thumbnails.css');

$controller = JFactory::getApplication()->input->get('controller');
$task = JFactory::getApplication()->input->get('task');

// Create the controller
$controller = new CedWordcloudController();

// Perform the Request task
$controller->execute($task);

// Redirect if set by the controller
$controller->redirect();

