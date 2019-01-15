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

/**
 * Region name admin edit form main tab block
 *
 * @author Lanot
 */
class Lanot_RegionManager_Block_Adminhtml_Region_Edit_Tab_Main_Name
    extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    /**
     * @var Lanot_RegionManager_Block_Adminhtml_Region_Edit_Tab_Main_Name_Locale
     */
    protected $_localeRenderer = null;

    /**
     * Prepare to render
     */
    protected function _prepareToRender()
    {
        $this->addColumn('locale', array(
            'label' => $this->_getHelper()->__('Locale'),
            'style' => 'width:120px',
            'renderer' => $this->_getLocaleRenderer(),
        ));

        $this->addColumn('name', array(
            'label' => $this->_getHelper()->__('name'),
            'style' => 'width:120px',
        ));

        $this->_addAfter = false;
        $this->_addButtonLabel = $this->_getHelper()->__('Add Locale Name');

        parent::_prepareToRender();
    }

    /**
     * Retrieve locale name renderer
     *
     * @return Lanot_RegionManager_Block_Adminhtml_Region_Locale
     */
    protected function _getLocaleRenderer()
    {
        if (null === $this->_localeRenderer) {
            $this->_localeRenderer = $this->getLayout()->createBlock(
                'lanot_regionmanager/adminhtml_region_locale', '',
                array('is_render_to_js_template' => true)
            );
            $this->_localeRenderer->setExtraParams('style="width:200px"');
        }
        return $this->_localeRenderer;
    }


    /**
     * Prepare existing row data object
     *
     * @param Varien_Object
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getLocaleRenderer()->calcOptionHash($row->getData('locale')),//'codepool'
            'selected="selected"'
        );
    }

    /**
     * @return Lanot_RegionManager_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('lanot_regionmanager');
    }
}
