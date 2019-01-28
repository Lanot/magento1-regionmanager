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
 * Regions List admin grid container
 *
 * @author Lanot
 */

class Lanot_RegionManager_Block_Adminhtml_Region
	extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Block constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'lanot_regionmanager';
        $this->_controller = 'adminhtml_region';
        $this->_headerText = Mage::helper('lanot_regionmanager')->__('Manage Regions');

        parent::__construct();

        if (Mage::helper('lanot_regionmanager/admin')->isActionAllowed('manage_region/save')) {
            $this->_updateButton('add', 'label', Mage::helper('lanot_regionmanager')->__('Add New Region'));
        } else {
            $this->_removeButton('add');
        }
    }
}

