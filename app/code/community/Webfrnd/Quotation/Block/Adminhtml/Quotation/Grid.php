<?php
 
class Webfrnd_Quotation_Block_Adminhtml_Quotation_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('quotationGrid');
        // This is the primary key of the database
        $this->setDefaultSort('quotation_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
		$admin_user_session = Mage::getSingleton('admin/session');
		$adminuserId = $admin_user_session->getUser()->getUserId();
		$role_data = Mage::getModel('admin/user')->load($adminuserId)->getRole()->getData();
		$role_name = $role_data['role_name'];
		
			
        $collection = Mage::getModel('quotation/quotation')->getCollection();
		
		if($role_name != 'Administrators') {
			$collection->addFieldToFilter('user_id',$adminuserId);
		}
		
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('quotation_id', array(
            'header'    => Mage::helper('quotation')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'quotation_id',
        ));
 
        $this->addColumn('title', array(
            'header'    => Mage::helper('quotation')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));
 
        /*
        $this->addColumn('content', array(
            'header'    => Mage::helper('quotation')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));
        */
 
        $this->addColumn('created_time', array(
            'header'    => Mage::helper('quotation')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        ));
 
        $this->addColumn('update_time', array(
            'header'    => Mage::helper('quotation')->__('Update Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'update_time',
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
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
 
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
 
 
}