<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Block_Adminhtml_Productenquiry extends Mage_Adminhtml_Block_Widget_Grid_Container 
{
    /*
     * Add Default Values to grid 
     */
    public function __construct() 
    {
        $this->_controller = 'adminhtml_productenquiry';
        $this->_blockGroup = 'oscpproductenquiry';
        $this->_headerText = Mage::helper('oscpproductenquiry')->__('Product Enquiry Information');
        $this->_addButtonLabel = Mage::helper('oscpproductenquiry')->__('Add Product Enquiry');
        parent::__construct();
    }

}
