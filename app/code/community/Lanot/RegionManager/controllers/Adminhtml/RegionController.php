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

class Lanot_RegionManager_Adminhtml_RegionController
	extends Lanot_Core_Controller_Adminhtml_AbstractController
{
    protected $_msgTitle = 'Regions';
    protected $_msgHeader = 'Manage Regions';
    protected $_msgItemDoesNotExist = 'The Region item does not exist.';
    protected $_msgItemNotFound = 'Unable to find the region item #%s.';
    protected $_msgItemEdit = 'Edit Region Item';
    protected $_msgItemNew = 'New Region Item';
    protected $_msgItemSaved = 'The Region item has been saved.';
    protected $_msgItemDeleted = 'The Region item has been deleted';
    protected $_msgError = 'An error occurred while edit the Region item.';
    protected $_msgErrorItems = 'An error occurred while edit the Region items %s.';
    protected $_msgItems = 'The Region items (#%s) has been';

    protected $_menuActive = 'lanot/manage_region';
    protected $_aclSection = 'manage_region';

    /**
     * @return Mage_Core_Model_Abstract
     */
    protected function _getItemModel()
    {
        return Mage::getSingleton('lanot_regionmanager/region');
    }

    /**
     * @param Mage_Core_Model_Abstract $model
     * @return Lanot_RegionManager_Adminhtml_RegionController
     */
    protected function _registerItem(Mage_Core_Model_Abstract $model)
    {
        Mage::register('lanot.region.item', $model);
        return $this;
    }

    /**
     * @return Lanot_RegionManager_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('lanot_regionmanager');
    }

    /**
     * @return Lanot_RegionManager_Helper_Admin
     */
    protected function _getAclHelper()
    {
        return Mage::helper('lanot_regionmanager/admin');
    }

    /**
     * Grid with serializer ajax action
     */
    public function regiongridAction()
    {
        $this->_loadLayouts();
    }

    /**
     * Grid only ajax action
     */
    public function regiongridonlyAction()
    {
        $this->_loadLayouts();
    }
}
