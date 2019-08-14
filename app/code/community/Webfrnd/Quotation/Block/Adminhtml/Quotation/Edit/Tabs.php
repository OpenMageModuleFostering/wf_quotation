<?php
 
class Webfrnd_Quotation_Block_Adminhtml_Quotation_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('quotation_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('quotation')->__('Quotation Information'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('view_section', array(
            'label'     => Mage::helper('quotation')->__('Quotation Edit'),
            'title'     => Mage::helper('quotation')->__('Quotation Edit'),
            'content'   => $this->getLayout()->createBlock('quotation/adminhtml_quotation_edit_tab_formview')->toHtml(),
        ));
		/*
		$this->addTab('form_section', array(
            'label'     => Mage::helper('quotation')->__('Quotation Information'),
            'title'     => Mage::helper('quotation')->__('Quotation Information'),
            'content'   => $this->getLayout()->createBlock('quotation/adminhtml_quotation_edit_tab_form')->toHtml(),
        ));
		*/
       
        return parent::_beforeToHtml();
    }
}