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
class Lanot_RegionManager_Block_Adminhtml_Region_Locale
    extends Mage_Core_Block_Html_Select
{
    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->_getLocales());
        }
        return parent::_toHtml();
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * @return array
     */
    protected function _getLocales()
    {
        return Mage::getModel('adminhtml/system_config_source_locale')->toOptionArray();
    }
}
