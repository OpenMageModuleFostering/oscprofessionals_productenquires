<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Helper_Data extends Mage_Core_Helper_Abstract 
{

    /**
     * Declare Constants 
     */
    const XML_PATH_ENQUIRY_NUMBER = 'productenquiry/email/enquiry_number';

    /**
     * Get product id and return product data 
     *
     * return Array
     */
    public function getEnquiryDetails($productId) 
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

    /**
     * Get product id and return count 
     *
     */
    public function getEnquiryCount($productId) 
    {

        $collection = Mage::getModel('oscpproductenquiry/productenquiry')->getCollection()
                ->addFieldToFilter('product_id', array('eq' => $productId))
                ->addFieldToFilter('is_approved', array('eq' => 1));

        $enquiryCount = $collection->getSize();
        return $enquiryCount;
    }

    /**
     * Get product id and return product data 
     *
     * return Array
     */
    public function getProduct($productId) 
    {
        $collection = Mage::getModel('catalog/product')->load($productId);
        return $collection;
    }
}
