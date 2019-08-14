<?php

class Webfrnd_Quotation_Block_Adminhtml_Filldetails extends Mage_Adminhtml_Block_Widget_Form_Container
{
	/**
	* Constructor
	*/
	public function __construct()
	{
		parent::__construct();
		$this->_controller = 'adminhtml_filldetails';
        $this->_blockGroup = 'quotation';
		$this->_headerText = Mage::helper('quotation')->__('Fill Details');
		
		 $this->_updateButton('save', 'label', Mage::helper('quotation')->__('Review & Send Quotation'));
		
	}
}