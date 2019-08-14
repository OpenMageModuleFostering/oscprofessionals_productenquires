<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Model_Status extends Varien_Object
{
    /**
     * Declare Constants 
     */
    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 2;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('oscpproductenquiry')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('oscpproductenquiry')->__('Disabled')
        );
    }
}