<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Block_ProductEnquiry extends Mage_Core_Block_Template 
{

    public function __construct() 
    {
        parent::__construct();

        $this->setTemplate('oscprofessionals/productenquiry/modelform.phtml');
    }

    /**
     * Prepare global layout
     *
     * @return Oscprofessionals_ProductEnquiry_Block_ProductEnquiry
     */
    protected function _prepareLayout() 
    {
        // breadcrumbs
        $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');

        $breadcrumbs->addCrumb('home', array('label' => Mage::helper('oscpproductenquiry')->__('Home'), 'title' => Mage::helper('oscpproductenquiry')->__('Home Page'), 'link' => Mage::getBaseUrl()));
        $currentUrl = Mage::helper('core/url')->getCurrentUrl();

        $id = explode("/", $this->getRequest()->getParam('id'));
        $product = $this->helper('oscpproductenquiry')->getProduct($id[0]);
        $productName = $product->getName();

        $breadcrumbs->addCrumb('product', array('label' => $productName, 'title' => $productName, 'link' => $product->getProductUrl()));

        $breadcrumbs->addCrumb('enquiry', array('label' => $this->__('Ask a Question') , 'title' => $this->__('Ask a Question')));

        $this->getLayout()->getBlock('breadcrumbs')->toHtml();

        return parent::_prepareLayout();
    }

}
