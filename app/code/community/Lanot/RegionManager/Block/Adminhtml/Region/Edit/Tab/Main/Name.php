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
