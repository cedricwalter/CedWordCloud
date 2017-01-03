<?php
/**
 * @package     cedThumbnails
 * @subpackage  com_cedthumbnails
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

// Load the javascript
JHtml::_('behavior.framework');
JHtml::_('behavior.modal', 'a.modal');
?>

<div class="tagpanel">

    <div style="float: left;">
        <div class="icon">
            <a href="index.php?option=com_cedwordcloud&view=liveupdate"
               title="<?php echo JText::_('Live Update');?>"> <img
                    src="<?php echo JURI::root() ?>/media/com_cedwordcloud/images/update_48x48.png"
                    alt="<?php echo JText::_('Live Update');?>"/>
                <span><?php echo JText::_('Live Update');?></span></a></div>
    </div>
    <div style="float: left;">
        <div class="icon"><a href="https://www.galaxiis.com/" target="_blank"
                             title="<?php echo JText::_('HOME PAGE');?>"> <img
                src="<?php echo JUri::root() ?>/media/com_cedwordcloud/images/galaxiis3.jpg"/>
            <span><?php echo JText::_('Home');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
                href="https://www.galaxiis.com/cedwordcloud-doc/"
                target="_blank"
                title="<?php echo JText::_('Manual');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedwordcloud/images/manual.png"/>
            <span><?php echo JText::_('Manual');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
                href="https://www.galaxiis.com/forums/"
                target="_blank"
                title="<?php echo JText::_('Forums');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedwordcloud/images/forum.png"/>
            <span><?php echo JText::_('Forums');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon"><a
                href="https://confluence.galaxiis.com/display/GAL/SOFTWARE+LICENSE+AGREEMENT"
                target="_blank"
                title="<?php echo JText::_('License');?>"> <img
                src="<?php echo JURI::root() ?>/media/com_cedwordcloud/images/license.png"/>
            <span><?php echo JText::_('License');?></span></a>
        </div>
    </div>


    <div style="float: left;">
        <div class="icon">
            <a href="https://www.galaxiis.com/cedwordcloud-jed/"
               target="_blank"
               title="<?php echo JText::_('JED VOTE');?>"> <img
                    src="<?php echo JURI::root() ?>/media/com_cedwordcloud/images/jed.png"/>
                <span><?php echo JText::_('JED vote');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="https://www.galaxiis.com/cedwordcloud-download/"
               target="_blank"
               title="<?php echo JText::_('Download');?>"> <img
                    src="<?php echo JURI::root() ?>/media/com_cedwordcloud/images/download.png"/>
                <span><?php echo JText::_('Download');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="https://www.facebook.com/galaxiiscom"
               target="_blank"
               title="<?php echo JText::_('Like on Facebook');?>"> <img
                    src="<?php echo JURI::root() ?>/media/com_cedwordcloud/images/facebook.png"/>
                <span><?php echo JText::_('Like on Facebook');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="https://twitter.com/galaxiiscom"
               target="_blank"
               title="<?php echo JText::_('Follow Me on Twitter');?>"> <img
                    src="<?php echo JURI::root() ?>/media/com_cedwordcloud/images/twitter.png"/>
                <span><?php echo JText::_('Follow Me on Twitter');?></span></a>
        </div>
    </div>
    <div style="float: left;">
        <div class="icon">
            <a href="https://plus.google.com/u/0/104558366166000378462"
               target="_blank"
               title="<?php echo JText::_('Follow Me on Google+');?>"> <img
                    src="<?php echo JURI::root() ?>/media/com_cedwordcloud/images/google.png"/>
                <span><?php echo JText::_('Follow Me on Google+');?></span></a>
        </div>
    </div>
</div>

<div class="tagversion">

    <h1>CedWordcloud 1.8.1 <?php echo $this->isFree; ?></h1>

        <h3>join now - get the licensed version of CedWordcloud and enjoy more customizations and features!</h3>
        <a href="https://www.galaxiis.com/cedwordcloud-subscribe/" alt="join now" title="join now - get the licensed version of CedWordcloud and enjoy more customizations and features!" target="_new"><img src="<?php echo JURI::root() ?>/media/com_cedwordcloud/images/joinnow.png" /></a>

    <p>Copyright (C) 2013-2016 galaxiis.com All rights reserved.</p>
</div>