<?php
 
class Webfrnd_Quotation_Model_Mysql4_Quotation extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('quotation/quotation', 'quotation_id');
    }
}