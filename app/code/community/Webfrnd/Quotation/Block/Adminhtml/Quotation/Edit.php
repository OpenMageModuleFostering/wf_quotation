<?php
 
class Webfrnd_Quotation_Block_Adminhtml_Quotation_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id';
        $this->_blockGroup = 'quotation';
        $this->_controller = 'adminhtml_quotation';
 
        $this->_updateButton('save', 'label', Mage::helper('quotation')->__('Save Quotation'));
        $this->_updateButton('delete', 'label', Mage::helper('quotation')->__('Delete Quotation'));
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('quotation_data') && Mage::registry('quotation_data')->getId() ) {
            return Mage::helper('quotation')->__("Edit Quotation '%s'", $this->htmlEscape(Mage::registry('quotation_data')->getTitle()));
        } else {
            return Mage::helper('quotation')->__('Add Quotation');
        }
    }
}