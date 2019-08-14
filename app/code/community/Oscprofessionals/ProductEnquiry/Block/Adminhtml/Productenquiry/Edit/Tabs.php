<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Block_Adminhtml_Productenquiry_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs 
{

    public function __construct() 
    {
        parent::__construct();
        $this->setId('productenquiry_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('oscpproductenquiry')->__('Product Enquiry Information'));
    }

    protected function _beforeToHtml() 
    {

        $this->addTab('form_section', array(
            'label' => Mage::helper('oscpproductenquiry')->__('Product Enquiry  '),
            'title' => Mage::helper('oscpproductenquiry')->__('Product Enquiry  Information'),
            'content' => $this->getLayout()->createBlock('oscpproductenquiry/adminhtml_productenquiry_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}
