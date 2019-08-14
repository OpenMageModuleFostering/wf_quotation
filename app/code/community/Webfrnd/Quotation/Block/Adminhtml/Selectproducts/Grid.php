<?php
 
class Webfrnd_Quotation_Block_Adminhtml_Selectproducts_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('selectproductsGrid');
        // This is the primary key of the database
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
	
	protected function _prepareMassaction()
	{
  		$this->setMassactionIdField('product_ids');
	  	$this->getMassactionBlock()->setFormFieldName('selected_products');  //html name of checkbox
	  	$this->getMassactionBlock()->addItem('product_ids', array(
			'label'=> __('Continue'),
			'url'  => $this->getUrl('*/*/filldetails'),   //an action defined in the controller
			'selected' => 'selected',
			//'confirm' => __('Are you sure?')
	  	));
	
	  return $this;
	}
 
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('catalog/product_collection');
		
		$collection->addStoreFilter()
			->addAttributeToSelect('name')
			->addAttributeToSelect('attribute_set_id')
	        ->addAttributeToSelect('type_id')
	        ->addAttributeToSelect('status')
    	    ->addAttributeToSelect('ref_text');
        $this->setCollection($collection);
        return $this;
    }
 
    protected function _prepareColumns()
    {
		$helper = Mage::helper('quotation');
        $this->addColumn('entity_id', array(
            'header' => $helper->__('Id'),
            'index'  => 'entity_id'
        ));
		
		$this->addColumn('name', array(
            'header' => $helper->__('Name'),
            'index'  => 'name'
        ));
		
		$this->addColumn('type_id', array(
            'header' => $helper->__('Type'),
            'index'  => 'type_id'
        ));
		
		/*
		$this->addColumn('attribute_set_id', array(
            'header' => $helper->__('Attributes'),
            'index'  => 'attribute_set_id'
        ));
		*/
		
		$this->addColumn('sku', array(
            'header' => $helper->__('SKU'),
            'index'  => 'sku'
        ));
 
 
        $this->addColumn('status', array(
 
            'header'    => Mage::helper('quotation')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));
 
        return parent::_prepareColumns();
    }
 
    public function getRowUrl($row)
    {
        //return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
 
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
 
 
}