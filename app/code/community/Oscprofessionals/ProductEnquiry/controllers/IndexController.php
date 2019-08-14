<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_IndexController extends Mage_Core_Controller_Front_Action 
{
    /**
     * Declare Constants 
     */
    const XML_PATH_EMAIL_RECIPIENT = 'productenquiry/email/recipient_email_sendto';
    const XML_PATH_EMAIL_SENDER = 'productenquiry/email/sender_email_identity_sender';
    const XML_PATH_EMAIL_TEMPLATE = 'productenquiry/email/email_template';

    /**
     * Load the view for ProductEnquiry
     */
    public function indexAction() 
    {

        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Validate posted data
     */
    public function dataValidation() 
    {
        $post = $this->getRequest()->getPost();
        try {
            $error = false;
            if (!Zend_Validate::is(trim($post['name']), 'NotEmpty')) {
                $error = true;
            }
            if (!Zend_Validate::is(trim($post['email']), 'NotEmpty')) {
                $error = true;
            }

            if (!Zend_Validate::is(trim($post['question']), 'NotEmpty')) {
                $error = true;
            }

            if ($error) {
                throw new Exception();
            }
            return;
        } catch (Exception $e) {
            return;
        }
    }

    /**
     * Form post action
     */
    public function postAction() 
    {

        $post = $this->getRequest()->getPost();

        $model = Mage::getModel('oscpproductenquiry/productenquiry');
        $model->setData($post);
        $model->setCreatedAt(now());
        $model->setUpdatedAt(now());

        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customerId = Mage::getModel('customer/session')->getCustomer()->getId();
            $model->setCustomerId($customerId);
        }

        $model->save();

        $translate = Mage::getSingleton('core/translate');
        $emailTemplateDelivery = Mage::getModel('core/email_template')
                ->loadDefault('productenquiry_pucemail_email_template');

        try {
            $postObject = new Varien_Object();
            $postObject->setData($post);

            $error = false;

            if (!Zend_Validate::is(trim($post['name']), 'NotEmpty')) {
                $error = true;
            }

            if (!Zend_Validate::is(trim($post['email']), 'NotEmpty')) {
                $error = true;
            }

            if (!Zend_Validate::is(trim($post['question']), 'NotEmpty')) {
                $error = true;
            }

            if ($error) {
                throw new Exception();
            }


            $mailTemplate = Mage::getModel('core/email_template');
			echo __line__;

            $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                    ->setReplyTo($post['email'])
                    ->sendTransactional(
                            Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE), Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER), Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT), null, array('data' => $postObject)
            );

            Mage::getSingleton('core/session')->addSuccess(Mage::helper('oscpproductenquiry')->__('Your question was submitted and will be responded to as soon as possible. Thank you for contacting us.'));

            $this->_redirectUrl(Mage::getBaseUrl() . "productenquiry/index/index/id/" . $post['product_id']);
			
            return;
        } catch (Exception $e) {
			echo $e;
			exit;
            $translate->setTranslateInline(true);
            Mage::getSingleton('core/session')->addError(Mage::helper('oscpproductenquiry')->__('Unable to submit your request. Please, check all required fields'));
            $this->_redirectUrl(Mage::getBaseUrl() . 'productenquiry?id=' . $post['product_id']);
            return;
        }
    }

}
