<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */	
class Oscprofessionals_ProductEnquiry_Model_Resource_Productenquiry extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     *  Passing Product enquiry Object to Abstract class _init function 
     */ 
    public function _construct()
    {    
       
        $this->_init('oscpproductenquiry/productenquiry', 'model_id');
    }
}