<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Model_Productenquiry extends Mage_Core_Model_Abstract
{
    /**
     * Call Parents _init function 
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('oscpproductenquiry/productenquiry'); 	
    }
}