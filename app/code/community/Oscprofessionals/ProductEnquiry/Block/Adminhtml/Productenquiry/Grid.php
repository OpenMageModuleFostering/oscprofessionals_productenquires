<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Block_Adminhtml_Productenquiry_Grid extends Mage_Adminhtml_Block_Widget_Grid 
{

    public function __construct() 
    {
        parent::__construct();
        $this->setId('productenquiryGrid');
        $this->setDefaultSort('model_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

     /*
     * Get and set our collection for the grid
     */
    protected function _prepareCollection() 
    {
        $collection = Mage::getModel('oscpproductenquiry/productenquiry')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /*
     *  Add the columns that should appear in the grid
     */
    protected function _prepareColumns() 
    {
        $this->addColumn('model_id', array(
            'header' => Mage::helper('oscpproductenquiry')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'model_id'
        ));

        $this->addColumn('product_id', array(
            'header' => Mage::helper('oscpproductenquiry')->__('Product ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'product_id'
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('oscpproductenquiry')->__('Name'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'name'
        ));

        $this->addColumn('email', array(
            'header' => Mage::helper('oscpproductenquiry')->__('Email Address'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'email'
        ));

        $this->addColumn('question', array(
            'header' => Mage::helper('oscpproductenquiry')->__('Question'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'question'
        ));

         $this->addColumn('comment', array(
             'header' => Mage::helper('oscpproductenquiry')->__('Comment'),
             'align' => 'right',
             'width' => '50px',
             'index' => 'comment'
            ));

        $this->addColumn('product_name', array(
            'header' => Mage::helper('oscpproductenquiry')->__('Product Name'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'product_name'
        ));

        $this->addColumn('is_approved', array(
            'header' => Mage::helper('oscpproductenquiry')->__('Is Approved'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'is_approved',
            'type' => 'options',
            'options' => array(
                0 => Mage::helper('oscpproductenquiry')->__('Pending'),
                1 => Mage::helper('oscpproductenquiry')->__('Approved')
            ),
        ));

        $this->addColumn('created_at', array(
            'header' => Mage::helper('oscpproductenquiry')->__('Created At'),
            'type' => 'datetime',
            'align' => 'center',
            'index' => 'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header' => Mage::helper('oscpproductenquiry')->__('Updated At'),
            'type' => 'datetime',
            'align' => 'center',
            'index' => 'updated_at',
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('oscpproductenquiry')->__('Action'),
            'width' => '100px',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(array(
                    'caption' => Mage::helper('oscpproductenquiry')->__('Edit'),
                    'url' => array(
                        'base' => '*/*/edit'
                    ),
                    'field' => 'id'
                )),
            'filter' => false,
            'sortable' => false,
            'index' => 'productenquiry',
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('oscpproductenquiry')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('oscpproductenquiry')->__('XML'));

        return parent::_prepareColumns();
    }

    /*
     *  Creating Mass Action
     */
    protected function _prepareMassaction() 
    {
        $this->setMassactionIdField('productenquiry_id');
        $this->getMassactionBlock()->setFormFieldName('productenquiry');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('oscpproductenquiry')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('oscpproductenquiry')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('oscpproductenquiry/status')->getOptionArray();

        return $this;
    }

    /*
     *  This is where our row data will get link 
     */
    public function getRowUrl($row) 
    {
        return $this->getUrl('*/*/edit', array(
                    'id' => $row->getId()
        ));
    }

}
