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
        if($productId){
            return Mage::getModel('oscpproductenquiry/productenquiry')->getProductEnquiryDetails($productId);
        }else {
            return null;
        }
    }

    /**
     * Check module is enable or not
     *
     */
    public function getEnable() 
    {

        return Mage::getStoreConfig(self::XML_PATH_ENABLE);
    }

    /**
     * Get product id and return count 
     *
     */
    public function getEnquiryCount($productId) 
    {
        if($productId){
            $collection = Mage::getModel('oscpproductenquiry/productenquiry')->getCollection()
                ->addFieldToFilter('product_id', array('eq' => $productId))
                ->addFieldToFilter('is_approved', array('eq' => 1));

            $enquiryCount = $collection->getSize();
            return $enquiryCount;
        }else {
            return $enquiryCount=null;
        }
    }

    /**
     * Get product id and return product data 
     *
     * return Array
     */
    public function getProduct($productId) 
    {
        if($productId){
            $collection = Mage::getModel('catalog/product')->load($productId);
            return $collection;
        }else {
            return $collection=null;
        }
    }

    /**
     * return module version 
     *
     */
    public function getExtensionVersion()
	{
		return (string) Mage::getConfig()->getNode()->modules->Oscprofessionals_ProductEnquiry->version;
	}
    
     /**
     * return product url 
     *
     */
    public function getProductUrl($productId)
    {
           
      $product = Mage::getModel('catalog/product')->load($productId);
      return $product->getUrl();
    }
  
}
