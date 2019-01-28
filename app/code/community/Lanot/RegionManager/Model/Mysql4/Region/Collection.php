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
