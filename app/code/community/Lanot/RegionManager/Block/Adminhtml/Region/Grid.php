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
 * Regions list admin grid
 *
 * @author Lanot
 */
class Lanot_RegionManager_Block_Adminhtml_Region_Grid
    extends Lanot_Core_Block_Adminhtml_Grid_Abstract
{
    protected $_gridId = 'lanotregionGrid';
    protected $_entityIdField = 'region_id';
    protected $_itemParam = 'region_id';
    protected $_formFieldName = 'region';
    protected $_eventPrefix = 'region_';

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
     * @return Mage_Directory_Model_Region
     */
    protected function _getItemModel()
    {
        return Mage::getSingleton('lanot_regionmanager/region');
    }

    /**
     * Checks when this block is readonly
     *
     * @return boolean
     */
    public function isReadonly()
    {
        return !$this->_getAclHelper()->isActionAllowed('manage_region');
    }

    /**
     * Prepare Grid columns
     *
     * @return Lanot_RegionManager_Block_Adminhtml_Region_Grid
     */
    protected function _prepareColumns()
    {
        if ($this->_isTabGrid) {
            $this->addColumn('in_selected', array(
                'header_css_class' => 'a-center',
                'type' => 'checkbox',
                'name' => 'in_selected',
                'values' => $this->_getSelectedLinks(),
                'align' => 'center',
                'index' => $this->_entityIdField,
            ));
        }

        $this->addColumn($this->_entityIdField, array(
            'header' => $this->_getHelper()->__('ID'),
            'index'  => $this->_entityIdField,
            'type'   => 'number',
            'width'  => '50px',
        ));

        $this->addColumn('country_id', array(
            'header' => $this->_getHelper()->__('Country'),
            'index'  => 'country_id',
            'width'  => '150px',
            'type'   => 'options',
            'options' => $this->_getCountryOptions(),
        ));

        $this->addColumn('code', array(
            'header' => $this->_getHelper()->__('Code'),
            'index'  => 'code',
            'width'  => '120px',
        ));

        $this->addColumn('default_name', array(
            'header' => $this->_getHelper()->__('Default Name'),
            'index'  => 'default_name',
        ));

        $this->addColumn('local_name', array(
            'header' => $this->_getHelper()->__('Local Name'),
            'index'  => 'local_name',
        ));

        if (!$this->_isTabGrid) {
            $this->addColumn('action',
                array(
                    'header'    => $this->_getHelper()->__('Action'),
                    'width'     => '70px',
                    'align'     => 'center',
                    'type'      => 'action',
                    'getter'    => 'getId',
                    'actions'   => array(
                        array(
                            'caption' => $this->_getHelper()->__('Edit'),
                            'url'     => array('base' => '*/*/edit'),
                            'field'   => 'id'
                        )
                    ),
                    'filter'    => false,
                    'sortable'  => false,
                    'index'     => $this->_entityIdField,
                ));
        }

        Mage::dispatchEvent($this->_eventPrefix . 'lanot_grid_prepare_columns', array('grid' => $this));

        return Mage_Adminhtml_Block_Widget_Grid::_prepareColumns();
    }

    /**
     * @return array
     */
    protected function _getCountryOptions()
    {
        $options = array();
        $collection = Mage::getModel('directory/country')->getCollection();
        foreach($collection as $item) {
            $options[$item->getId()] = $item->getName();
        }
        return $options;
    }
}
