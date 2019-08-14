<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Block_Adminhtml_productenquiry_Edit extends Mage_Adminhtml_Block_Widget_Form_Container 
{
    /**
     * Add Default Values to form 
     */
    public function __construct() 
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'oscpproductenquiry';
        $this->_controller = 'adminhtml_productenquiry';

        $this->_updateButton('save', 'label', Mage::helper('oscpproductenquiry')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('oscpproductenquiry')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save'
                ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('productenquiry_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'productenquiry_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'productenquiry_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText() 
    {
        if (Mage::registry('productenquiry_data') && Mage::registry('productenquiry_data')->getId()) {
            return Mage::helper('oscpproductenquiry')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('productenquiry_data')->getTitle()));
        } else {
            return Mage::helper('oscpproductenquiry')->__('Add Item');
        }
    }

    public function isAjax() 
    {
        return Mage::app()->getRequest()->isXmlHttpRequest() || Mage::app()->getRequest()->getParam('isAjax');
    }

    public function getJsObjectName() 
    {
        return $this->getId() . 'JsObject';
    }

}
