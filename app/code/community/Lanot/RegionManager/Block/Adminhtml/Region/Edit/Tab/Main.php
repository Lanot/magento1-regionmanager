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
 * Region admin edit form main tab block
 *
 * @author Lanot
 */
class Lanot_RegionManager_Block_Adminhtml_Region_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected $_idPrefix = 'region_main_';

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
     * Prepare form elements for tab
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
    	/* @var $model Mage_Directory_Model_Region */
        $model = $this->_getHelper()->getRegionItemInstance();

        /* @var $helper Lanot_RegionManager_Helper_Admin */
        $helper = $this->_getAclHelper();

        /**
         * Checking if user have permissions to save information
         */
        if ($helper->isActionAllowed('manage_region/save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('region_main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => $this->_getHelper()->__('Region Item Info')
        ));

        $this->_addElementTypes($fieldset);

        if ($model->getId()) {
            $fieldset->addField('region_id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addField('country_id', 'select', array(
            'name'     => 'country_id',
            'label'    => $this->_getHelper()->__('Country'),
            'title'    => $this->_getHelper()->__('Country'),
            'required' => true,
            'values'   => $this->_getCountryOptions(),
            'style'    => 'width: 200px',
            'disabled' => $isElementDisabled,
        ));

        $fieldset->addField('code', 'text', array(
            'name'     => 'code',
            'label'    => $this->_getHelper()->__('Code'),
            'title'    => $this->_getHelper()->__('Code'),
            'required' => false,
            'disabled' => $isElementDisabled,
        ));

        $fieldset->addField('default_name', 'text', array(
            'name'     => 'default_name',
            'label'    => $this->_getHelper()->__('Default Name'),
            'title'    => $this->_getHelper()->__('Default Name'),
            'required' => true,
            'disabled' => $isElementDisabled,
        ));

        $fieldset->addField('local_name', 'text', array(
            'name'     => 'local_name',
            'label'    => $this->_getHelper()->__('Local Name'),
            'title'    => $this->_getHelper()->__('Local Name'),
            'required' => true,
            'disabled' => $isElementDisabled,
        ));

        $form->getElement('local_name')->setRenderer(
            $this->getLayout()->createBlock('lanot_regionmanager/adminhtml_region_edit_tab_main_name')
        );

        Mage::dispatchEvent('adminhtml_lanotregion_edit_tab_main_prepare_form', array(
            'form'   => $form,
            'region' => $model
        ));

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return $this->_getHelper()->__('Region Info');
    }

    public function getTabTitle()
    {
        return $this->_getHelper()->__('Region Info');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    protected function _getCountryOptions()
    {
        return Mage::getModel('directory/country')->getCollection()->load()->toOptionArray('');
    }
}
