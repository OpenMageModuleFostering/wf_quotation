<?php

class Webfrnd_Quotation_Lib_Varien_Data_Form_Element_SelectedProducts extends Varien_Data_Form_Element_Abstract
{
    public function __construct($attributes=array())
    {
        parent::__construct($attributes);
        $this->setType('label');
		if(isset($edit_id)) {
			$this->edit_id = $edit_id;	
		}
    }

    public function getElementHtml()
    {
		
		
		
		
		
		/*
        $html = $this->getBold() ? '<strong>' : '';
        $html.= $this->getEscapedValue();
        $html.= $this->getBold() ? '</strong>' : '';
        $html.= $this->getAfterElementHtml();
		*/
		
		$logo_path = 'frontend/'.Mage::getStoreConfig('design/package/name').'/'.Mage::getStoreConfig('design/theme/skin'). '/';
	
		$html ='<style>
body { margin:0; padding:0;}
table{font-family:Arial, Helvetica, sans-serif; font-size:13px; border:1px solid #000000; width:800px;} 
table .redcolor{color:#ce1111;}
table .colorblack{color:#000000;}
table .border{ border:1px solid #000000;}
table.border tr td, table.border tr th{ border-right:1px solid #000000;  border-bottom:none;  border-bottom:1px solid #000000;}
table.border tr td.top{ border-top:1px solid #000000;}
table.border tr th.right, table.border tr td.right{ border-right:none;}
.form-list td.label {
  width: 0 !important;
  clear:both;
}
</style>';

$review = isset($_POST['action']) ? $_POST['action'] : null ;

//echo $review;


		if($review) {
			
			//$html .= print_r($_POST);
		
			$html .= '<table class="redcolor" align="center" border="0" cellpadding="5" cellspacing="0">
			
			<tbody><tr>
			 <td align="left" valign="top" width="20%">
			<strong>'.Mage::getStoreConfig('general/store_information/name').'</strong><br>'.Mage::getStoreConfig('general/store_information/address').'</td>
			<td align="center" valign="top" width="60%"><img width="200" height="50" src="'.Mage::getBaseUrl('skin').$logo_path.Mage::getStoreConfig('design/header/logo_src').'"></td>
			<td valign="middle" width="20%"><font size="+1"><strong><em>QUOTATION</em></strong></font></td>
			 </tr>
			
			<tr>
			<td colspan="3">&nbsp;</td>
			</tr>
			</tbody></table>';
			
			
			$html .= '<table class="colorblack" align="center" border="0" cellpadding="5" cellspacing="0">
			
			<tbody><tr>
			 <td valign="top" width="35%"><strong>Sell To:</strong><br><input type="hidden" name="sell_to" value="'.nl2br($_POST['sell_to']).'" />'.nl2br($_POST['sell_to']).'</td>
			<td valign="top" width="40%"><strong>Ship To:</strong><br><input type="hidden" name="ship_to" value="'.nl2br($_POST['ship_to']).'" />'.nl2br($_POST['ship_to']).'</td>
			<td valign="top" width="25%"><strong>Date:</strong> <em><input type="hidden" name="quote_date" value="'.$_POST['quote_date'].'" />'.$_POST['quote_date'].'</em><br>
			<strong>Quoted By:</strong> <em><input type="hidden" name="quote_by" value="'.$_POST['quote_by'].'" />'.$_POST['quote_by'].'</em>
			</td>
			 </tr>
			
			<tr>
			<td colspan="3">&nbsp;</td>
			</tr>
			
			 </tbody></table>';
			
			$html .= '<table class="colorblack border" align="center" border="0" cellpadding="5" cellspacing="0">
				<tbody><tr bgcolor="#e1e1e1">
					<th>Photo</th>
					<th>Item</th>
					<th>Qty</th>
					<th>Description</th>
					<th>Unit Price</th>
					<th>Total</th>
				</tr>
				
				
			 ';
			 
			 foreach($_POST['prod'] as $thisProd) {
				$html .= '<tr>
					<input type="hidden" name="prod['.$thisProd['id'].'][id]" value="'.$thisProd['id'].'" />
					<td class="top" valign="top"><input type="hidden" name="prod['.$thisProd['id'].'][thumbnail]" value="'.$thisProd['thumbnail'].'" /><img src="'.$thisProd['thumbnail'].'" /></td>
					<td class="top" valign="top"><input type="hidden" name="prod['.$thisProd['id'].'][item]" value="'.$thisProd['item'].'" />'.$thisProd['item'].'</td>
					<td class="top" valign="top"><input type="hidden" name="prod['.$thisProd['id'].'][qty]" value="'.$thisProd['qty'].'" />'.$thisProd['qty'].'</td>
					<td class="top" valign="top"><input type="hidden" name="prod['.$thisProd['id'].'][desc]" value="'.$thisProd['desc'].'" />'.$thisProd['desc'].'</td>
					<td class="top" valign="top"><input type="hidden" name="prod['.$thisProd['id'].'][price]" value="'.$thisProd['price'].'" />'.$thisProd['price'].'</td>
					<td class="top" valign="top">'.preg_replace("/([^0-9\\.])/i", "", $thisProd['price']) * $thisProd['qty'] .'</td>
				</tr>';
				
			 }
			 
			 $html .= '</tbody></table>';



		}else {
			
			if($this->edit_id) {
				//echo $this->edit_id;	
				$edit_data = Mage::registry('quotation_data');
				$edit_data_content = (unserialize($edit_data->getContent()));
				//print_r($edit_data_content);
				$breaks = array("<br />","<br>","<br/>");
				
				$html .= '<table class="redcolor" align="center" border="0" cellpadding="5" cellspacing="0">
				
				<tbody><tr>
				 <td align="left" valign="top" width="20%">
				<strong>'.Mage::getStoreConfig('general/store_information/name').'</strong><br>'.Mage::getStoreConfig('general/store_information/address').'</td>
				<td align="center" valign="top" width="60%"><img width="200" height="50" src="'.Mage::getBaseUrl('skin').$logo_path.Mage::getStoreConfig('design/header/logo_src').'"></td>
				<td valign="middle" width="20%"><font size="+1"><strong><em>QUOTATION</em></strong></font></td>
				 </tr>
				
				<tr>
				<td colspan="3">&nbsp;</td>
				</tr>
				</tbody></table>';
				
				
				$html .= '<table class="colorblack" align="center" border="0" cellpadding="5" cellspacing="0">
				
				<tbody><tr>
				 <td valign="top" width="35%"><strong>Sell To:</strong><br><textarea name="sell_to" required="required" >'.str_ireplace($breaks, "", $edit_data_content['sell_to']).'</textarea></td>
				<td valign="top" width="40%"><strong>Ship To:</strong><br><textarea name="ship_to" required="required" >'.str_ireplace($breaks, "", $edit_data_content['ship_to']).'</textarea></td>
				<td valign="top" width="25%"><strong>Quote Date:</strong> <em><input type="date" name="quote_date" value="'.date('Y-m-d', strtotime($edit_data_content['quote_date'])).'" required="required" /></em><br/><strong>Quoted By:</strong> <em><input type="text" name="quote_by" value="'.$edit_data_content['quote_by'].'" required="required" /></em>
				</td>
				 </tr>
				
				<tr>
				<td colspan="3">&nbsp;</td>
				</tr>
				
				 </tbody></table>';
				
				$html .= '<table class="colorblack border" align="center" border="0" cellpadding="5" cellspacing="0">
					<tbody><tr bgcolor="#e1e1e1">
						<th>Photo</th>
						<th>Item</th>
						<th>Qty</th>
						<th>Description</th>
						<th>Unit Price</th>
					</tr>
					
					
				 ';
				 
				 foreach($edit_data_content['prod_data'] as $thisProd) {
					$html .= '<tr>
						<input type="hidden" name="prod['.$thisProd['id'].'][id]" value="'.$thisProd['id'].'" />
						<td class="top" valign="top"><input type="hidden" name="prod['.$thisProd['id'].'][thumbnail]" value="'.$thisProd['thumbnail'].'" /><img src="'.$thisProd['thumbnail'].'" /></td>
						<td class="top" valign="top"><strong><input type="hidden" name="prod['.$thisProd['id'].'][item]" value="'.$thisProd['item'].'" />'.$thisProd['item'].'</td>
						<td class="top" valign="top"><input type="text" name="prod['.$thisProd['id'].'][qty]" value="'.$thisProd['qty'].'" required="required"  /></td>
						<td class="top" valign="top"><textarea name="prod['.$thisProd['id'].'][desc]" required="required" >'.$thisProd['desc'].'</textarea></td>
						<td class="top" valign="top"><input type="text" name="prod['.$thisProd['id'].'][price]" value="'.number_format($thisProd['price']).'" required="required"  /></td>
					</tr>';
					
				 }
				 
				 $html .= '</tbody></table>';
				
				
				
				
			}else {
			
			
				$collection = Mage::getResourceModel('catalog/product_collection');
			
				session_start();
		
				$product_ids = Mage::getSingleton('core/session')->getSelectedProductIds();
				
				$product_ids_arr = explode(",", $product_ids);
				
				$collection->addStoreFilter()
					->addAttributeToFilter('entity_id', array('in' => $product_ids_arr))
					->addAttributeToSelect('name')
					->addAttributeToSelect('price')
		
				;
				
		 
				$this->setCollection($collection);
				
				
				
				
				$html .= '<input type="hidden" name="action" value="review" />';
				
				$html .= '<table class="redcolor" align="center" border="0" cellpadding="5" cellspacing="0">
				
				<tbody><tr>
				 <td align="left" valign="top" width="20%">
				<strong>'.Mage::getStoreConfig('general/store_information/name').'</strong><br>'.Mage::getStoreConfig('general/store_information/address').'</td>
				<td align="center" valign="top" width="60%"><img width="200" height="50" src="'.Mage::getBaseUrl('skin').$logo_path.Mage::getStoreConfig('design/header/logo_src').'"></td>
				<td valign="middle" width="20%"><font size="+1"><strong><em>QUOTATION</em></strong></font></td>
				 </tr>
				
				<tr>
				<td colspan="3">&nbsp;</td>
				</tr>
				</tbody></table>';
				
				
				$html .= '<table class="colorblack" align="center" border="0" cellpadding="5" cellspacing="0">
				
				<tbody><tr>
				 <td valign="top" width="35%"><strong>Sell To:</strong><br><textarea name="sell_to" required="required" ></textarea></td>
				<td valign="top" width="40%"><strong>Ship To:</strong><br><textarea name="ship_to" required="required" ></textarea></td>
				<td valign="top" width="25%"><strong>Quoted By:</strong> <em><input type="text" name="quote_by" value="'.Mage::getSingleton('admin/session')->getUser()->getUsername().'" required="required" /></em>
				</td>
				 </tr>
				
				<tr>
				<td colspan="3">&nbsp;</td>
				</tr>
				
				 </tbody></table>';
				
				$html .= '<table class="colorblack border" align="center" border="0" cellpadding="5" cellspacing="0">
					<tbody><tr bgcolor="#e1e1e1">
						<th>Photo</th>
						<th>Item</th>
						<th>Qty</th>
						<th>Description</th>
						<th>Unit Price</th>
					</tr>
					
					
				 ';
				 
				 foreach($collection as $thisProd) {
					 $_product = Mage::getModel('catalog/product')->load($thisProd->getId());
					 
					 $thumbnail = '';
					 try{
					 $thumbnail = (string)Mage::helper('catalog/image')->init($_product, 'thumbnail')->resize(100);
					 }catch(Exception $e) {
						 
					 }
					$html .= '<tr>
						<input type="hidden" name="prod['.$thisProd->getId().'][id]" value="'.$thisProd->getId().'" />
						<td class="top" valign="top"><input type="hidden" name="prod['.$thisProd->getId().'][thumbnail]" value="'.$thumbnail.'" /><img src="'.$thumbnail.'" /></td>
						<td class="top" valign="top"><strong><input type="hidden" name="prod['.$thisProd->getId().'][item]" value="'.$thisProd->getSku().PHP_EOL.'('.$thisProd->getId().')" />'.$thisProd->getSku().'<br />('.$thisProd->getId().')</strong></td>
						<td class="top" valign="top"><input type="text" name="prod['.$thisProd->getId().'][qty]" value="1" required="required"  /></td>
						<td class="top" valign="top"><textarea name="prod['.$thisProd->getId().'][desc]" required="required" >'.$thisProd->getName().PHP_EOL.$thisProd->getShortDescription().'</textarea></td>
						<td class="top" valign="top"><input type="text" name="prod['.$thisProd->getId().'][price]" value="'.number_format($thisProd->getPrice(),2).'" required="required"  /></td>
					</tr>';
					
				 }
				 
				 $html .= '</tbody></table>';
			}
			
		}
		
		
		
		
		
		
        return $html;
    }








    public function getLabelHtml($idSuffix = ''){
        if (!is_null($this->getLabel())) {
            $html = '<label for="'.$this->getHtmlId() . $idSuffix . '" style="'.$this->getLabelStyle().'">'.$this->getLabel()
                . ( $this->getRequired() ? ' <span class="required">*</span>' : '' ).'</label>'."\n";
        }
        else {
            $html = '';
        }
        return $html;
    }
}