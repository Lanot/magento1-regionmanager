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
 * Region admin edit form block
 *
 * @author Lanot
 */
class Lanot_RegionManager_Block_Adminhtml_Region_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare FORM action
     *
     * @return Lanot_RegionManager_Block_Adminhtml_Region_Edit
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/save'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));
 
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}