<?php
 
class Webfrnd_Quotation_Block_Adminhtml_Quotation_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('quotation_form', array('legend'=>Mage::helper('quotation')->__('Quotation information')));
       
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('quotation')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));
 
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('quotation')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('quotation')->__('Active'),
                ),
 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('quotation')->__('Inactive'),
                ),
            ),
        ));
       
        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('quotation')->__('Content'),
            'title'     => Mage::helper('quotation')->__('Content'),
            'style'     => 'width:98%; height:400px;',
            'wysiwyg'   => false,
            'required'  => true,
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