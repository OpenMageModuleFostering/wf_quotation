<?php

	class Webfrnd_Quotation_Block_Adminhtml_Filldetails_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
	{
		/**
		* Preparing form
		*
		* @return Mage_Adminhtml_Block_Widget_Form
		*/
		protected function _prepareForm()
		{
			
			$review = isset($_POST['action']) ? $_POST['action'] : null ;
			
			
			if(!$review) {
				$form = new Varien_Data_Form(
					array(
						'id' => 'edit_form',
						'action' => $this->getUrl('*/*/review'),
						'method' => 'post',
					)
				);
			
			
			}else {
				$form = new Varien_Data_Form(
					array(
						'id' => 'edit_form',
						'action' => $this->getUrl('*/*/save'),
						'method' => 'post',
					)
				);
			
			
			}
			
			
 
			$form->setUseContainer(true);
			
			//$form->getElement('label')->setRenderer(Mage::app()->getLayout()->createBlock('webfrnd_quotation/adminhtml_form_edit_renderer_label'));
			
			$this->setForm($form);
	 
			$helper = Mage::helper('quotation');
			$fieldset = $form->addFieldset('display', array(
								'legend' => $helper->__('Quotation Details'),
								'class' => 'fieldset-wide'
						));
 
 
 			if(!$review) {
				$fieldset->addField('date', 'date', array(
						'name'               => 'quote_date',
						'label'              => Mage::helper('quotation')->__('Quote Date'),
						'after_element_html' => '<small>Date for Quotation Send</small>',
						'tabindex'           => 1,
						'image'              => $this->getSkinUrl('images/grid-cal.gif'),
						'format'             => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT) ,
						//'value'              => date( Mage::app()->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),strtotime('today GMT') )
						'value'				=> date('Y-m-d')
				));
			
			
			}else {
				$fieldset->addField('email', 'text', array(
						'name'               => 'email',
						'label'              => Mage::helper('quotation')->__('Customer Email'),
						'after_element_html' => '<small>Email on which the quotation will send</small>',
						'tabindex'           => 1,
						'required'			 => true
				));
				
			}
			
			
			$fieldset->addType('selected_products', 'Webfrnd_Quotation_Lib_Varien_Data_Form_Element_SelectedProducts');
			
			
        	$fieldset->addField('mycustom_element', 'selected_products', array(
            	//'label'         => 'Selected Products',
            	'name'          => 'mycustom_element',
            	'required'      => false,
            	'value'     => $this->getLastEventLabel($lastEvent),
            	'bold'      =>  true,
            	'label_style'   =>  'font-weight: bold;color:red;',
        	));
			
			
 
			if (Mage::registry('webfrnd_quotation')) {
				$form->setValues(Mage::registry('webfrnd_quotation')->getData());
			}
			
			
	
	 
			return parent::_prepareForm();
		}
		
		
		
		
	}