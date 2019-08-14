<?php
 
class Webfrnd_Quotation_Block_Adminhtml_Selectproducts extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_selectproducts';
        $this->_blockGroup = 'quotation';
        $this->_headerText = Mage::helper('quotation')->__('Product Manager');
        //$this->_addButtonLabel = Mage::helper('quotation')->__('Create New Quotation');
		
		
		
        parent::__construct();
		$this->_removeButton('add');
    }
}