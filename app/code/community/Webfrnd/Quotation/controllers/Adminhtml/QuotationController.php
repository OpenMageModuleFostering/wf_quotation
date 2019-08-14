<?php
 
class Webfrnd_Quotation_Adminhtml_QuotationController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('quotation/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }   
   
    public function indexAction() {
        $this->_initAction();       
        $this->_addContent($this->getLayout()->createBlock('quotation/adminhtml_quotation'));
        $this->renderLayout();
    }
	
	
	public function selectproductsAction()
    {
		$this->_title( $this->__('Quotation Product Selection') );
		$this->loadLayout();
		$this->_setActiveMenu('quotation');
		$this->renderLayout();
    }
	
	
	
	public function filldetailsAction()
    {
		session_start();

		$product_ids = $this->getRequest()->getPost('selected_products') ? implode(",",$this->getRequest()->getPost('selected_products')) : Mage::getSingleton('core/session')->getSelectedProductIds();
		
		
		
		if( !$product_ids ) {
			$this->_redirect('adminhtml/quotation/selectproducts');
			return;
		}
		
		Mage::getSingleton('core/session')->setSelectedProductIds($product_ids);
		
		//echo '<pre>';print_r($product_ids);echo '</pre>';
		
		$this->_title( $this->__('New Quotation') );
		$this->loadLayout();
		$this->_setActiveMenu('quotation');
		$this->renderLayout();
		
		
    }
	
	
	
 
    public function editAction()
    {
        $quotationId     = $this->getRequest()->getParam('id');
        $quotationModel  = Mage::getModel('quotation/quotation')->load($quotationId);
 
        if ($quotationModel->getId() || $quotationId == 0) {
 
            Mage::register('quotation_data', $quotationModel);
 
            $this->loadLayout();
            $this->_setActiveMenu('quotation/items');
           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
           
            $this->_addContent($this->getLayout()->createBlock('quotation/adminhtml_quotation_edit'))
                 ->_addLeft($this->getLayout()->createBlock('quotation/adminhtml_quotation_edit_tabs'));
               
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('quotation')->__('Quotation does not exist'));
            $this->_redirect('*/*/');
        }
    }
   
    public function newAction()
    {
        $this->_forward('edit');
    }
	
	
	
	public function reviewAction()
    {
		session_start();

		$product_ids = $this->getRequest()->getPost('selected_products') ? implode(",",$this->getRequest()->getPost('selected_products')) : Mage::getSingleton('core/session')->getSelectedProductIds();
		
		
		
		if( !$product_ids ) {
			$this->_redirect('adminhtml/quotation/selectproducts');
			return;
		}
		
		Mage::getSingleton('core/session')->setSelectedProductIds($product_ids);
		
		//echo '<pre>';print_r($_POST);echo '</pre>';
		
		$this->_title( $this->__('Review Quotation') );
		$this->loadLayout();
		$this->_setActiveMenu('webfrnd/quotation');
		$this->renderLayout();
		
		
    }
	
   
   
    public function saveAction()
    {
		if($this->sendMail()) {
			
			$InsertContent = array();
			$InsertContent['sell_to'] = $this->getRequest()->getPost('sell_to');
			$InsertContent['ship_to'] = $this->getRequest()->getPost('ship_to');
			$InsertContent['quote_date'] = $this->getRequest()->getPost('quote_date');
			$InsertContent['quote_by'] = $this->getRequest()->getPost('quote_by');
			$InsertContent['prod_data'] = $this->getRequest()->getPost('prod');
			
			//print_r($InsertContent);
			
			//echo serialize($InsertContent);
			
				/////Save Data to Database//////
				$quotationModel = Mage::getModel('quotation/quotation');
				
				$admin_user_session = Mage::getSingleton('admin/session');
				$adminuserId = $admin_user_session->getUser()->getUserId();
               
            	$quotationModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle('Quotation To '. $this->getRequest()->getPost('email'))
					->setUserId($adminuserId)
                    ->setContent(serialize($InsertContent))
					->setCreatedTime(date('Y-m-d'))
					->setUpdateTime(date('Y-m-d'))
                    ->setStatus(1)
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Quotation was successfully sent to '. $this->getRequest()->getPost('email')));
                Mage::getSingleton('adminhtml/session')->setQuotationData(false);
				$this->_redirect('/quotation/index');
			
			
		}
		
		
		
		
		
		
		/*
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $quotationModel = Mage::getModel('quotation/quotation');
               
                $quotationModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setContent($postData['content'])
                    ->setStatus($postData['status'])
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setQuotationData(false);
 
                Redirect Method
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setQuotationData($this->getRequest()->getPost());
                Redirect Method Edit
                return;
            }
        }
        Redirect Method
		
		*/
		
		
    }
	
	
	
	public function updateAction()
    {
			
			$InsertContent = array();
			$InsertContent['sell_to'] = $this->getRequest()->getPost('sell_to');
			$InsertContent['ship_to'] = $this->getRequest()->getPost('ship_to');
			$InsertContent['quote_date'] = $this->getRequest()->getPost('quote_date');
			$InsertContent['quote_by'] = $this->getRequest()->getPost('quote_by');
			$InsertContent['prod_data'] = $this->getRequest()->getPost('prod');
			
			
			//echo '<pre>';print_r($InsertContent);echo '</pre>'; return;
			
			//echo serialize($InsertContent);
			
				/////Save Data to Database//////
				
				$quotationModel = Mage::getModel('quotation/quotation');
               
            	$quotationModel->setId($this->getRequest()->getParam('id'))
                    //->setTitle('Quotation To '. $this->getRequest()->getPost('email'))
                    ->setContent(serialize($InsertContent))
					//->setCreatedTime(date('Y-m-d'))
					->setUpdateTime(date('Y-m-d'))
                    //->setStatus(1)
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Quotation was successfully updated '));
                Mage::getSingleton('adminhtml/session')->setQuotationData(false);
				$this->_redirect('/quotation/index');
				
			
			
		
	}
	
	
	
	
	protected function sendMail() {
		
		$logo_path = 'frontend/'.Mage::getStoreConfig('design/package/name').'/'.Mage::getStoreConfig('design/theme/skin'). '/';
		
		$emailTemplate = Mage::getModel('core/email_template')->loadDefault('webfrnd_quotation_email_template');

		//Getting the Store E-Mail Sender Name.
		$senderName = Mage::getStoreConfig('trans_email/ident_general/name');

		//Getting the Store General E-Mail.
		$senderEmail = Mage::getStoreConfig('trans_email/ident_general/email');
		
		$customerEmail = $this->getRequest()->getPost('email');
		
		//$customerName = $this->getRequest()->getPost('name');
		
		
		$prod_data = '';
		foreach($this->getRequest()->getPost('prod') as $thisProd) {
				$prod_data .= '<tr>
					<td class="top" valign="top"><img src="'.$thisProd['thumbnail'].'" /></td>
					<td class="top" valign="top">'.$thisProd['item'].'</td>
					<td class="top" valign="top">'.$thisProd['qty'].'</td>
					<td class="top" valign="top">'.$thisProd['desc'].'</td>
					<td class="top" valign="top">'.$thisProd['price'].'</td>
					<td class="top" valign="top">'.preg_replace("/([^0-9\\.])/i", "", $thisProd['price']) * $thisProd['qty'] .'</td>
				</tr>';
				
			 }
		

		//Variables for Confirmation Mail.
		$emailTemplateVariables = array();
		$emailTemplateVariables['store_info'] = '<strong>'.Mage::getStoreConfig('general/store_information/name').'</strong><br>'.Mage::getStoreConfig('general/store_information/address');
		$emailTemplateVariables['logo_url'] = Mage::getBaseUrl('skin').$logo_path.Mage::getStoreConfig('design/header/logo_src');
		$emailTemplateVariables['sell_to'] = $this->getRequest()->getPost('sell_to');
		$emailTemplateVariables['ship_to'] = $this->getRequest()->getPost('ship_to');
		$emailTemplateVariables['quote_date'] = $this->getRequest()->getPost('quote_date');
		$emailTemplateVariables['quote_by'] = $this->getRequest()->getPost('quote_by');
		$emailTemplateVariables['prod_data'] = $prod_data;
		

		//Appending the Custom Variables to Template.
		$processedTemplate = $emailTemplate->getProcessedTemplate($emailTemplateVariables);
		
		
		$mail = Mage::getModel('core/email')
			 ->setToName($senderName)
			 ->setToEmail($customerEmail)
			 ->setBody($processedTemplate)
			 ->setSubject('Quotation')
			 ->setFromEmail($senderEmail)
			 ->setFromName($senderName)
			 ->setType('html');

		 try{
			 	$mail->send();
				//Mage::getSingleton('core/session')->addSuccess("Quotation is successfully sent to ". $customerEmail);
				//$this->_redirect('/quotation/index');
			 }
			 catch(Exception $error)
			 {
				 Mage::getSingleton('core/session')->addError($error->getMessage());
				 $this->_redirect('/quotation/index');
				 return false;
			 }
		
	}
	
   
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $quotationModel = Mage::getModel('quotation/quotation');
               
                $quotationModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                   
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('quotation/adminhtml_quotation_grid')->toHtml()
        );
    }
}