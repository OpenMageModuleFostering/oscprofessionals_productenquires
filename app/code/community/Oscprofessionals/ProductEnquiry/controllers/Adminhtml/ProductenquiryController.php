<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Adminhtml_ProductenquiryController extends Mage_Adminhtml_Controller_Action 
{

    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action 
     */
    protected function _initAction() 
    {

        $this->loadLayout()
                ->_setActiveMenu('productenquiry/items')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));

        return $this;
    }

    /**
     * Load the view for storelocator
     */
    public function indexAction() 
    {

        $this->_initAction()
                ->renderLayout();
    }

    /**
     * Edit product enquiry data into table
     */
    public function editAction() 
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('oscpproductenquiry/productenquiry')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('productenquiry_data', $model);
            $this->loadLayout();
            $this->_setActiveMenu('productenquiry/items');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Product Enquiry Manager'), Mage::helper('adminhtml')->__('Product Enquiry Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Product Enquiry News'), Mage::helper('adminhtml')->__('Product Enquiry News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('oscpproductenquiry/adminhtml_productenquiry_edit'))
                    ->_addLeft($this->getLayout()->createBlock('oscpproductenquiry/adminhtml_productenquiry_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('oscpproductenquiry')->__('Product Enquiry does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Save product enquiry Data into table
     */
    public function saveAction() 
    {
        if ($data = $this->getRequest()->getPost()) {
            $id = (int) $this->getRequest()->getParam('id');
            $model = Mage::getModel('oscpproductenquiry/productenquiry');

            $model->setData($data)->setId($this->getRequest()->getParam('id'));
            try {

                if (!$model->getId()) {
                    $model->setCreatedAt(now());
                    $model->setUpdatedAt(now());
                } else {
                    $model->setUpdatedAt(now());
                }

                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('oscpproductenquiry')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array(
                        'id' => $model->getId()
                    ));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('oscpproductenquiry')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

     /**
     * Delete Single row data frome table
     */
    public function deleteAction() 
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('oscpproductenquiry/productenquiry')->load($this->getRequest()->getParam('id'));
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Delete Multiple rows data frome table
     */
    public function massDeleteAction() 
    {
        $productenquiryIds = $this->getRequest()->getParam('productenquiry');
        if (!is_array($productenquiryIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($productenquiryIds as $productenquiryId) {
                    $productenquiry = Mage::getModel('oscpproductenquiry/productenquiry')->load($productenquiryId);
                    $productenquiry->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted', count($productenquiryIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
    

    /**
     * Export grid to CSV format
     */
    public function exportCsvAction() 
    {
        $fileName = 'productenquiry.csv';
        $content = $this->getLayout()->createBlock('oscpproductenquiry/adminhtml_productenquiry_grid')
                ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction() 
    {
        $fileName = 'productenquiry.xml';
        $content = $this->getLayout()->createBlock('oscpproductenquiry/adminhtml_productenquiry_grid')
                ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType = 'application/octet-stream') 
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK', '');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename=' . $fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }

    protected function _initFile($getRootInstead = false) 
    {
        $fileId = (int) $this->getRequest()->getParam('id', false);
        $file = Mage::getModel('oscpproductenquiry/productenquiry');

        if ($fileId) {
            $file->load($fileId);
        }


        Mage::register('file', $file);
        Mage::register('current_file', $file);
        return $file;
    }

    public function gridAction() 
    {
        if (!$category = $this->_initFile(true)) {
            return;
        }
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('oscpproductenquiry/adminhtml_productenquiry_edit_tab_product')->toHtml()
        );
    }
}
