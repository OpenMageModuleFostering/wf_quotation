<?php
 
class Webfrnd_Quotation_Model_Mysql4_Quotation_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('quotation/quotation');
    }
}