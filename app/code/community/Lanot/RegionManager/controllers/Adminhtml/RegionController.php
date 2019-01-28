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
