<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Block_Adminhtml_productenquiry_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form 
{
    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm() 
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('productenquiry_form', array(
            'legend' => Mage::helper('oscpproductenquiry')->__('Product Enquiry Information')
        ));
        $fieldset->addField('product_id', 'text', array(
            'label' => Mage::helper('oscpproductenquiry')->__('Product ID'),
            'class' => 'text',
            'required' => true,
            'name' => 'product_id'
        ));
        $fieldset->addField('product_name', 'text', array(
            'label' => Mage::helper('oscpproductenquiry')->__('Product Name'),
            'class' => 'text',
            'required' => false,
            'name' => 'product_name'
        ));
        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('oscpproductenquiry')->__('Name'),
            'class' => 'text',
            'required' => false,
            'name' => 'name'
        ));
        $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('oscpproductenquiry')->__('Email Address'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'email'
        ));

        $fieldset->addField('question', 'textarea', array(
            'label' => Mage::helper('oscpproductenquiry')->__('Question'),
            'class' => 'text',
            'required' => false,
            'name' => 'question'
        ));

        $fieldset->addField('comment', 'textarea', array(
            'label' => Mage::helper('oscpproductenquiry')->__('Comment'),
            'class' => 'text',
            'required' => false,
            'name' => 'comment'
        ));

        $fieldset->addField('is_approved', 'select', array(
            'label' => Mage::helper('oscpproductenquiry')->__('Is Approved'),
            'title' => Mage::helper('oscpproductenquiry')->__('Is Approved'),
            'name' => 'is_approved',
            'required' => false,
            'options' => array(
                '0' => Mage::helper('oscpproductenquiry')->__('Pending'),
                '1' => Mage::helper('oscpproductenquiry')->__('Approved'),
            ),
        ));


        if (Mage::getSingleton('adminhtml/session')->getEmbriodaryData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getEmbriodaryData());
            Mage::getSingleton('adminhtml/session')->setEmbriodaryData(null);
        } elseif (Mage::registry('productenquiry_data')) {
            $form->setValues(Mage::registry('productenquiry_data')->getData());
        }

        return parent::_prepareForm();
    }

}
