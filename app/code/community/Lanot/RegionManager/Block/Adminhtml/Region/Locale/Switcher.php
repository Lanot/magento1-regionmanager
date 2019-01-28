<?php
/**
 * Private Entrepreneur Anatolii Lehkyi (aka Lanot)
 *
 * @category    Lanot
 * @package     Lanot_RegionManager
 * @copyright   Copyright (c) 2010 Anatolii Lehkyi
 * @license     http://opensource.org/licenses/osl-3.0.php
 * @link        http://www.lanot.biz/
 */

/**
 * Region name locale admin edit form main tab block
 *
 * @author Lanot
 */
class Lanot_RegionManager_Block_Adminhtml_Region_Locale_Switcher
    extends Mage_Core_Block_Template
{
    protected $_localeVarName = 'locale_id';

    /**
     * @return mixed|string
     */
    public function getSwitchUrl()
    {
        if ($url = $this->getData('switch_url')) {
            return $url;
        }
        return $this->getUrl('*/*/*', array('_current' => true, $this->_localeVarName => null));
    }

    /**
     * @return string;
     */
    public function getCurrentLocale()
    {
        $locale = $this->getRequest()->getParam($this->_localeVarName);
        if (empty($locale)) {
            $locale = Mage::app()->getLocale()->getLocaleCode();
        }
        return $locale;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return Mage::getModel('adminhtml/system_config_source_locale')->toOptionArray();
    }

    /**
     * @return string
     */
    public function getLocaleVarName()
    {
        return $this->_localeVarName;
    }
}
