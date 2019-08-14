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
     * Declare Constants 
     */
    const XML_PATH_ENQUIRY_NUMBER = 'productenquiry/email/enquiry_number';

    /**
     * Call Parents _init function 
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('oscpproductenquiry/productenquiry'); 	
    }

    /**
     * Get product id and return product data 
     *
     * return Array
     */
    public function getProductEnquiryDetails($productId) 
    {
        $productenquiryData = array();
        $collection = Mage::getModel('oscpproductenquiry/productenquiry')->getCollection()
                ->addFieldToSelect('question')
                ->addFieldToSelect('is_approved')
                ->addFieldToSelect('product_id')
                ->addFieldToSelect('name')
                ->addFieldToSelect('email')
                ->addFieldToSelect('product_name')
                ->addFieldToSelect('comment')
                ->addFieldToSelect('created_at')
                ->addFieldToSelect('updated_at')
                ->addFieldToFilter('is_approved',array('eq' => 1))
			    ->addFieldToFilter('product_id',array('eq' => $productId))
                ->setOrder('updated_at', 'DESC');
        $collection->getSelect()->limit(Mage::getStoreConfig(self::XML_PATH_ENQUIRY_NUMBER));

        return $collection;
    }
}