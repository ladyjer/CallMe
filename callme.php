<?php
/**
 * @package    callme
 * @subpackage Base
 * @author     Mariella {@link www.ladyj.eu}
 * @author     Created on 04-Dec-2014
 * @license    GNU/GPL
 */

defined('_JEXEC') || die;


jimport('joomla.plugin.plugin');

/**
 * Content Plugin.
 *
 * @package    callme
 * @subpackage Plugin
 */
class plgContentcallme extends JPlugin {

    /**
     * @param $text
     * @param $params
     * @return bool
     */
    protected  function callme (&$text, $params)
    {
        /*$pattern     = '/(\W[0-9]{4})-? ?(\W{0-9]{4})/';
        $replacement = '<a href="tel:$1$2">$1$2</a>';
        $text = preg_replace($pattern, $replacement, $text);*/
        $text .= "(...cit)";
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
            return $this->callme($article->text, $params);
        }
        return $this->callme($article, $params);
    }//function
}//class
