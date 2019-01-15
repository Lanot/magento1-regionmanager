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
