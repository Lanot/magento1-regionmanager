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

class Lanot_RegionManager_Model_Mysql4_Region
    extends Mage_Directory_Model_Mysql4_Region
{
    /**
     * @return array
     */
    public function getLocaleNames(Lanot_RegionManager_Model_Region $region)
    {
        $select = $this->_getLocalNamesSelect($region->getId());
        return $this->_getReadAdapter()->fetchAll($select);
    }

    /**
     * @param Lanot_RegionManager_Model_Region $region
     * @return Lanot_RegionManager_Model_Mysql4_Region
     */
    public function saveLocaleName(Lanot_RegionManager_Model_Region $region)
    {
        $items = $region->getData('local_name');
        $this->_removeLocalNames($region->getId());
        if (!empty($items) && is_array($items)) {
            $this->_saveLocalNames($region->getId(), $items);
        }

        return $this;
    }

    /**
     * Retrieve select object for load names data
     *
     * @param $regionId
     * @return Varien_Db_Select
     */
    protected function _getLocalNamesSelect($regionId)
    {
        $select = $this->_getReadAdapter()->select()
            ->from($this->_regionNameTable, array('locale', 'name'))
            ->where($this->getIdFieldName() . ' = ?', $regionId);
        return $select;
    }

    /**
     * Remove local names
     *
     * @param $regionId
     * @return int
     */
    protected function _removeLocalNames($regionId)
    {
        $write = $this->_getWriteAdapter();
        return $write->delete($this->_regionNameTable, $write->quoteInto($this->getIdFieldName() .' = ?', $regionId));
    }

    /**
     * Save local names
     *
     * @param $regionId
     * @param array $data
     * @return int
     */
    protected function _saveLocalNames($regionId, $data)
    {
        $write = $this->_getWriteAdapter();
        foreach($data as &$item) {
            $item[$this->getIdFieldName()] = $regionId;
        }

        return $write->insertArray(
            $this->_regionNameTable,
            array('locale', 'name', 'region_id'),
            array_values($data)
        );
    }

    /**
     * @hack for old versions, 1.5 and earlie
     * Retrieve connection for read data
     *
     * @return Varien_Db_Adapter_Interface
     */
    protected function _getReadAdapter()
    {
        if ($this->_read) {
            return $this->_read;
        } else {
            return parent::_getReadAdapter();
        }
    }

    /**
     * @hack for old versions, 1.5 and earlie
     * Retrieve connection for write data
     *
     * @return Varien_Db_Adapter_Interface
     */
    protected function _getWriteAdapter()
    {
        if ($this->_write) {
            return $this->_write;
        } else {
            return parent::_getWriteAdapter();
        }
    }
}
