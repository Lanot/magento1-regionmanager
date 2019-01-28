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

class Lanot_RegionManager_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return Mage_Directory_Model_Region
     */
    public function getRegionItemInstance()
    {
        return Mage::registry('lanot.region.item');
    }
}
