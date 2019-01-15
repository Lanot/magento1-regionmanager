<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Lanot
 * @package     Lanot_RegionManager
 * @copyright   Copyright (c) 2012 Lanot
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Lanot_RegionManager_Model_Region
    extends Mage_Directory_Model_Region
{
    protected function _construct()
    {
        $this->_init('lanot_regionmanager/region');
    }

    /**
     * @return Lanot_RegionManager_Model_Region
     */
    protected function _afterLoad()
    {
        parent::_afterLoad();

        if ($this->getData('local_name') === null) {
            $this->setData('local_name', $this->getResource()->getLocaleNames($this));
        }
        return $this;
    }

    /**
     * @return Lanot_RegionManager_Model_Region
     */
    protected function _beforeSave()
    {
        $this->_prepareLocalNameBeforeSave();
        return parent::_beforeSave();
    }

    /**
     * @return Lanot_RegionManager_Model_Region
     */
    protected function _afterSave()
    {
        parent::_afterSave();
        $this->getResource()->saveLocaleName($this);
        return $this;
    }

    /**
     * @return Lanot_RegionManager_Model_Region
     */
    protected function _prepareLocalNameBeforeSave()
    {
        //#1
        $localNames = $this->getData('local_name');
        if (!is_array($localNames)) {
            $this->setData('local_name', array());
        }

        //#2
        $localNames = array_filter(array_values($localNames));
        $items = array();
        foreach($localNames as $item) {
            if (!isset($item['locale'])) {
                continue;
            }
            $items[$item['locale']] = $item;
        }

        //#3
        $locale = Mage_Core_Model_Locale::DEFAULT_LOCALE;
        if (!isset($item[$locale])) {
            $items[$locale] = array(
                'locale' => $locale,
                'name' => $this->getData('default_name'),
            );
        }

        $this->setData('local_name', $items);
        return $this;
    }
}
