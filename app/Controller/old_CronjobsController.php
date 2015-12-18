<?php
class CronjobsController extends AppController
{
    
    var $name = "Cronjobs";
    
    var $components = array('Session','Upload','Common','Auth');
    
    var $helpers = array('Html','Form','Common','Session');
    
        
      public function getCurrencyrate()
		{
			$this->layout = '';
			$this->autoRender = false;
			$this->loadModel( 'CurrencyExchange' );
  
			$curs=array('GBP','EUR');
			$url='http://www.floatrates.com/daily/eur.xml';
			$xml=file_get_contents($url);
			$obj=json_decode(json_encode(simplexml_load_string($xml)),true);
			$data['rate'] 		= 	$obj['item'][1]['exchangeRate'];
			$data['currency'] 	= 	$obj['item'][1]['targetCurrency'];
		   
			$this->CurrencyExchange->save($data);
		}
		
		public function saveorderdetail()
		{
			
				$this->layout = 'index';
				$this->autoRender = false;
				$this->loadModel('OpenOrder');
				$this->loadModel('AssignService');
				App::import('Vendor', 'linnwork/api/Auth');
				App::import('Vendor', 'linnwork/api/Factory');
				App::import('Vendor', 'linnwork/api/Orders');
			
				$username = Configure::read('linnwork_api_username');
				$password = Configure::read('linnwork_api_password');
				
				$multi = AuthMethods::Multilogin($username, $password);
				
				$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

				$token = $auth->Token;	
				$server = $auth->Server;
			  
			    $openorder	=	OrdersMethods::GetOpenOrders('100','1','','','00000000-0000-0000-0000-000000000000','',$token, $server);

				foreach($openorder->Data as $orderids)
				{
					$orders[]	=	$orderids->OrderId;
				}

				$results	=	OrdersMethods::GetOrders($orders,'00000000-0000-0000-0000-000000000000',true,true,$token, $server);
				
				
				foreach($results as $result)
				{
					
					$data['order_id']		= $result->OrderId;
					$data['num_order_id']	= $result->NumOrderId;
					$data['general_info']	= serialize($result->GeneralInfo);
					$data['shipping_info']	= serialize($result->ShippingInfo);
					$data['customer_info']	= serialize($result->CustomerInfo);
					$data['totals_info']	= serialize($result->TotalsInfo);
					$data['folder_name']	= serialize($result->FolderName);
					$data['items']			= serialize($result->Items);
					
					$this->OpenOrder->create();
					$checkorder 	=	$this->OpenOrder->find('all', array('conditions'=>array('OpenOrder.order_id' => $result->OrderId)));
					if(count($checkorder) > 0)
					{
						
					}
					else
					{
						$this->OpenOrder->save($data);
					}
				}
				/* call the function for assign the postal servises */
				$this->assign_services();
				$this->getBarcode();	
		}
		
		public function ukAmazonFees()
		{
			$this->layout = '';
			$this->autoRender = false;
			$this->loadModel('AmazonFee');
			$this->loadModel('Location');
			App::import('Vendor', 'PHPExcel/IOFactory');
			$objPHPExcel = new PHPExcel();
			$objReader= PHPExcel_IOFactory::createReader('CSV');
			$objReader->setReadDataOnly(true);
			$objPHPExcel=$objReader->load('files/uk_amazon_fees.csv');
			$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);
			$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
			$colString	=	 $highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();
			$colNumber = PHPExcel_Cell::columnIndexFromString($colString);
			
			for($i=2;$i<=$lastRow;$i++) 
			{
				$this->request->data['category']				=	$objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
				$this->request->data['referral_fee']			=	$objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
				$this->request->data['app_min_referral_fee']	=	$objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
				
				$country	=	$this->Location->find('first', array('conditions' => array('Location.county_name' => $objWorksheet->getCellByColumnAndRow(3,$i)->getValue())));
				$this->request->data['country'] 	= 	$country['Location']['id'];
				$this->request->data['platform']	=	$objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
				
				$this->AmazonFee->create();
				$this->AmazonFee->save($this->request->data);
			}
		}
		
		public function assign_services()
		{
			
			$this->layout = '';
			$this->autoRender = false;
			
			$this->loadModel('OpenOrder');
			$this->loadModel('PostalServiceDesc');
			$this->loadModel('Product');
			$this->loadModel('CurrencyExchange');
			$this->loadModel('AssignService');
			
			$allopenorders	=	$this->OpenOrder->find('all', array('conditions' => array('OpenOrder.status' => '0')));
			
			foreach($allopenorders as $allopenorder)
			{
				
				$data['id']				=	 $allopenorder['OpenOrder']['id'];
				$data['order_id']		=	 $allopenorder['OpenOrder']['order_id'];
				$data['num_order_id']	=	 $allopenorder['OpenOrder']['num_order_id'];
				$data['general_info']	=	 unserialize($allopenorder['OpenOrder']['general_info']);
				$data['shipping_info']	=	 unserialize($allopenorder['OpenOrder']['shipping_info']);
				$data['customer_info']	=	 unserialize($allopenorder['OpenOrder']['customer_info']);
				$data['totals_info']	=	 unserialize($allopenorder['OpenOrder']['totals_info']);
				$data['folder_name']	=	 unserialize($allopenorder['OpenOrder']['folder_name']);
				$data['items']			=	 unserialize($allopenorder['OpenOrder']['items']);
				
				
				$weight					=	$data['shipping_info']->TotalWeight;
				$servicelevel			=	$data['shipping_info']->PostalServiceName;
				$source					=	($data['general_info']->Source == 'DIRECT') ? 'Jersey' : $data['general_info']->Source ;
				
				$weight = array();
				$qty = 1;
				
				foreach($data['items'] as $item)
				{
					$qty	=	$item->Quantity;
					$productDetail	=	$this->Product->find('first',array('conditions' => array('Product.product_sku' => $item->SKU)));
					$weight[] = $productDetail['ProductDesc']['weight'] * $qty;
					$dimension		=	 (($productDetail['ProductDesc']['length'] + $productDetail['ProductDesc']['width'] + $productDetail['ProductDesc']['height'] ) * $qty);
				}
				
				$weight	=	array_sum($weight);
						
				$postalservices	=	$this->PostalServiceDesc->find('all', 
				array('conditions' => 
					array(
							'AND' => array('Location.county_name' => $data['customer_info']->Address->Country,'ServiceLevel.service_name' => $servicelevel,'PostalServiceDesc.warehouse' => $source,'PostalServiceDesc.max_weight >=' =>$weight)
						)));
				$serdata['id'] = $allopenorder['OpenOrder']['id'];
				if(count($postalservices) != 0)
				{
					$i = 0;
					foreach($postalservices as $postalservice1)
					{
						$ccyprice[$i]	=	$postalservice1['PostalServiceDesc']['ccy_prices'];
						$perItem[$i]	=	$postalservice1['PostalServiceDesc']['per_item'];
						$perkilo[$i]	=	$postalservice1['PostalServiceDesc']['per_kilo'];
						$postalid[$i]	=	$postalservice1['PostalServiceDesc']['id'];
						$weightKilo[$i]	=	$weight;
						$i++;
					}
					
					$getPerItem_PerKilo	=	$this->getAdditionOfItem_PerKilo( $perItem , $perkilo , $weightKilo, $postalid, $ccyprice );
					$id	=	array_keys($getPerItem_PerKilo, min($getPerItem_PerKilo));
					unset($perItem);
					unset($perkilo);
					unset($weightKilo);
				}
				
				
				
				if(count($postalservices) != 0)
				{
					$postalservicessel	=	$this->PostalServiceDesc->find('all', array('conditions' => array('PostalServiceDesc.id' => $id[0])	));
					foreach($postalservicessel as $postalservice)
					{	
						$matrixdimension 	=	 ($postalservice['PostalServiceDesc']['max_length'] + $postalservice['PostalServiceDesc']['max_width'] + $postalservice['PostalServiceDesc']['max_height']) ."<br>";
						
						if( $dimension < $matrixdimension )
						{
							$serdata['service'] =  $postalservice['PostalServiceDesc']['service_name'];
						}
						else
						{
							$serdata['service']	=	 "Over Dimension";
						}
					}
				}
				else
				{
					$serdata['service'] =  "Over Weight Or Not in Matrices";
				}
				
				$newdata['AssignService']['id'] =	$serdata['id'];
				$newdata['AssignService']['open_order_id'] =	$serdata['id'];
				$newdata['AssignService']['assigned_service'] =	$serdata['service'];
				$this->AssignService->create();
				$this->AssignService->save($newdata);
			}
			
		}
		
		public function getAdditionOfItem_PerKilo( $perItem = null , $perkilo = null , $weightkilo = null ,  $postalid = null, $ccyprice = null )
			{ 
				$this->loadModel('CurrencyExchange');
				$currency	=	$this->CurrencyExchange->find('all', array('order' => 'CurrencyExchange.date DESC'));
				$exchangeRate	=	$currency[0]['CurrencyExchange']['rate'];
				$resultantArrayAfterAddition = array();
				  $e = 0;while( $e <= count($perItem)-1 )
				  {
					  if($ccyprice[$e] == 'GBP')
					  {
						(double)$resultantArrayAfterAddition[$postalid[$e]] = (double)$perItem[$e] + ((double)$perkilo[$e] * $weightkilo[$e]);  
					  }
					  else
					  {
						 (double)$resultantArrayAfterAddition[$postalid[$e]] = $exchangeRate * ((double)$perItem[$e] + ((double)$perkilo[$e] * $weightkilo[$e]));  
					  }
				  $e++; 
				  }
				 return $resultantArrayAfterAddition; 
				 unset($resultantArrayAfterAddition);
			}
			
			public function getBarcode()
				 { 
					 
				  $this->layout = '';
				  $this->autoRender = false;
				  $this->loadModel( 'OpenOrder' );
				  $this->loadModel( 'AssignService' );
				  
				  $uploadUrl = $this->getUrlBase();
				  $imgPath = WWW_ROOT .'img/orders/barcode/';   
				  
				  $allopenorders	=	$this->OpenOrder->find('all', array('conditions' => array('OpenOrder.status' => '0')));
						  foreach( $allopenorders as $allopenorder )
						  {
							  $id 			= 		$allopenorder['OpenOrder']['id'];
							  $openorderid	=	 	$allopenorder['OpenOrder']['num_order_id'];
							  $barcodeimage	=	$openorderid.'.png';
							  
							  $content = file_get_contents($uploadUrl.$openorderid);
							  file_put_contents($imgPath.$barcodeimage, $content);
							  
							  $assingdata['AssignService']['id'] 	=  $id;
							  $assingdata['AssignService']['assign_barcode'] 	=  $barcodeimage;
							  $this->AssignService->save($assingdata);
						  }
				 }
			public function getUrlBase()
				{
					return 'http://www.davidscotttufts.com/code/barcode.php?codetype=Code39&size=40&text=';
				}
				
			public function checkorder()
				{
					$this->layout = '';
					$this->autoRender = false;
					
					$this->loadModel('OpenOrder');
					$this->loadModel('Source');
					$orders = $this->OpenOrder->find('all');
					
					foreach($orders as $allopenorder)
						{
							$data['id']				=	 $allopenorder['OpenOrder']['id'];
							$data['order_id']		=	 $allopenorder['OpenOrder']['order_id'];
							$data['num_order_id']	=	 $allopenorder['OpenOrder']['num_order_id'];
							$data['general_info']	=	 unserialize($allopenorder['OpenOrder']['general_info']);
							$data['shipping_info']	=	 unserialize($allopenorder['OpenOrder']['shipping_info']);
							$data['customer_info']	=	 unserialize($allopenorder['OpenOrder']['customer_info']);
							$data['totals_info']	=	 unserialize($allopenorder['OpenOrder']['totals_info']);
							$data['folder_name']	=	 unserialize($allopenorder['OpenOrder']['folder_name']);
							$data['items']			=	 unserialize($allopenorder['OpenOrder']['items']);
							
							$this->Source->bindModel(array('hasMany' => array('SubSource')));
							$sourceresults 	=	$this->Source->find('all');
							foreach($sourceresults as $sourceresult)
							{
								if($data['general_info']->Source == $sourceresult['Source']['source_name'])
								{
									foreach($sourceresult['SubSource'] as $subsource)
									{
										if($data['general_info']->SubSource == $subsource['sub_source_name'])
										{
											echo $data['id']."<br>";
											echo $subsource['sub_source_name']."<br>";
										}
									}
								}
							}
						}
				 
				}
				public function printpackagingslip()
	{
				$this->layout = '';
				$this->autoRender = false;
				$order	=	$this->getOpenOrderById('100024');
				//pr($order);
				$serviceLevel		=	 	$order['shipping_info']->PostalServiceName;
				$assignedservice	=	 	$order['assigned_service'];
				$courier			=	 	$order['courier'];
				$manifest			=	 	($order['manifest'] == 1) ? '1' : '0';
				$cn22				=	 	($order['cn22'] == 1) ? '1' : '0';
				$barcode			=	 	$order['assign_barcode'];
				
				$subtotal			=		$order['totals_info']->Subtotal;
				$totlacharge		=		$order['totals_info']->TotalCharge;
				$ordernumber		=		$order['num_order_id'];
				$fullname			=		$order['customer_info']->Address->FullName;
				$address1			=		$order['customer_info']->Address->Address1;
				$address2			=		$order['customer_info']->Address->Address2;
				$address3			=		$order['customer_info']->Address->Address3;
				$town				=	 	$order['customer_info']->Address->Town;
				$resion				=	 	$order['customer_info']->Address->Region;
				$postcode			=	 	$order['customer_info']->Address->PostCode;
				$country			=	 	$order['customer_info']->Address->Country;
				$paymentmethod		=	 	$order['totals_info']->PaymentMethod;
				$recivedate			=	 	explode('T', $order['general_info']->ReceivedDate);
				$address			=		$address1.','.$address2.','.$address3;
				
				App::import('Vendor','tcpdf/tcpdf');
			    //$pdf = new tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
				// add a page
				$resolution= array(10, 15);
				$pdf->AddPage('P', $resolution);
			    $date =	date("Y-m-d");
							 
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetHeaderData('', '', 'Service', '');

				$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


					if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
						require_once(dirname(__FILE__).'/lang/eng.php');
						$pdf->setLanguageArray($l);
					}

				$pdf->SetFont('times', '', 8);
				$pdf->AddPage();
				$j=0;
				$imgPath = WWW_ROOT .'css/';
				$imageurl 	=	Router::url('/img/source', true);;
				$html = '<body>
					   <div id="label">
						  <div class="container">
							 <div class="header row">
								<div class="leftside"><img src='.$imageurl.'/vitapure.png></div>
								<div class="rightside ">
								   <div class="barcode center">
									  &nbsp;
									  <div class="right">4584327-0</div>
									  <span class="center">4584327-0</span>
								   </div>
								</div>
							 </div>
							 <div class="cn22 row">
								<div class="leftside address">
								   <h4>Ship From:</h4>
								   <span class="bold">SPC Limited</span><br>
								   Longueville Road<br>
								   St Saviour Jersey JE2 7WF<br>
								   E: sales@vitapure.co.uk<br>
								   T: 0845 800 8888
								</div>
								<div class="rightside address">
								   <h4>Ship To:</h4>
								   <span class="bold">'.$fullname.'</span><br>
								   '.$address1.'<br>
								   '.$address2.', '.$address3.','.$town.', '.$resion.','.$postcode.'<br>
								   '.$country.'<br>
								   T: 07517063902<br>
								</div>
							 </div>
							 <div class="header row">
								<div class="leftside">
								   <div><span class="bold">Order No.:</span>'.$ordernumber.'</div>
								   <div><span class="bold">Order Date:</span>'.$recivedate[0].'</div>
								</div>
								<div class="rightside">
								   <div><span class="bold">Ship Via:</span>'.$courier.'</div>
								   <div><span class="bold">Payment Method:</span>'.$paymentmethod.'</div>
								</div>
							 </div>
							 <div class="tablesection row">
								<table class="" border="1" cellpadding="5px">
								   <tr>
									  <th class="noleftborder" width="15%">Item No.</th>
									  <th valign="top" width="40%">Description of contents</th>
									  <th valign="top" class="center" width="5%">Qty</th>
									  <th valign="top" class="center" width="15%">Price</th>
									  <th valign="top" class="center norightborder" width="15%">Amount</th>
								   </tr>';
								   $i = 1;
								   $subtotal = 0; 
								   foreach($order['items'] as $item)
								   {
								   $html .='<tr>
									  <td valign="top" class="noleftborder">'.$i.'</td>
									  <td valign="top">'.$item->Title.'</td>
									  <td valign="top" class="center">'.$item->Quantity.'</td>
									  <td valign="top" class="right">£'.$item->PricePerUnit.'</td>
									  <td valign="top" class="right norightborder">£'.$item->CostIncTax.'</td>
										</tr>';
										$i++;
										$subtotal = $subtotal + $item->PricePerUnit;
									}
									$j = $i-1;
								$html .='</table>
								<div class="otherinfo">
								   <div><span class="bold">Total Item Count:</span> '.$j.'</div>
								   <div><span class="bold">Payment Reference:</span> 4G073562WB731302E</div>
								</div>
								<div class="totalprice">
								   <div class="leftside right">Sub Total</div>
								   <div class="rightside right">£'.$subtotal.'</div>
								   <div class="leftside right">Shipping</div>
								   <div class="rightside right">£9.25</div>
								   <div class="leftside right">Tax</div>
								   <div class="rightside right">£0.00</div>
								   <div class="leftside right">Discount</div>
								   <div class="rightside right">£0.00</div>
								   <div class="leftside right">Other Charges</div>
								   <div class="rightside right">£0.00</div>
								   <div class="leftside right bold">Order Total</div>
								   <div class="rightside right bold">£166.21</div>
								</div>
							 </div>
							 <div class="footer row">
								Thanks for shopping with us. It was a pleasure to serve you.
								Get special 5% off on next purchase by using promo code: WELCOMEBACK
							 </div>
						  </div>
					   </div>
					</body>';
			$html .= '<style>'.file_get_contents($imgPath.'packing.css').'</style>';
			//echo $html;
				$pdf->writeHTML($html, true, false, true, false, '');
				$js = 'print(true);';
				$pdf->IncludeJS($js);
				$pdf->Output('Service_'.$date.'.pdf', 'D');
	}
	

	public function getOpenOrderById( $numOrderId = null )
	{
		$this->loadModel('OpenOrder');
		$order = $this->OpenOrder->find('first', array('conditions' => array('OpenOrder.num_order_id' => $numOrderId )));
		
		$data['id']					=	 $order['OpenOrder']['id'];
		$data['order_id']			=	 $order['OpenOrder']['order_id'];
		$data['num_order_id']		=	 $order['OpenOrder']['num_order_id'];
		$data['general_info']		=	 unserialize($order['OpenOrder']['general_info']);
		$data['shipping_info']		=	 unserialize($order['OpenOrder']['shipping_info']);
		$data['customer_info']		=	 unserialize($order['OpenOrder']['customer_info']);
		$data['totals_info']		=	 unserialize($order['OpenOrder']['totals_info']);
		$data['folder_name']		=	 unserialize($order['OpenOrder']['folder_name']);
		$data['items']				=	 unserialize($order['OpenOrder']['items']);
		$data['assigned_service']	=	 $order['AssignService']['assigned_service'];
		$data['assign_barcode']		=	 $order['AssignService']['assign_barcode'];
		$data['manifest']			=	 $order['AssignService']['manifest'];
		$data['cn22']				=	 $order['AssignService']['cn22'];
		$data['courier']			=	 $order['AssignService']['courier'];
		
		return $data;
	}
	

}
?>
