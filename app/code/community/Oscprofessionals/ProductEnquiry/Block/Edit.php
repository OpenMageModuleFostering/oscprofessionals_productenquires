<?php
/**
 *
 * @category   Oscprofessionals
 * @package    Oscprofessionals_ProductEnquiry
 * @author     Oscprofessionals Team<oscpteam@oscprofessionals.com>
 *
 */
class Oscprofessionals_ProductEnquiry_Block_E extends Mage_Core_Block_Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getEmbriodary()
    {
        if (!$this->hasData('productenquiry')) {
            $this->setData('productenquiry', Mage::registry('productenquiry_data'));
        }

        return $this->getData('productenquiry');
    }
}