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

class Lanot_RegionManager_Model_Observer
    extends Mage_Directory_Model_Region
{
    protected $_localeVarName = 'locale_id';

    /**
     * Add Region Local Name to Grid's Collection
     *
     * @param $observer
     * @return Lanot_RegionManager_Model_Observer
     */
    public function removeMassActions($observer)
    {
        /** @var $grid Lanot_RegionManager_Block_Adminhtml_Region_Grid */
        $grid = $observer->getEvent()->getGrid();
        if ($grid) {
            $grid->getMassactionBlock()->removeItem('delete');
            $grid->getMassactionBlock()->removeItem('active_enable');
            $grid->getMassactionBlock()->removeItem('active_disable');
        }
        return $this;
    }

    /**
     * Add Region Local Name to Grid's Collection
     *
     * @param $observer
     * @return Lanot_RegionManager_Model_Observer
     */
    public function addLocalNameToSelect($observer)
    {
        /** @var $collection Lanot_RegionManager_Model_Mysql4_Region_Collection */
        $collection = $observer->getEvent()->getCollection();
        if ($collection) {
            $collection->addLocalName($this->getCurrentLocale());
        }
        return $this;
    }

    /**
     * Retrieve current locale code
     *
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
     * Retrieve a request object
     *
     * @return Mage_Core_Controller_Request_Http
     */
    public function getRequest()
    {
        return Mage::app()->getRequest();
    }
}
