<?php
 
class Webfrnd_Quotation_Block_Adminhtml_Quotation_Edit_Tab_Formview extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
		$edit_id = $this->getRequest()->getParam('id');
		
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('quotation_form', array('legend'=>Mage::helper('quotation')->__('Quotation View')));
		
		//$edit_data = Mage::getModel('quotation/quotation')->load($edit_id);
		//$edit_data_content = (unserialize($edit_data->getContent()));
		
		
		/*		
		$fieldset->addField('date', 'date', array(
						'name'               => 'quote_date',
						'label'              => Mage::helper('quotation')->__('Quote Date'),
						'after_element_html' => '<small>Date for Quotation Send</small>',
						'tabindex'           => 1,
						'image'              => $this->getSkinUrl('images/grid-cal.gif'),
						'format'             => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT) ,
						//'value'              => date( Mage::app()->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),strtotime('today GMT') )
						//'value'				=> date('Y-m-d')

				));
		*/		
       
        
		$fieldset->addType('selected_products', 'Webfrnd_Quotation_Lib_Varien_Data_Form_Element_SelectedProducts');
			
			
        	$fieldset->addField('mycustom_element', 'selected_products', array(
            	//'label'         => 'Selected Products',
            	'name'          => 'mycustom_element',
            	'required'      => true,
            	'value'     => $this->getLastEventLabel($lastEvent),
            	'bold'      =>  true,
            	'label_style'   =>  'font-weight: bold;color:red;',
				'edit_id'		=> $edit_id
        	));
		
		
		
       
        if ( Mage::getSingleton('adminhtml/session')->getQuotationData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getQuotationData());
            Mage::getSingleton('adminhtml/session')->setQuotationData(null);
        } elseif ( Mage::registry('quotation_data') ) {
            $form->setValues(Mage::registry('quotation_data')->getData());
        }
        return parent::_prepareForm();
    }
}