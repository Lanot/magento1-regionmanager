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
