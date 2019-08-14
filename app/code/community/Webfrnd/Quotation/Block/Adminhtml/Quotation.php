<?php
 
class Webfrnd_Quotation_Block_Adminhtml_Quotation extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_quotation';
        $this->_blockGroup = 'quotation';
        $this->_headerText = Mage::helper('quotation')->__('Quotation Manager');
        //$this->_addButtonLabel = Mage::helper('quotation')->__('Create New Quotation');
		
		$this->_addButton('quotation_selectproducts', array(
        	'label' => $this->__('Create New Quotation'),
        	'onclick' => "setLocation('{$this->getUrl('*/quotation/selectproducts')}')",
    	));
		
        parent::__construct();
		$this->_removeButton('add');
    }
}