<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.callme
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mariella {@link www.ladyj.eu}
 * @author      Created on 04-Dec-2014
 * @license     GNU/GPL
 */

defined('_JEXEC') || die;


jimport('joomla.plugin.plugin');

/**
 * Content Plugin.
 *
 * Replace telephone numbers with a clic-to-call reference:
 * <a href="tel:...">...</a>
 *
 * @package    callme
 * @subpackage Plugin
 */
class plgContentcallme extends JPlugin {

    /**
     * @param  string   $text   text to be scanned and modified
     * @return boolean  always returns true
     */
    protected  function callme (&$text)
    {
        //pattern matches 4 digits
        //followed by a space, '-' or '/' followed by 4 digits more
        $pattern     = '/([0-9]{4})-? ?\/?([0-9]{4})/';
        $replacement = '<a href="tel:$1$2">$1/$2</a>';
        $text = preg_replace($pattern, $replacement, $text);

        return true;
    }

    /**
     * Example prepare content method
     *
     * Method is called by the view
     *
     * @param  string  $context     The context of the content being passed to the plugin.
     * @param  object  &$article    The content object.  Note $article->text is also available
     * @param  object  &$params     The content params
     * @param  int     $limitstart  The 'page' number
     * @return boolean always returs true
     */
    public function onContentPrepare($context, &$article, &$params, $limitstart)
    {
        if ($context == 'com_finder.indexer') {
            return true;
        }

        if (is_object($article)) {
            return $this->callme($article->text);
        }
        return $this->callme($article);
    }//function
}//class
