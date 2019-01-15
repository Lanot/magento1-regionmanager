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

class Lanot_RegionManager_Model_Mysql4_Region_Collection
    extends Mage_Directory_Model_Mysql4_Region_Collection
{
    /**
     * Define main, country, locale region name tables
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('lanot_regionmanager/region');
    }

    /**
     * @param $locale
     * @return Lanot_RegionManager_Model_Mysql4_Region_Collection
     */
    public function addLocalName($locale)
    {
        $tbl = $this->_getMainTableName();

        $this->addBindParam(':lanot_locale', $locale);
        $this->getSelect()->joinLeft(
            array('tlocalname' => $this->_regionNameTable),
            $tbl . '.region_id = tlocalname.region_id AND tlocalname.locale = :lanot_locale',
            array('local_name' => new Zend_Db_Expr('IFNULL(tlocalname.name, ' . $tbl . '.default_name)'))
        );

        return $this;
    }

    protected function _getMainTableName()
    {
        $columns = $this->getSelect()->getPart(Zend_Db_Select::COLUMNS);
        if (isset($columns[0][0])) {
            return $columns[0][0];
        }
        return 'main_table';
    }
}
