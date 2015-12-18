<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

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
				$this->loadModel('Customer');
				$this->loadModel('OrderItem');
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
					//Extra information will save my according to manage sorting station section
					$data['destination'] = $result->CustomerInfo->Address->Country;
					$orderitems	=	unserialize($data['items']);
					
					$this->OpenOrder->create();
					$checkorder 	=	$this->OpenOrder->find('all', array('conditions'=>array('OpenOrder.order_id' => $result->OrderId)));
					if(count($checkorder) > 0)
					{
						
					}
					else
					{
						$this->OpenOrder->save($data);
						
						foreach( $orderitems as $orderitem )
							{
								$itemdata['order_id']			=	$result->NumOrderId;
								$itemdata['sku']				=	$orderitem->SKU;
								$itemdata['quantity']			=	$orderitem->Quantity;
								$itemdata['barcode']			=	$orderitem->BarcodeNumber;
								$this->OrderItem->create();
								$this->OrderItem->save( $itemdata );
							}
						
						// code for save customer detail
						$customerInfo['Customer']['email']		=	$result->CustomerInfo->Address->EmailAddress;
						$customerInfo['Customer']['address1']	=	$result->CustomerInfo->Address->Address1;
						$customerInfo['Customer']['address2']	=	$result->CustomerInfo->Address->Address2;
						$customerInfo['Customer']['address3']	=	$result->CustomerInfo->Address->Address3;
						$customerInfo['Customer']['town']		=	$result->CustomerInfo->Address->Town;
						$customerInfo['Customer']['region']		=	$result->CustomerInfo->Address->Region;
						$customerInfo['Customer']['postcode']	=	$result->CustomerInfo->Address->PostCode;
						$customerInfo['Customer']['country']	=	$result->CustomerInfo->Address->Country;
						$customerInfo['Customer']['name']		=	$result->CustomerInfo->Address->FullName;
						$customerInfo['Customer']['company']	=	$result->CustomerInfo->Address->Company;
						$customerInfo['Customer']['phone']		=	$result->CustomerInfo->Address->PhoneNumber;
						$customerInfo['Customer']['source']		=	$result->GeneralInfo->Source;
						$customerInfo['Customer']['subsource']	=	$result->GeneralInfo->SubSource;
					
						$customerdetails	=	$this->Customer->find('first', array('conditions' => array('Customer.email' => $customerInfo['Customer']['email'])));
						
						if( count($customerdetails) > 0 )
						{
							//$customerdetails['Customer']['count'] = $customerdetails['Customer']['count'] + '1';
							$this->Customer->updateAll(array('Customer.order_id' => $result->NumOrderId),
							array('Customer.email' => $customerdetails['Customer']['email']));
						}
						else
						{
							$customerInfo['Customer']['order_id']		=	$result->NumOrderId;
							$this->Customer->create();
							$this->Customer->saveAll( $customerInfo );
						}
					}
				}
				/* call the function for assign the postal servises */
				$this->assign_services();
				$this->getBarcode();	
				$this->setAgainAssignedServiceToAllOrder(); // Euraco Group	
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
			   
			   $allopenorders = $this->OpenOrder->find('all', array('conditions' => array('OpenOrder.status' => '0')));
			   
			   foreach($allopenorders as $allopenorder)
			   {
				
				$data['id']    =  $allopenorder['OpenOrder']['id'];
				$data['order_id']  =  $allopenorder['OpenOrder']['order_id'];
				$data['num_order_id'] =  $allopenorder['OpenOrder']['num_order_id'];
				$data['general_info'] =  unserialize($allopenorder['OpenOrder']['general_info']);
				$data['shipping_info'] =  unserialize($allopenorder['OpenOrder']['shipping_info']);
				$data['customer_info'] =  unserialize($allopenorder['OpenOrder']['customer_info']);
				$data['totals_info'] =  unserialize($allopenorder['OpenOrder']['totals_info']);
				$data['folder_name'] =  unserialize($allopenorder['OpenOrder']['folder_name']);
				$data['items']   =  unserialize($allopenorder['OpenOrder']['items']);
				
				
				$weight     = $data['shipping_info']->TotalWeight;
				$servicelevel   = $data['shipping_info']->PostalServiceName;
				$source     = ($data['general_info']->Source == 'DIRECT') ? 'Jersey' : $data['general_info']->Source ;
				
				$weight = array();
				$qty = 1;
				
				foreach($data['items'] as $item)
				{
				 $qty = $item->Quantity;
				 $productDetail = $this->Product->find('first',array('conditions' => array('Product.product_sku' => $item->SKU)));
					 if(isset($productDetail['ProductDesc']))
					 {
						$weight[] = $productDetail['ProductDesc']['weight'] * $qty;
						$dimension  =  (($productDetail['ProductDesc']['length'] + $productDetail['ProductDesc']['width'] + $productDetail['ProductDesc']['height'] ) * $qty);
					 }
				}
				
				$weight = array_sum($weight);
				  
				$postalservices = $this->PostalServiceDesc->find('all', 
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
				  $ccyprice[$i] = $postalservice1['PostalServiceDesc']['ccy_prices'];
				  $perItem[$i] = $postalservice1['PostalServiceDesc']['per_item'];
				  $perkilo[$i] = $postalservice1['PostalServiceDesc']['per_kilo'];
				  $postalid[$i] = $postalservice1['PostalServiceDesc']['id'];
				  $weightKilo[$i] = $weight;
				  $i++;
				 }
				 
				 $getPerItem_PerKilo = $this->getAdditionOfItem_PerKilo( $perItem , $perkilo , $weightKilo, $postalid, $ccyprice );
				 $id = array_keys($getPerItem_PerKilo, min($getPerItem_PerKilo));
				 unset($perItem);
				 unset($perkilo);
				 unset($weightKilo);
				}
				
				if(count($postalservices) != 0)
				{
				 $postalservicessel = $this->PostalServiceDesc->find('all', array('conditions' => array('PostalServiceDesc.id' => $id[0]) ));
				 foreach($postalservicessel as $postalservice)
				 { 
				  
				  $matrixdimension  =  ($postalservice['PostalServiceDesc']['max_length'] + $postalservice['PostalServiceDesc']['max_width'] + $postalservice['PostalServiceDesc']['max_height']) ."<br>";
				  
				  if( $dimension < $matrixdimension )
				  {
				   $serdata['service'] =  $postalservice['PostalServiceDesc']['service_name'];
				   $serdata['provider_ref_code'] =  $postalservice['PostalServiceDesc']['provider_ref_code'];       
				   $serdata['service_provider'] =  $postalservice['PostalServiceDesc']['courier'];
				   $serdata['manifest'] 	=  $postalservice['PostalServiceDesc']['manifest'];
					$serdata['cn22'] 		=  $postalservice['PostalServiceDesc']['cn_required'];
					$templateID 		=  $postalservice['PostalServiceDesc']['template_id'];            
				   $serdata['error_code'] =  ''; 
				         
				  }
				  else
				  {
				   $serdata['service'] =  "Over Dimension";
				   $serdata['provider_ref_code'] =  '';
				   $serdata['error_code'] =  'error';       
				   $serdata['service_provider'] =  '';
				   $templateID 		=  $postalservice['PostalServiceDesc']['template_id'];      
				  }
				 }
				}
				else
				{
				 $serdata['service'] =  "Over Weight Or Not in Matrices";
				 $serdata['provider_ref_code'] =  '';
				 $serdata['error_code'] =  'error';
				 $serdata['service_provider'] =  '';
				 $templateID 		=  $postalservice['PostalServiceDesc']['template_id'];             
				}
				
				$newdata['AssignService']['id'] = $serdata['id'];
				$newdata['AssignService']['open_order_id'] = $serdata['id'];
				$newdata['AssignService']['assigned_service'] = $serdata['service'];
				$newdata['AssignService']['provider_ref_code'] = $serdata['provider_ref_code'];
				$newdata['AssignService']['service_provider'] = $serdata['service_provider'];
				$newdata['AssignService']['error_code'] = $serdata['error_code'];
				$newdata['AssignService']['manifest'] =	 ($serdata['manifest'] == 'Yes') ? '1' : '0' ;
				$newdata['AssignService']['cn22'] =	($serdata['cn22'] == 'Yes') ? '1' : '0' ;
				$this->AssignService->create();
				$this->AssignService->save($newdata);
				/* Assign the template of open order */
				$this->OpenOrder->updateAll(array('OpenOrder.template_id' => $templateID),
							array('OpenOrder.num_order_id' => $allopenorder['OpenOrder']['num_order_id']));
			   }
			   
			  }
		
		
		/*public function assign_services()
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
			
		}*/
		
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
					return 'http://www.davidscotttufts.com/code/barcode.php?codetype=Code128&size=40&text=';
				}
			
			/*public function getBarcode()
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
				}*/
				
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
				$resolution= array(100, 150);
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

				$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
	
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


					if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
						require_once(dirname(__FILE__).'/lang/eng.php');
						$pdf->setLanguageArray($l);
					}

				$pdf->SetFont('times', '', 8);
				//$pdf->AddPage();
				$j=0;
				$imgPath = WWW_ROOT .'css/';
				$imageurl 	=	Router::url('/img/source', true);
				$html ='<style>
body{margin:0px;}
#label{padding:10px; width:394px; font-size:11px; color:#000000; font-family:"Helvetica Neue",Helvetica,Arial,sans-serif; }
#label .container{width:100%}
 .header,  .cn22,  .tablesection,  .footer{border-bottom:2px solid #000000; clear:both; padding:8px 4px;}
 .footer{line-height:1.2}
 .leftside,  .rightside,  .date,  .sign{ width:50%}
 .jpoststamp{border:1px solid #000000; padding:1px;width:150px; float:right}
 .stampnumber{width: 35%; border:1px solid #000000; padding:4px; background:#000000;  color:#ffffff; text-align:center; font-size:22px; line-height:1.2}
 .jerseyserial{ float: left;    padding: 0 5px;    width: 65%; line-height:1; text-transform:uppercase; font-size:12px;font-weight:bold}
 .vatnumber{ float: left;    padding: 2px 0 0 0; line-height:1.2; font-size:11px;font-weight:bold}
 h1{font-family:"Oswald"; font-size:16px; margin:0px}
 h3{font-size:12px;font-weight:bold; margin:0}
 h4{font-size:14px;font-weight:bold; margin:0 0 5px}
 .rightheading{text-align:center;}
 .fullwidth{clear:both}
 .fullwidth h2{text-align:center; font-size:14px; font-weight:bold; margin:0; padding:5px 0;}
 .fullwidth p{line-height:1.2; margin-top:5px}
 .producttype{margin-bottom:5px;}
 .producttype div{width:25%; display:inline-block;}
 .producttype span{border: 1px solid #000000;
    display: inline-block;
    height: 15px;
    line-height: 1.2;
    margin-right: 5px;
    text-align:center;
    width: 15px;}
	 table{border:none; width:100%}
 th{ font-weight:bold;font-size:12px; }
 th,  td{padding:2px;line-height:1.2;}
 td table td{padding:0px;}
 .norightborder{border-right:0px;}
 .noleftborder{border-left:0px;}
 .rightborder{border-right:1px solid #000000;}
 .leftborder{border-left:1px solid #000000;}
 .topborder{border-top:1px solid #000000;}
 .bottomborder{border-bottom:1px solid #000000;}
 .center{text-align:center}
 .right{text-align:right}
 .bold{font-weight:bold;font-size:12px; }
 .sign{ margin-top: -20px;}
 .barcode{padding:5px 0;}
 .tracking{padding:5px 0;font-size:12px}
 .address{font-size:12px; line-height:1.2}
 .barcode div{font-family:"3 of 9 Barcode"; font-size:30px; margin: -5px 0;}
 .otherinfo{width:60%;  margin-top:5px}
 .totalprice{width:40%;  margin-top:5px}
 .tablesection{padding:0px 0px 8px ; margin-top:-1px}

</style>';
				$html .= '<body>
<div id="label">
<div class="container">
<table class="header row">
<tr>
<td>Logo</td>
<td>
<div class="barcode center">&nbsp;<div class="right">4584327-0</div><span class="center">4584327-0</span></div>
</td>
</tr>
</table>


<table class="cn22 row">
<tr>
<td class="leftside address"><h4>Ship From:</h4>
<span class="bold">SPC Limited</span><br>
Longueville Road<br>
St Saviour Jersey JE2 7WF<br>
E: sales@vitapure.co.uk<br>
T: 0845 800 8888
</td>

<td class="rightside address"><h4>Ship To:</h4>
<span class="bold">Julia Bastek</span><br>
12/13 Duddingston Mills<br>
Edinburgh, Midlothian, EH8 7TU<br>
United Kingdom<br>
T: 07517063902<br>
</td>
</tr>
</table>
<div class="">

</div>
<table class="header row">
<tr>
<td class="leftside"><span class="bold">Order No.:</span> 149680

</td>
<td><span class="bold">Ship Via:</span> Jersey Post</td>
</tr>
<tr>
<td class="rightside">
<span class="bold">Payment Method:</span> Paypal
</td>
<td><span class="bold">Order Date:</span> 23/09/2015</td>
</tr>
</table>

<div class="">
<table class="tablesection row" border="1" cellpadding="5px" cellspacing="0">
<tr>
<th class="" width="15%">Item No.</th>
<th valign="top" width="40%">Description of contents</th>
<th valign="top" class="center" width="15%">Qty</th>
<th valign="top" class="center" width="15%">Price</th>
<th valign="top" class="center " width="15%">Amount</th>
</tr>
<tr>
<td valign="top" class="">0001</td>
<td valign="top">Playtex Drop Ins Pre Sterilized Soft Bottle Liners, 8-10 oz. 100 ea</td>
<td valign="top" class="center">2</td>
<td valign="top" class="right">£75.00</td>
<td valign="top" class="right ">£150.00</td>
</tr>
<tr>
<td valign="top" class="">0002</td>
<td valign="top">Now Foods, Calcium Hydroxyapatite 250mg 120 Capsules</td>
<td valign="top" class="center">1</td>
<td valign="top" class="right">£6.96</td>
<td valign="top" class="right ">£6.96</td>
</tr>

</table>
<table>
<tr>
<td class="otherinfo">
<div><span class="bold">Total Item Count:</span> 3</div>
<div><span class="bold">Payment Reference:</span> 4G073562WB731302E</div></td>
<td class="totalprice">
<table>
<tr>
<td class="leftside right">Sub Total</td>
<td class="rightside right">£156.96</td>
</tr>
<tr>
<td class="leftside right">Shipping</td>
<td class="rightside right">£9.25</td>
</tr>
<tr>
<td class="leftside right">Tax</td>
<td class="rightside right">£0.00</td>
</tr>
<tr>
<td class="leftside right">Discount</td>
<td class="rightside right">£0.00</td>
</tr>
<tr>
<td class="leftside right">Other Charges</td>
<td class="rightside right">£0.00</td>
</tr>
<tr>
<td class="leftside right bold">Order Total</td>
<td class="rightside right bold">£166.21</td>
</tr>
</table>
</td>
</tr>
</table>


</div>
<div class="footer row">
Thanks for shopping with us. It was a pleasure to serve you.
Get special 5% off on next purchase by using promo code: WELCOMEBACK
</div>

</div>
</div>

</body>';

			//$html .= '<style>'.file_get_contents($imgPath.'packing.css').'</style>';
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
	
	/*public function shortingthtml()
	{
		$this->layout = 'index';
		
	}*/
	
	public function domprint()
		{
				$this->layout = '';
				$this->autoRender = false;
			
				//App::import('Vendor','dompdf_config.inc');
				require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 
				
				spl_autoload_register('DOMPDF_autoload'); 
				$dompdf = new DOMPDF();
				
				$this->layout = '';
				//$this->autoRender = false;
				
				$this->loadModel( 'PackagingSlip' );
				$order	=	$this->getOpenOrderById('100001');
				//pr($order);
				//exit;
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
				$phone				=	 	$order['customer_info']->Address->PhoneNumber;
				$paymentmethod		=	 	$order['totals_info']->PaymentMethod;
				$postagecost		=	 	$order['totals_info']->PostageCost;
				$tax				=	 	$order['totals_info']->Tax;
				$items				=	 	$order['items'];
				$address			=		'';
				$address			.=		($address2 != '') ? $address2.'<br>' : '' ; 
				$address			.=		($address3 != '') ? $address3.'<br>' : '' ;
				$address			.=		(isset($town)) ? $town.'<br>' : '';
				$address			.=		(isset($resion)) ? $resion.'<br>' : '';
				$address			.=		(isset($postcode)) ? $postcode.'<br>' : '';
				$address			.=		(isset($country)) ? $country.'<br>' : '';
											
				$recivedate			=	 	explode('T', $order['general_info']->ReceivedDate);
				
				
				$gethtml 	=	$this->PackagingSlip->find('all');
				//pr($gethtml);
				$setRepArray = array();
				$setRepArray[] 					= $address1;
				$setRepArray[] 					= $address2;
				$setRepArray[] 					= $address3;
				$setRepArray[] 					= $town;
				$setRepArray[] 					= $resion;
				$setRepArray[] 					= $postcode;
				$setRepArray[] 					= $country;
				$setRepArray[] 					= $phone;
				$setRepArray[] 					= $ordernumber;
				$setRepArray[] 					= $courier;
				$setRepArray[] 					= $recivedate[0];
				$i = 1;
				$str = '';
				foreach($items as $item)
				{
					$str .= '<tr>
							<td valign="top" class="">'.$i.'</td>
							<td valign="top">'.substr($item->Title, 0, 10 ).'</td>
							<td valign="top" class="center">'.$item->Quantity.'</td>
							<td valign="top" class="right">'.$item->PricePerUnit.'</td>
							<td valign="top" class="right ">'.$item->Quantity * $item->PricePerUnit.'</td>
							</tr>';
					$i++;
				}
				$totalitem = $i - 1;
				$setRepArray[]	=	 $str;
				$setRepArray[]	=	 $totalitem;
				$setRepArray[]	=	 $subtotal;
				$Path 			= 	'/wms/img/client/';
				$img			=	 '<img src='.$Path.'demo.png height="50" width="50">';
				//$img			=	 '<img src='.$Path.'demo.png alt="test alt attribute" width="100" height="100" border="0" />';
				$setRepArray[]	=	 $img;
				$setRepArray[]	=	 $postagecost;
				$setRepArray[]	=	 $tax;
				$totalamount	=	 (float)$subtotal + (float)$postagecost + (float)$tax;
				$setRepArray[]	=	 $totalamount;
				$setRepArray[]	=	 $address;
				
				
				$imgPath = WWW_ROOT .'css/';
				
							$html2 = '<body><div id="label">
							<div class="container">
							<table class="header row" style="margin-top:10px;">
							<tr>
							<td>_IMAGE_</td>
							<td>
							<div class="barcode center">&nbsp;<div class="right">4584327-0</div><span class="center">4584327-0</span></div>
							</td>
							</tr>
							</table>
							<table class="cn22 row">
							<tr>
							<td class="leftside address"><h4 style="font-size:12px; ">Ship From:</h4>
							<span class="bold">SPC Limited</span><br>
							Longueville Road<br>
							St Saviour Jersey JE2 7WF<br>
							E: sales@vitapure.co.uk<br>
							T: 0845 800 8888
							</td>

							<td class="rightside address" ><h4 style="font-size:12px;">Ship To:</h4>
							<span class="bold">_ADDRESS1_</span><br>
							_ADDRESS_
							T: _PHONE_<br>
							</td>
							</tr>
							</table>
							<div class="">

							</div>
							<table class="header row">
							<tr style="margin-top:-10px;">
							<td class="leftside"><span class="bold">Order No.:</span>_ORDERNUMBER_

							</td>
							<td><span class="bold">Ship Via:</span>_COURIER_</td>
							</tr>
							<tr>
							<td class="rightside">
							<span class="bold">Payment Method:</span> Paypal
							</td>
							<td><span class="bold">Order Date:</span>_RECIVEDATE_</td>
							</tr>
							</table>

							<div class="">
							<table class="tablesection row" border="1" cellpadding="5px" cellspacing="0">
							<tr>
							<th class="" width="20%">Item No.</th>
							<th valign="top" width="40%">Description of contents</th>
							<th valign="top" class="center" width="10%">Qty</th>
							<th valign="top" class="center" width="14%">Price</th>
							<th valign="top" class="center " width="16%">Amount</th>
							</tr>
							_ORDERSUMMARY_
							</table>
							<table>
							<tr>
							<td class="otherinfo">
							<div><span class="bold">Total Item Count: </span>_TOTALITEM_</div>
							<div><span class="bold">Payment Reference:</span> 4G073562WB731302E</div></td>
							<td class="totalprice">
							<table>
							<tr>
							<td class="leftside right">Sub Total</td>
							<td class="rightside right">£_SUBTOTAL_</td>
							</tr>
							<tr>
							<td class="leftside right">Shipping</td>
							<td class="rightside right">£_POSTAGECOST_</td>
							</tr>
							<tr>
							<td class="leftside right">Tax</td>
							<td class="rightside right">£_TAX_</td>
							</tr>
							<tr>
							<td class="leftside right bold">Order Total</td>
							<td class="rightside right bold">£_TOTALAMOUNT_</td>
							</tr>
							</table>
							</td>
							</tr>
							</table>


							</div>
							<div class="footer row">
							Thanks for shopping with us. It was a pleasure to serve you.
							Get special 5% off on next purchase by using promo code: WELCOMEBACK
							</div>

							</div>
							</div></body>';
				
				
				//$html2 	=	$gethtml[0]['PackagingSlip']['html'];
				//$html2 .= '<style>'.file_get_contents($imgPath.'packing.css').'</style>';
				$html 	= $this->setReplaceValue( $setRepArray, $html2 );
				
				echo $html;
				//$dompdf->load_html($html);
				//$dompdf->render();
				//$dompdf->stream("hello.pdf");
				
				
		}
		
		
		/*public function setAgainAssignedServiceToAllOrder()
		{
	   
		      
		   $this->loadModel( 'AssignService' );
		   $this->loadModel( 'OpenOrder' );
		   
		   // On Fly unbind Model First
		   $this->AssignService->unbindModel( array( 'belongsTo' => array( 'OpenOrder' ) ) );
		   
		   // Get data from this table and update into open order because for managing Manifesto file
		   $getAssignServiceData = $this->AssignService->find( 'all' );
		  
		   foreach( $getAssignServiceData as $assignIndex => $assignValue )
		   { 
			
			$this->request->data['OpenOrder']['id'] = $assignValue['AssignService']['open_order_id'];
			$this->request->data['OpenOrder']['service_name'] = $assignValue['AssignService']['assigned_service'];    
			$this->request->data['OpenOrder']['service_provider'] = $assignValue['AssignService']['service_provider'];
			$this->request->data['OpenOrder']['service_code'] = $assignValue['AssignService']['provider_ref_code'];    
			$this->OpenOrder->saveAll( $this->request->data['OpenOrder'] );    
			
		   }
					
		   // Update the service records , those will entertain which has service code.
		   $conditions = array(
			'OpenOrder.status' => '1',
			'OpenOrder.service_code !=' => '',
			//'OpenOrder.soreted !=' => 'sorted',
			array(
			 'AND' => array(
			  'OpenOrder.service_name !=' => 'Over Dimension',
			  'OpenOrder.service_name !=' => 'Over Weight Or Not in Matrices'
			 )
			)
		   );
	   
	   $params = array( 
		'conditions' => $conditions,
		'fields' => array( 'count( OpenOrder.service_code ) as ServiceCode_Count' , 'OpenOrder.service_name as ServiceName' , 'OpenOrder.service_provider as ServiceProvider' , 'OpenOrder.service_code as ServiceCode' ),
		'group'  => array( 'OpenOrder.service_code' )
	   );
	   
	   $receivedServiceCount = $this->OpenOrder->find( 'all' , $params );
	   $this->setUpdateServiceCounter( $receivedServiceCount );
   
  }*/
  
		/*
		 * Update 17/11/15 
		 * 
		 * */
	public function setAgainAssignedServiceToAllOrder()
                                {
                                                
                                                $this->layout = '';
												$this->autoRender = false;
                                             
                                                /*
                                                * 
                                                 * Params, Get All assigned services and setup 
                                                 * 
                                                 */                                          
                                                $this->loadModel( 'AssignService' );
                                                $this->loadModel( 'OpenOrder' );
                                                
                                                // On Fly unbind Model First
                                                $this->AssignService->unbindModel( array( 'belongsTo' => array( 'OpenOrder' ) ) );
                                                
                                                // Get data from this table and update into open order because for managing Manifesto file
                                                $getAssignServiceData = $this->AssignService->find( 'all' );
												
                                                foreach( $getAssignServiceData as $assignIndex => $assignValue )
                                                {              
                                                                
                                                                $this->request->data['OpenOrder']['OpenOrder']['id'] = $assignValue['AssignService']['open_order_id'];
                                                                $this->request->data['OpenOrder']['OpenOrder']['service_name'] = $assignValue['AssignService']['assigned_service'];                                                           
                                                                $this->request->data['OpenOrder']['OpenOrder']['service_provider'] = $assignValue['AssignService']['service_provider'];
                                                                $this->request->data['OpenOrder']['OpenOrder']['service_code'] = $assignValue['AssignService']['provider_ref_code'];                                                       
                                                                
                                                                // Update Manifest and cn22
                                                                $this->request->data['OpenOrder']['OpenOrder']['manifest'] = $assignValue['AssignService']['manifest'];                                                            
                                                                $this->request->data['OpenOrder']['OpenOrder']['cn22'] = $assignValue['AssignService']['cn22'];                                                     
                                                                
                                                                $this->OpenOrder->saveAll( $this->request->data['OpenOrder'] );                                                         
                                                                
                                                }
                                                                                                                                                                               
                                                // Update the service records , those will entertain which has service code.
                                                $conditions = array(
                                                                'OpenOrder.status' => '1',
                                                                'OpenOrder.service_code !=' => '',
                                                                //'OpenOrder.soreted !=' => 'sorted',
                                                                array(
                                                                                'AND' => array(
                                                                                                'OpenOrder.service_name !=' => 'Over Dimension',
                                                                                                'OpenOrder.service_name !=' => 'Over Weight Or Not in Matrices'
                                                                                )
                                                                )
                                                );
                                                
                                                $params = array( 
                                                                'conditions' => $conditions,
                                                                'fields'   => array( 'count( OpenOrder.service_code ) as ServiceCode_Count' , 'OpenOrder.service_name as ServiceName' , 'OpenOrder.service_provider as ServiceProvider' , 'OpenOrder.service_code as ServiceCode' , 'OpenOrder.manifest as Manifest' , 'OpenOrder.cn22 as CN22' , 'OpenOrder.destination as Country' ),
                                                                'group'                  => array( 'OpenOrder.service_code' , 'OpenOrder.destination'  )
                                                );
                                                
                                                $receivedServiceCount = $this->OpenOrder->find( 'all' , $params );                                                                                                                                                                                                                                                                                         
                                                $this->setUpdateServiceCounter( $receivedServiceCount );
                                                
                                                
                                }
                                
                                public function setUpdateServiceCounter( $serviceCounter = null )
                                {                                              
                                                
                                                /*
                                                * 
                                                 * Params, Need to input or update accordingly
                                                * 
                                                 */ 
                                                $this->loadModel( 'ServiceCounter' );
                                                
                                                // Truncate the table first
                                                $this->ServiceCounter->query('Truncate service_counters');
                                                
                                                // Update or input the values
                                                foreach( $serviceCounter as $serviceCounterIndex => $serviceCounterValue ): 
                                                                $this->request->data['ServiceCounter']['ServiceCounter']['service_name']                         = $serviceCounterValue['OpenOrder']['ServiceName'];
                                                                $this->request->data['ServiceCounter']['ServiceCounter']['service_code']                           = $serviceCounterValue['OpenOrder']['ServiceCode'];
                                                                $this->request->data['ServiceCounter']['ServiceCounter']['service_provider']    = $serviceCounterValue['OpenOrder']['ServiceProvider'];
                                                                $this->request->data['ServiceCounter']['ServiceCounter']['original_counter']     = $serviceCounterValue[0]['ServiceCode_Count'];
                                                                $this->request->data['ServiceCounter']['ServiceCounter']['manifest']                                    = ( isset($serviceCounterValue['OpenOrder']['Manifest']) && $serviceCounterValue['OpenOrder']['Manifest'] != '') ? '1' : '0';
                                                                $this->request->data['ServiceCounter']['ServiceCounter']['destination']                               = ( isset( $serviceCounterValue['OpenOrder']['Country'] ) && $serviceCounterValue['OpenOrder']['Country'] != '' ) ? $serviceCounterValue['OpenOrder']['Country'] : '';
                                                                $this->request->data['ServiceCounter']['ServiceCounter']['bags']                                                             = 1;
                                                                //$this->request->data['ServiceCounter']['ServiceCounter']['counter']                                  = 0;                
                                                                
                                                                // Create Temp row pointer
                                                                $this->ServiceCounter->create();
                                                                $this->ServiceCounter->saveAll( $this->request->data['ServiceCounter'] );
                                                endforeach;                                                                                       
                                }
                                
                                public function shortingthtml()
                                {
                                                $this->layout = 'index';
                                                /*
                                                * 
                                                 * Params to set the data over view of sorting station
                                                *
                                                */  
                                                
                                                // Load ServiceCounter
                                                $this->loadModel( 'ServiceCounter' );
                                                
                                                
                                                // Get Data
                                                $serviceCounterData = $this->ServiceCounter->find( 'all' , array( 'order' => 'ServiceCounter.original_counter DESC' ) );
                                                
                                                $leftService = array();
                                                $rightService = array();
                                                
                                                // Set left and right corner data for sorting station operator
                                                $iGetter = 1;$icount = 0;while( $icount <= count( $serviceCounterData )-1 ):
                                                                if( ceil(count( $serviceCounterData ) / 2) >= $iGetter ):
                                                                                $leftService[] = $serviceCounterData[$icount];
                                                                else:
                                                                                $rightService[] = $serviceCounterData[$icount];
                                                                endif;
                                                $icount++;
                                                $iGetter++;
                                                endwhile;
                                                
                                                // Get Service counter details which we have atleast 1 manifest then will active the button
                                                $getActivationForCutOffList = count( $this->ServiceCounter->find( 'all', array( 'conditions' => array( 'ServiceCounter.manifest' => 1 , 'ServiceCounter.order_ids !=' => '' ) ) ) );
                                                
                                                // Input and check operator data inTime, If already exists accordign today that will not input again but not today is ther that will input it.
                                                $this->loadModel( 'SortingoperatortimeCalculation' );
                                                $user_id = $this->Session->read('Auth.User.id');
                                                $paramOperator = array(
                                                                'conditions' => array(
                                                                                'SortingoperatortimeCalculation.user_id' => $user_id
                                                                )
                                                );
                                                
                                                if( count( $this->SortingoperatortimeCalculation->find( 'first', $paramOperator ) ) == 0 ):                                              
                                                                $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['user_id'] = $user_id;
                                                                $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['in_time'] = date('Y-m-d G:i:s');
                                                                $this->SortingoperatortimeCalculation->saveAll( $this->request->data['SortingoperatortimeCalculation'] );
                                                endif;    
                                                
                                                // Set data for view                                                                         
                                                $this->set( compact( 'leftService' , 'rightService' , 'getActivationForCutOffList' ) );                              
                                }
                
                                /*
                                * 
                                 * Params, CutOff creation for specific services which have own manifest value(1)
                                * 
                                 */ 
                               public function createCutOffList()
                                {                              
                                                $this->layout = '';
                                                $this->autoRender = false;          
                                                
                                                // Get All manifest related services
                                                $this->loadModel( 'ServiceCounter' );
                                                
                                                //Global Variable
                                                $glbalSortingCounter = 0;
                                                
                                                // Get Data
                                                $relatedManifestData = json_decode(json_encode($this->ServiceCounter->find( 'all' , 
                                                                array( 
                                                                                'conditions' => array( 
                                                                                                                'ServiceCounter.manifest' => 1 , 
                                                                                                                'ServiceCounter.order_ids !=' => '' , 
                                                                                                                'ServiceCounter.counter >' => 0 , 
                                                                                                                'ServiceCounter.original_counter >' => 0, 
                                                                                                                'ServiceCounter.locking_stage' => 0 
                                                                                                ),
                                                                                'fields' => array(
                                                                                                                'count(ServiceCounter.service_code) as ProviderCode',
                                                                                                                'ServiceCounter.service_code',
                                                                                                                'ServiceCounter.destination',
                                                                                                                'ServiceCounter.service_name',
                                                                                                                'ServiceCounter.service_provider'                                                                                                                                                           
                                                                                                ),
                                                                                'group'                  => array(
                                                                                                                'ServiceCounter.service_code' 
                                                                                                )                                                                                                              
                                                                                )                                                                              
                                                                )),0);                                      
                                                /*
                                                * 
                                                 * Params, Get manifest rows from service
                                                * Params, Get related rows of order Id's
                                                * Params, To call Controller and Helper to managed into component related sheets
                                                * 
                                                 */
                                                $st = 0;foreach( $relatedManifestData as $sheetIndex => $sheetIndexArray ): 
                                                                
                                                                                                                                
                                                                                // Get Data
                                                                                $relatedManifestData = json_decode(json_encode($this->ServiceCounter->find( 'all' , 
                                                                                                array( 
                                                                                                                'conditions' => array( 
                                                                                                                                                'ServiceCounter.manifest' => 1 , 
                                                                                                                                                'ServiceCounter.order_ids !=' => '' , 
                                                                                                                                                'ServiceCounter.counter >' => 0 , 
                                                                                                                                                'ServiceCounter.original_counter >' => 0, 
                                                                                                                                                'ServiceCounter.locking_stage' => 0,
                                                                                                                                                'ServiceCounter.service_code' => $sheetIndexArray->ServiceCounter->service_code 
                                                                                                                                )                                                                                              
                                                                                                                )                                                                              
                                                                                                )),0);
                                                                
                                                                                //pr($relatedManifestData); exit;
                                                                                $innerLoop = 0;foreach( $relatedManifestData as $relatedManifestDataIndex => $relatedManifestDataValue ):
                                                                                                
                                                                                                // Get and prepare data for extracting from DB
                                                                                                $serilizedData = $this->getOrderProductsById( $relatedManifestDataValue->ServiceCounter->order_ids );
                                                                                                
                                                                                                // Clean Stream (Input)
                                                                                                ob_clean();                                                         
                                                                                                App::import('Vendor', 'PHPExcel/IOFactory');
                                                                                                App::import('Vendor', 'PHPExcel');                          
                                                                                                
                                                                                                //Set and create Active Sheet for single workbook with singlle sheet
                                                                                                $objPHPExcel = new PHPExcel();       
                                                                                                $objPHPExcel->createSheet();
                                                                                                
                                                                                                //Column Create                              
                                                                                                $objPHPExcel->setActiveSheetIndex(0);
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'OrderItemNumber');                                                                  
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Name');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Address');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Postcode');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Country');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Item Count');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Contents');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Total Packet Value');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Weight');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('J1', 'HS');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Deposit');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Invoice Number');
                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Bag barcode');
                                                                                                                                                                                                
                                                                                                //Dynamic Service Name with country
                                                                                                //$serviceFileName = $sheetIndexArray->ServiceCounter->service_name. ' ' . $sheetIndexArray->ServiceCounter->service_code .'-('. $sheetIndexArray->ServiceCounter->destination .')-'.$sheetIndexArray->ServiceCounter->service_provider;
                                                                                                
                                                                                                $serviceFileName = $sheetIndexArray->ServiceCounter->service_name. ' ' .$sheetIndexArray->ServiceCounter->service_provider;
                                                                                                $serviceFileName = strtolower(str_replace(')','-',str_replace('(','-',str_replace('<','-',str_replace(' ','-',$serviceFileName)))));
                                                                                                
                                                                                                // Manage data accordign to Id's, which receive from DB
                                                                                                // Manage Inner Sheets and columns ( Means, Every row could be multiple id's)                                                                                        
                                                                                                $cnt = 2;foreach( $serilizedData as $serilizedDataIndex => $serilizedDataIndexValue ):
                                                                                                                
                                                                                                                //Set Counter
                                                                                                                $glbalSortingCounter++;                                               
                                                                                                                
                                                                                                                //Exctract all information (Unserialized)
                                                                                                                $general_info    = json_decode(json_encode(unserialize($serilizedDataIndexValue->OpenOrder->general_info)),0);                        
                                                                                                                $shipping_info = json_decode(json_encode(unserialize($serilizedDataIndexValue->OpenOrder->shipping_info)),0);                       
                                                                                                                $customer_info                = json_decode(json_encode(unserialize($serilizedDataIndexValue->OpenOrder->customer_info)),0);                    
                                                                                                                $totals_info        = json_decode(json_encode(unserialize($serilizedDataIndexValue->OpenOrder->totals_info)),0);                            
                                                                                                                $items                                  = json_decode(json_encode(unserialize($serilizedDataIndexValue->OpenOrder->items)),0);                       
                                                                                                                
                                                                                                                /*pr($general_info);
                                                                                                                pr($shipping_info);
                                                                                                                pr($customer_info);
                                                                                                                pr($totals_info);
                                                                                                                pr($items);
                                                                                                                exit;*/
                                                                                                                
                                                                                                                // Data Input into sheets
                                                                                                                
                                                                                                                //Order No.
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('A'.$cnt,$serilizedDataIndexValue->OpenOrder->num_order_id);
                                                                                                                
                                                                                                                //Name
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('B'.$cnt,$customer_info->Address->FullName);
                                                                                                                
                                                                                                                //Address
                                                                                                                $address = $customer_info->Address->Address1.' '.$customer_info->Address->Address2.' '.$customer_info->Address->Address3;
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('C'.$cnt,$address);
                                                                                                                
                                                                                                                //Postcode
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('D'.$cnt,$customer_info->Address->PostCode);
                                                                                                                
                                                                                                                //Country
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('E'.$cnt,$customer_info->Address->Country);
                                                                                                                
                                                                                                                //Item Count
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('F'.$cnt,count($items));
                                                                                                                
                                                                                                                //Contents with each item of order
                                                                                                                $productStr = '';
                                                                                                                $itemLoop = 0;foreach( $items as $itemsIndex => $itemsValue ):
                                                                                                                                //Set Up quantity levels with each product
                                                                                                                                if( $itemLoop == 0 ):
                                                                                                                                                $productStr = $itemsValue->Quantity .'x'. $itemsValue->Title;
                                                                                                                                else:
                                                                                                                                                $productStr .= ' , '.$itemsValue->Quantity .'x'. $itemsValue->Title;
                                                                                                                                endif;
                                                                                                                $itemLoop++;
                                                                                                                endforeach;
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('G'.$cnt,$productStr); // Exception case
                                                                                                                
                                                                                                                //Total Packet Value
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('H'.$cnt,$totals_info->TotalCharge);
                                                                                                                
                                                                                                                //Total Order Weight
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('I'.$cnt,$shipping_info->TotalWeight);
                                                                                                                                                                                                
                                                                                                                //HS
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('J'.$cnt,'N/A');
                                                                                                                
                                                                                                                //Deposit
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('K'.$cnt,'N/A');
                                                                                                                
                                                                                                                //Invoice Number
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('L'.$cnt,$serilizedDataIndexValue->OpenOrder->num_order_id);
                                                                                                                
                                                                                                                //Bag Barcode
                                                                                                                $objPHPExcel->getActiveSheet()->setCellValue('M'.$cnt,'N/A');
                                                                                                                
                                                                                                                $serviceData = json_decode(json_encode($this->ServiceCounter->find( 'first', array( 'conditions' => array( 'ServiceCounter.id' => $relatedManifestDataValue->ServiceCounter->id ) ) )),0);
                                                                                                                $originalCounter = $serviceData->ServiceCounter->original_counter - $serviceData->ServiceCounter->counter;
                                                                                                                
                                                                                                                //Update Now at specific id
                                                                                                                $this->request->data['ServiceCounter']['ServiceCounter']['id'] = $relatedManifestDataValue->ServiceCounter->id;
                                                                                                                $this->request->data['ServiceCounter']['ServiceCounter']['original_counter'] = $originalCounter;
                                                                                                                $this->request->data['ServiceCounter']['ServiceCounter']['counter'] = 0;
                                                                                                                $this->request->data['ServiceCounter']['ServiceCounter']['order_ids'] = '';
                                                                                                                $this->request->data['ServiceCounter']['ServiceCounter']['locking_stage'] = 1;
                                                                                                                $this->ServiceCounter->saveAll( $this->request->data['ServiceCounter'] );
                                                                                                                
                                                                                                $cnt++;
                                                                                                endforeach;
                                                                                                
                                                                                $innerLoop++;
                                                                                endforeach;
                                                                                
                                                                                //Set First Row  for Amazon FBa Sheet
                                                                                $objPHPExcel->setActiveSheetIndex(0);                                                                              
                                                                                $objPHPExcel->getActiveSheet(0)->getStyle('A1:M1')->getAlignment()->applyFromArray(
                                                                                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                                                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,));                   
                                                                                $objPHPExcel->getActiveSheet(0)->getStyle('A1:M1')->getAlignment()->setWrapText(true);
                                                                                $objPHPExcel->getActiveSheet(0)->getStyle("A1:M1")->getFont()->setBold(true);
                                                                                $objPHPExcel->getActiveSheet(0)
                                                                                                                                ->getStyle('A1:M1')
                                                                                                                                ->applyFromArray(
                                                                                                                                                array(
                                                                                                                                                                'fill' => array(
                                                                                                                                                                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                                                                                                                                                                'color' => array('rgb' => 'EBE5DB')
                                                                                                                                                                )
                                                                                                                                                )
                                                                                                                                );
                                                                                                  
                                                                                // create new folder with date if exists will remain same or else create new one                                                                                                                                                                                                
                                                                                $dir = new Folder(WWW_ROOT .'img/cut_off/Service-Manifest-'.date("m.d.y"), true, 0755);
                                                                                
                                                                                $uploadUrl          =             WWW_ROOT .'img/cut_off/Service-Manifest-'.date("m.d.y").'/'.$serviceFileName.'.csv';                                          
                                                                                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
                                                                                $objWriter->save($uploadUrl);
                                                                                
                                                endforeach;       
                                                
                                                // Get Session User
                                   $user_id = $this->Session->read('Auth.User.id');
                                   
                                   // Call Query
                                   $paramOperator = array(
                                                                'conditions' => array(
                                                                                'SortingoperatortimeCalculation.user_id' => $user_id
                                                                )
                                                );
                                   
                                   // Query Here
                                   $this->loadModel('SortingoperatortimeCalculation');
                                   $getOperator = $this->SortingoperatortimeCalculation->find( 'first', $paramOperator );
                                    
                                   //Update first out time
                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['id'] = $getOperator['SortingoperatortimeCalculation']['id'];
                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['user_id'] = $user_id;
                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['out_time'] = date('Y-m-d G:i:s');
                                   $this->SortingoperatortimeCalculation->saveAll( $this->request->data['SortingoperatortimeCalculation'] ); 
                                   
                                   // Query Here
                                   $getOperator = $this->SortingoperatortimeCalculation->find( 'first', $paramOperator ); 
                                   
                                   // Calculation
                                   $logout = strtotime($getOperator['SortingoperatortimeCalculation']['out_time']);
                                   $login  = strtotime($getOperator['SortingoperatortimeCalculation']['in_time']);
                                   $diff   = $logout - $login;                                
                                   $timeCalculate = round( $diff / 3600 ) ." hour ". round($diff/60)." minutes ".($diff%60)." seconds";
                                   
                                   // Yes, calculate the time but we need to check one more time is that today or not
                                   $dayString = "2015-11-16 05:33:49";
                                  $dayStringSub = substr($dayString, 0, 10);

                                   $isToday = ( strtotime('now') >= strtotime($dayStringSub . " 00:00") 
                                                                                  && strtotime('now') <  strtotime($dayStringSub . " 23:59") );
                                   
                                    // Today
                                   if( $isToday == 1 ):
                                                                
                                                                // Update a row again and again
                                                                //Update calculate time
                                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['id'] = $getOperator['SortingoperatortimeCalculation']['id'];
                                                  $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['user_id'] = $user_id;
                                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['total_time'] = $timeCalculate;
                                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['no_of_orders_sorted'] = $glbalSortingCounter;
                                                   $this->SortingoperatortimeCalculation->saveAll( $this->request->data['SortingoperatortimeCalculation'] ); 
                                   else:
                                                
                                                                // Insert new row, If today is not
                                                                //Insert calculate time                                      
                                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['user_id'] = $user_id;
                                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['total_time'] = $timeCalculate;
                                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['no_of_orders_sorted'] = $glbalSortingCounter;
                                                   $this->SortingoperatortimeCalculation->saveAll( $this->request->data['SortingoperatortimeCalculation'] ); 
                                                                
                                   endif;
                                   
                                                // Get Data
                                                $serviceCounterData = $this->ServiceCounter->find( 'all' , array( 'order' => 'ServiceCounter.original_counter DESC' ) );
                                                
                                                $leftService = array();
                                                $rightService = array();
                                                
                                                // Set left and right corner data for sorting station operator
                                                $iGetter = 1;$icount = 0;while( $icount <= count( $serviceCounterData )-1 ):
                                                                if( ceil(count( $serviceCounterData ) / 2) >= $iGetter ):
                                                                                $leftService[] = $serviceCounterData[$icount];
                                                                else:
                                                                                $rightService[] = $serviceCounterData[$icount];
                                                                endif;
                                                $icount++;
                                                $iGetter++;
                                                endwhile;
                                                
                                                // Get Service counter details which we have atleast 1 manifest then will active the button
                                                $getActivationForCutOffList = count( $this->ServiceCounter->find( 'all', array( 'conditions' => array( 'ServiceCounter.manifest' => 1 , 'ServiceCounter.order_ids !=' => '' ) ) ) );
                                                
                                                // Set data for view                                                                         
                                                $this->set( compact( 'leftService' , 'rightService' , 'getActivationForCutOffList' , 'getOperator' ) );                                
                                                $this->render( 'shortingthtml' );
                                    $this->redirect( array( 'controller' => 'cronjobs' , 'action' => 'shortingthtml' ) );
                                                                                
                                }
                                
                                /*
                                * 
                                 * Params, Here will set a demo to forcing the open popup
                                * 
                                 */ 
                                public function callManifest_Popup()
                                {
                                                $this->layout = '';
                                                $this->autoRender = false;          
                                                
                                                $uploadUrl          =             WWW_ROOT .'img/cut_off/service.csv';
                                                
                                                header('Content-Encoding: UTF-8');
                                    header('Content-type: text/csv; charset=UTF-8');
                                    header('Content-Disposition: attachment;filename="'.$uploadUrl.'"');
                                    header("Content-Type: application/octet-stream;");
                                    header('Cache-Control: max-age=0');
                                                readfile($uploadUrl); 
                                                exit;
                                }
                                
                   // Open popup for bags addition
                   public function addBag()
                   {
                                   
                                   $this->layout = "";
                                   $this->autoRander = false;
                                   
                                   //Get Data
                                   $exactLocation = $this->data['exactLocationClick'];
                                   
                                   //Load Model
                                   $this->loadModel( 'ServiceCounter' );
                                   $params = array(
                                                                'conditions' => array(
                                                                                'ServiceCounter.id' => $exactLocation 
                                                                ),
                                                                'fields' => array(
                                                                                'ServiceCounter.id',
                                                                                'ServiceCounter.bags'
                                                                )
                                   );                             
                                   $getParamsData = $this->ServiceCounter->find( 'all' , $params );                               
                                   $this->set( compact( 'getParamsData' ) );
                                   $this->render('bags');
                   }
                   
                   // Updation in service accordign to operator for bags
                   public function addBagByOperator()
                   {                              
                                   $this->layout = "";
                                   $this->autoRander = false;
                                   
                                   //Get Data
                                   $exactLocation = $this->data['exactLocationClick'] + 1; // Value
                                   $exactLocationId = $this->data['exactLocationId']; // Location
                                   
                                   //load model
                                   $this->loadModel( 'ServiceCounter' );
                                   $this->request->data['ServiceCounter']['ServiceCounter']['id'] = $exactLocationId;
                                   $this->request->data['ServiceCounter']['ServiceCounter']['bags'] = $exactLocation;
                                   $this->ServiceCounter->saveAll( $this->request->data['ServiceCounter'] );
                                   echo $exactLocation .'=='. $exactLocationId; exit;                             
                   }
                   
                   //Calculate the hours accordign operator login and logout time at sorting station
                   public function getCalculateTimeOfOperatorById()
                   {
                                   
                                   $this->layout = "index";
                                                                   
                                   //Load Model
                                   $this->loadModel( 'SortingoperatortimeCalculation' );
                                   
                                   // Get Session User
                                   $user_id = $this->Session->read('Auth.User.id');
                                   
                                   // Call Query
                                   $paramOperator = array(
                                                                'conditions' => array(
                                                                                'SortingoperatortimeCalculation.user_id' => $user_id
                                                                )
                                                );
                                   
                                   // Query Here
                                   $getOperator = $this->SortingoperatortimeCalculation->find( 'first', $paramOperator );
                                    
                                   //Update first out time
                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['id'] = $getOperator['SortingoperatortimeCalculation']['id'];
                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['user_id'] = $user_id;
                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['out_time'] = date('Y-m-d G:i:s');
                                   $this->SortingoperatortimeCalculation->saveAll( $this->request->data['SortingoperatortimeCalculation'] ); 
                                   
                                   // Query Here
                                   $getOperator = $this->SortingoperatortimeCalculation->find( 'first', $paramOperator ); 
                                   
                                   $logout = strtotime($getOperator['SortingoperatortimeCalculation']['out_time']);
                                   $login  = strtotime($getOperator['SortingoperatortimeCalculation']['in_time']);
                                   $diff   = $logout - $login;                                
                                   $timeCalculate = round( $diff / 3600 ) ." hour ". round($diff/60)." minutes ".($diff%60)." seconds";
                                   
                                   //Update calculate time
                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['id'] = $getOperator['SortingoperatortimeCalculation']['id'];
                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['user_id'] = $user_id;
                                   $this->request->data['SortingoperatortimeCalculation']['SortingoperatortimeCalculation']['total_time'] = $timeCalculate;
                                   $this->SortingoperatortimeCalculation->saveAll( $this->request->data['SortingoperatortimeCalculation'] ); 
                                   
                                   // Query Here
                                   $getOperator = $this->SortingoperatortimeCalculation->find( 'first', $paramOperator );
                                   
                                   //Data Send of Left and right panel also
                                   // Load ServiceCounter
                                                $this->loadModel( 'ServiceCounter' );
                                                
                                                // Get Data
                                                $serviceCounterData = $this->ServiceCounter->find( 'all' , array( 'order' => 'ServiceCounter.original_counter DESC' ) );
                                                
                                                $leftService = array();
                                                $rightService = array();
                                                
                                                // Set left and right corner data for sorting station operator
                                                $iGetter = 1;$icount = 0;while( $icount <= count( $serviceCounterData )-1 ):
                                                                if( ceil(count( $serviceCounterData ) / 2) >= $iGetter ):
                                                                                $leftService[] = $serviceCounterData[$icount];
                                                                else:
                                                                                $rightService[] = $serviceCounterData[$icount];
                                                                endif;
                                                $icount++;
                                                $iGetter++;
                                                endwhile;
                                                
                                                // Get Service counter details which we have atleast 1 manifest then will active the button
                                                $getActivationForCutOffList = count( $this->ServiceCounter->find( 'all', array( 'conditions' => array( 'ServiceCounter.manifest' => 1 , 'ServiceCounter.order_ids !=' => '' ) ) ) );
                                                
                                                // Set data for view                                                                         
                                                $this->set( compact( 'leftService' , 'rightService' , 'getActivationForCutOffList' , 'getOperator' ) );                                
                                                $this->render( 'shortingthtml' );
                                    $this->redirect( array( 'controller' => 'cronjobs' , 'action' => 'shortingthtml' ) );
                   }
                   
                   // Product information by  id
                   public function getOrderProductsById( $orderIds = null )
                  {
                                   /*
                                    * 
                                    * Params, Get all information through order Id and get information Id's
                                    * 
                                    */                          
                                   $this->loadModel( 'OpenOrder' );                                                            
                                   $OpenOrder   =             json_decode(json_encode($this->OpenOrder->find('all', 
                                                                                                                                array('conditions' => 
                                                                                                                                                array(
                                                                                                                                                                                'OpenOrder.id' => explode(',',$orderIds),
                                                                                                                                                                                'OpenOrder.sorted_scanned' => 1,
                                                                                                                                                                                'OpenOrder.status' => 1
                                                                                                                                                                ),
                                                                                                                                                'fields' => array(
                                                                                                                                                                                'OpenOrder.general_info',
                                                                                                                                                                                'OpenOrder.shipping_info',
                                                                                                                                                                                'OpenOrder.customer_info',
                                                                                                                                                                                'OpenOrder.totals_info',
                                                                                                                                                                                'OpenOrder.items',
                                                                                                                                                                                'OpenOrder.num_order_id'
                                                                                                                                                                )              
                                                                                                                                                )
                                                                                                                                )),0);                                                                                                                                      
                   return $OpenOrder;
                   }  
                   
                   public function checkBarcodeForSortingOperator()
     {
      $this->autoRender = false;
      $this->layout = '';
     
      $this->loadModel('OpenOrder');
     
      $express1 = array();
      $express2 = array();
      $standerd1 = array();
      $standerd2 = array();
      $tracked1 = array();
      $tracked2 = array();
      
      $barcode  =  $this->request->data['barcode'];
      
      if($barcode)
      {
       $results = $this->OpenOrder->find('all', array('conditions' => array('OpenOrder.num_order_id'=>$barcode, 'OpenOrder.status' => '1' , 'OpenOrder.sorted_scanned' => '0', 'OpenOrder.error_code' => '')));
      }
       
       // Update tables and create manifest according to services those alloted already with manifest feild
       if( count($results) > 0 )
       {
       $i = 0;
       foreach($results as $result)
       {
       
        $openOrderId = $result['OpenOrder']['id'];
        $serviceName = $result['OpenOrder']['service_name'];
        $serviceProvider = $result['OpenOrder']['service_provider'];
        $serviceCode = $result['OpenOrder']['service_code'];
        $country = $result['OpenOrder']['destination'];
        
        /*$itemdetails[$i]['Id']    = $result['OpenOrder']['id'];
        $itemdetails[$i]['OrderId']   = $result['OpenOrder']['order_id'];
        $itemdetails[$i]['NumOrderId']  = $result['OpenOrder']['num_order_id'];
        $itemdetails[$i]['GeneralInfo']  = unserialize($result['OpenOrder']['general_info']);
        $itemdetails[$i]['ShippingInfo']  = unserialize($result['OpenOrder']['shipping_info']);
        $itemdetails[$i]['CustomerInfo']  = unserialize($result['OpenOrder']['customer_info']);
        $itemdetails[$i]['TotalsInfo']  = unserialize($result['OpenOrder']['totals_info']);
        $itemdetails[$i]['FolderName']  = unserialize($result['OpenOrder']['folder_name']);
        $itemdetails[$i]['Items']   = unserialize($result['OpenOrder']['items']);*/
        
        // Update Service table and applied counter value
        $this->loadModel( 'ServiceCounter' );
        $getCounterValue = $this->ServiceCounter->find( 'first' , 
      array( 'conditions' => 
       array( 
         'ServiceCounter.service_name' => $serviceName,
         'ServiceCounter.service_provider' => $serviceProvider,
         'ServiceCounter.service_code' => $serviceCode,
         'ServiceCounter.destination' => $country        
       )
      ) );
      
      // Manage Counter Section
      $counter = 0;
      if( $getCounterValue['ServiceCounter']['counter'] > 0 ):
       $counter = $getCounterValue['ServiceCounter']['counter'];
       $counter = $counter + 1;
      else:
       $counter = $counter + 1;
      endif;
        
        // Manage Order Id's also
        $orderCommaSeperated = '';
        if( $getCounterValue['ServiceCounter']['order_ids'] != '' ):
       $orderCommaSeperated = $getCounterValue['ServiceCounter']['order_ids'];
       $orderCommaSeperated = $orderCommaSeperated.','.$openOrderId;
        else:
       $orderCommaSeperated = $openOrderId;
        endif;
        
         // Now, Updating Services ...... 
      $this->request->data['ServiceCounter']['ServiceCounter']['id'] = $getCounterValue['ServiceCounter']['id'];      
      $this->request->data['ServiceCounter']['ServiceCounter']['counter'] = $counter;
      $this->request->data['ServiceCounter']['ServiceCounter']['order_ids'] = $orderCommaSeperated;         
         $this->ServiceCounter->saveAll( $this->request->data['ServiceCounter'] );
         
         // Now, Updating Open Order ...... 
      $this->request->data['OpenOrder']['OpenOrder']['id'] = $openOrderId;            
      $this->request->data['OpenOrder']['OpenOrder']['sorted_scanned'] = 1;         
         $this->OpenOrder->saveAll( $this->request->data['OpenOrder'] );
         
         // Manifest Creation
         //$this->createManifestAccordingToServiceIfYes();
         
        $i++;
       } 
       
        //Conversion done with services and return it.                
    return strtolower(str_replace(')','-',str_replace('(','-',str_replace('<','-',str_replace(' ','-',$serviceProvider.$serviceName.$serviceCode.$country)))));       
    }
    else
    {
     //Response Blank         
     echo "none"; exit;
    }
        
    /*if(isset($itemdetails))
    {
     $itemdetails = json_decode(json_encode($itemdetails), TRUE);
     $myArray = Set::sort($itemdetails, '{n}.GeneralInfo.ReceivedDate', 'ASC');
    
     foreach($myArray as $itemdetail)
     {
      if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Express' && count($itemdetail['Items']) == 1)
      {
       $express1[] = $itemdetail;
      }
      if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Standard' && count($itemdetail['Items']) == 1)
      {
       $standerd1[] = $itemdetail;
      }
      if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Tracked' && count($itemdetail['Items']) == 1)
      {
        $tracked1[] = $itemdetail;
      }
      if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Express' && count($itemdetail['Items']) > 1)
      {
       $express2[] = $itemdetail;
      }
      if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Standard' && count($itemdetail['Items']) > 1)
      {
       $standerd2[] = $itemdetail;
      }
      if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Tracked' && count($itemdetail['Items']) > 1)
      {
        $tracked2[] = $itemdetail;
      }
     }
    }
      $this->set(compact('express1','standerd1','tracked1','express2','standerd2','tracked2'));
      echo $this->render('scansearch');*/
      
      
     }
     
     /*
      * 
      * 
      * Function for RacK Label print and Add or Remove ( 27-11-2015 Morning )
      * 
      * 
      * 
      */
      /*
	    * 
	    * Params, manipulate racks, level, section then Bins
	    * 
	    */ 
	   public function openRack()
	   {
		   $this->layout = "index";
		   $this->loadModel( 'Rack' );
		   
		   $data = $this->Rack->find('first' , array( 'fields' => array( 'Rack.rack_name' ) , 'group' => array('Rack.rack_name') , 'order' => array( 'Rack.id DESC' ) , 'limit' => 1 ));		   		   
		   if( count($data) > 0 )
		   {
				$firstRack = json_decode(json_encode($data),0);			   		   
				
				$rackGroupData = json_decode(json_encode($this->Rack->find('all' , array( 'fields' => array( 'count( Rack.level_association ) as SectionCounter' ) , 'group' => array('Rack.level_association') , 'order' => array( 'Rack.id ASC' ) ))),0);
				
				$rackData = json_decode(json_encode($this->Rack->find('all' , array( 'fields' => array( 'count( Rack.level_association ) as sectionCounter' , 'Rack.rack_name' , 'Rack.level_association' , 'Rack.rack_level_section' , 'Rack.locking_stage_section') , 'conditions' => array('Rack.rack_name' => $firstRack->Rack->rack_name),'group' => array('Rack.level_association'), 'order' => array( 'Rack.level_association ASC' ) ))),0);			   
				
				$rackNameList = $this->Rack->find('list' , array( 'fields' => array( 'Rack.rack_name' ) , 'group' => array('Rack.rack_name') , 'order' => array( 'Rack.id ASC' ) ));
				
				$this->set(compact('rackData' , 'rackNameList' , 'rackGroupData') );
		   }
		   
	   }
	   
	   /*
	    * 
	    * Params, Get Rack detail according to RackN
	    * 
	    */ 
	   public function getRackdetail()
	   {
			$this->layout = "";
			$this->autoRander = false;	
			
			$rackName = $this->request->data['rackInputName'];
			
			//Load model
			$this->loadModel( 'Rack' );
			
			$rackData = json_decode(json_encode($this->Rack->find('all' , array( 'fields' => array( 'count( Rack.level_association ) as sectionCounter' , 'Rack.rack_name' , 'Rack.level_association' , 'Rack.rack_level_section' , 'Rack.locking_stage_section') , 'conditions' => array( 'Rack.rack_name' => $rackName ),'group' => array('Rack.level_association'), 'order' => array( 'Rack.level_association ASC' ) ))),0);				
			//$rackData = json_decode(json_encode($this->Rack->find('all' , array( 'fields' => array( 'count( Rack.level_association ) as sectionCounter' , 'Rack.rack_name' , 'Rack.level_association' , 'Rack.rack_level_section' , 'Rack.locking_stage_section') , 'conditions' => array('Rack.rack_name' => $firstRack->Rack->rack_name),'group' => array('Rack.level_association'), 'order' => array( 'Rack.level_association ASC' ) ))),0);			   
			
			$this->set(compact('rackData') );
			$this->render( 'add_rack' );			
	   }
	   
	   /*
	    * 
	    * Params, New rack will be entertain according to new one
	    * 
	    */ 
	   public function addRackBtnOnClick()
	   {
		   $this->layout = "";
		   $this->autoRander = false;
		   
		   $rackName = $this->request->data['rackInputName'];
		   $floorName = explode( '_',$rackName  )[0];
		   $rackfloorName = explode( '_',$rackName  )[1];
		   
		   //Load model
		   $this->loadModel( 'Rack' );
		   
		   //Saving new Rack but ensure it has existed in table or not
		   $data = $this->Rack->find('all' , array( 'conditions' => array( 'Rack.rack_name' => $rackName )));
		   
		   if( count( $data ) > 0 ):
				echo "1"; exit;
		   else:
				// Store new rack with default locations
				$rackLevel = 1;$incDouble = 2;$inc = 1;$ik = 0;while( $ik < 5 ):
					
					//Pair store with 1-2
					$this->request->data['NewRack']['Rack']['floor_name'] = $floorName;
					$this->request->data['NewRack']['Rack']['rack_floorName'] = $rackfloorName;
					$this->request->data['NewRack']['Rack']['rack_name'] = $rackName;
					$this->request->data['NewRack']['Rack']['level_association'] = $rackfloorName.'-'.'L'.$rackLevel;
					$this->request->data['NewRack']['Rack']['rack_level_section'] = $rackName.'-'.'L'.$rackLevel.'-'.'S'.$inc;
					$this->request->data['NewRack']['Rack']['rack_section'] = 'S'.$inc;										
					$this->request->data['NewRack']['Rack']['locking_stage_section'] = 0;
					
					//Create Label and Pdf
					//Racks Barcodes
				    $uploadUrl = $this->getUrlBase();
				    $imgPath = WWW_ROOT .'img/racks/barcodes/';   
				    
				    // Section 1
				    $content = file_get_contents($uploadUrl.$rackName.'-'.'L'.$rackLevel.'-'.'S'.$inc);
				    file_put_contents($imgPath.$rackName.'-'.'L'.$rackLevel.'-'.'S'.$inc.'.png', $content);
				    //$this->rackBarcodePrintAccordingToSection_level( $rackName.'-'.'L'.$rackLevel.'-'.'S'.$inc );
					$this->Rack->saveAll( $this->request->data['NewRack'] );
					
					//Pair store with 1-2
					$this->request->data['NewRack']['Rack']['floor_name'] = $floorName; // Floor
					$this->request->data['NewRack']['Rack']['rack_floorName'] = $rackfloorName; // Rack
					$this->request->data['NewRack']['Rack']['rack_name'] = $rackName;
					$this->request->data['NewRack']['Rack']['level_association'] = $rackfloorName.'-'.'L'.$rackLevel; // Level
					$this->request->data['NewRack']['Rack']['rack_level_section'] = $rackName.'-'.'L'.$rackLevel.'-'.'S'.$incDouble;
					$this->request->data['NewRack']['Rack']['rack_section'] = 'S'.$incDouble;										
					$this->request->data['NewRack']['Rack']['locking_stage_section'] = 0;
					
					//Section 2
				    $content = file_get_contents($uploadUrl.$rackName.'-'.'L'.$rackLevel.'-'.'S'.$incDouble);
				    file_put_contents($imgPath.$rackName.'-'.'L'.$rackLevel.'-'.'S'.$incDouble.'.png', $content);
				    //$this->rackBarcodePrintAccordingToSection_level( $rackName.'-'.'L'.$rackLevel.'-'.'S'.$incDouble );
					$this->Rack->saveAll( $this->request->data['NewRack'] );
					
					$inc = 1;$incDouble = 2;
					$rackLevel++;					
				$ik++;
				endwhile;
			   $rackData = json_decode(json_encode($this->Rack->find('all' , array( 'conditions' => array( 'Rack.rack_name' => $rackName ) ))),0);	
			   $this->set(compact('rackData') );
			   $this->render( 'add_rack' );	
		   endif;		   	   
	   }
	   
	   /*
	    * 
	    * Params, Add cordinates for rack label printing with barcode through third-Party
	    * 
	    */ 
	   public function addRackCordinates()
	   {
		   $this->layout = "";
		   $this->autoRander = false;
		   $rackSectionCordinate = $this->request->data;
		   $rackName = explode('-',$rackSectionCordinate['rack_level_section'])[0];	  
		   $rack_level_section = $rackSectionCordinate['rack_level_section'];
		   
		   //Store cordinates of specific Rack-Level-Section
		   $this->loadModel( 'Rack' );
		   $rackData = $this->Rack->find('all' , array( 'conditions' => array( 'Rack.rack_level_section' => $rack_level_section ) ));		   		   
		   $level = explode('-',$rackSectionCordinate['rack_level_section']);
		   
		   //Racks Barcodes
		   $uploadUrl = $this->getUrlBase();
		   $imgPath = WWW_ROOT .'img/racks/barcodes/';   
		   
		   // Section 1
		   $content = file_get_contents($uploadUrl.$rack_level_section);
		   file_put_contents($imgPath.$rack_level_section.'.png', $content);
		   //$this->rackBarcodePrintAccordingToSection_level( $rack_level_section );
		   
		   //Section 2
		   $content = file_get_contents($uploadUrl.$level[0].'-'.$level[1].'-S2');
		   file_put_contents($imgPath.$level[0].'-'.$level[1].'-S2'.'.png', $content);
		   //$this->rackBarcodePrintAccordingToSection_level( $level[0].'-'.$level[1].'-S2' );
		   
		   // Get continous data now
		   $rackExistingData = $this->Rack->find('all' , array( 'conditions' => array( 'Rack.rack_level_section' => $level[0].'-'.$level[1].'-S2' ) ));
		   $this->request->data['RackStore']['Rack']['id'] = $rackExistingData[0]['Rack']['id'];
		   $this->request->data['RackStore']['Rack']['locking_stage_section'] = 0;
		   $this->Rack->saveAll( $this->request->data['RackStore'] );
		   echo "done"; 		   		   		   
		   exit;
	   }
	   
	   public function rackBarcodePrintAccordingToSection_level( $rack_level_section = null )
	   {
			$this->layout = '';
			$this->autoRender = false;
		
			require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 
			
			spl_autoload_register('DOMPDF_autoload'); 
			$dompdf = new DOMPDF();
		
			$dompdf->set_paper(array(0, 0, 238, 143), 'portrait');
							
			$barcodePath = Router::url('/', true).'/img/racks/barcodes/'.$rack_level_section.'.png';				
			$html2 = '<body>
						<table width="200" border="1">
						  <tr>
							<td>'.$rack_level_section.'</td>
							<td>&nbsp;<img src='.$barcodePath.' width="120" height="50" /></td>
						  </tr>
						</table>
						</body>';
			$cssPath = WWW_ROOT .'css/';
			$html2 .= '<style>'.file_get_contents($cssPath.'pdfstyle.css').'</style>';
			
			//echo $html2;
			//exit;
			//$dompdf->load_html($html2);
			$dompdf->load_html(utf8_decode($html2), Configure::read('App.encoding'));
			$dompdf->render();
			//$dompdf->stream("hello.pdf");
			
			$imgPath = WWW_ROOT .'img/racks/barcodes_pdf/'; 
			$path = Router::url('/', true).'img/racks/barcodes_pdf/';
			
			$date = new DateTime();
			$timestamp = $date->getTimestamp();
			$name = $rack_level_section.'.pdf';
			
			file_put_contents($imgPath.$name, $dompdf->output());
			$serverPath   =  $path.$name ;
							
			$sendData = array(
			 'printerId' => '73390',
			 'title' => 'Now Print',
			 'contentType' => 'raw_uri',
			 'content' => $serverPath,
			 'source' => 'Direct'
			);
			
			
			//App::import( 'Controller' , 'Coreprinters' );
			//$Coreprinter = new CoreprintersController();
			//$d = $Coreprinter->toPrint( $sendData );
			//pr($d); exit;
			
	  }
	  
	  /*
	   * 
	   * Params, New rack cordinates upto 10
	   * 
	   */ 
	 public function addRackCordinatesByOne()
	 {
		   $this->layout = "";
		   $this->autoRander = false;
		   $rackSectionCordinate = $this->request->data;		   
		   
		   //Store cordinates of specific Rack-Level-Section
		   $this->loadModel( 'Rack' );
		   
		   //Racks Barcodes
		   $uploadUrl = $this->getUrlBase();
		   $imgPath = WWW_ROOT .'img/racks/barcodes/';   
		   
		   //$rackName = explode('-',$rackSectionCordinate['rack_level_section'])[0];	  
		   $rack_level_section = explode('-',$rackSectionCordinate['rack_level_section']);
		   
		   // Section 1
		   $content = file_get_contents($uploadUrl.$rackSectionCordinate['rack_level_section']);
		   file_put_contents($imgPath.$rackSectionCordinate['rack_level_section'].'.png', $content);
		   //$this->rackBarcodePrintAccordingToSection_level( $rackSectionCordinate['rack_level_section'] );
		   
		   // Get continous data now		
		   /*$this->request->data['RackStore']['Rack']['rack_name'] = $rackSectionCordinate['rackName'];  
		   $this->request->data['RackStore']['Rack']['level_association'] = explode('_',$rack_level_section[0])[1].'-'.$rack_level_section[1];
		   $this->request->data['RackStore']['Rack']['rack_level_section'] = $rackSectionCordinate['rack_level_section'];   
		   $this->request->data['RackStore']['Rack']['locking_stage_section'] = 0;
		   $this->Rack->saveAll( $this->request->data['RackStore'] );*/
		   
		    $this->request->data['RackStore']['Rack']['floor_name'] = explode('_',$rack_level_section[0])[0]; // Floor
			$this->request->data['RackStore']['Rack']['rack_floorName'] = explode('_',$rack_level_section[0])[1]; // Rack			
			$this->request->data['RackStore']['Rack']['rack_name'] = $rackSectionCordinate['rackName'];
			$this->request->data['RackStore']['Rack']['level_association'] = explode('_',$rack_level_section[0])[1].'-'.$rack_level_section[1];
			
			$this->request->data['RackStore']['Rack']['rack_level_section'] = $rackSectionCordinate['rack_level_section'];
			$this->request->data['RackStore']['Rack']['rack_section'] = $rack_level_section[2];	
			
			$this->Rack->saveAll( $this->request->data['RackStore'] );
			//$this->request->data['NewRack']['Rack']['rack_section'] = 'S'.$incDouble;										
			//$this->request->data['NewRack']['Rack']['locking_stage_section'] = 0;
					
		   
		   
		   echo "done"; 		   		   		   
		   exit;
	 } 
	 
	 /*
	  * 
	  * Params, Racks Labels print
	  * 
	  */
	 public function getPrint()
     {
			$rack_level_section = 'R1-L1-S1';

			$this->layout = '';
			$this->autoRender = false;
			
			//Load Model
			$this->loadModel( 'Rack' );
			$params = array(
				'conditions' => array(
					'Rack.print_bulk' => 0
				),
				'fields' => array(
					'Rack.rack_level_section as AssoiatedName'
				),
				'order' => array(
					'Rack.rack_level_section ASC'
				)
			);
			
			$rackPrintData = json_decode(json_encode($this->Rack->find( 'all' , $params )),0);						
			$outerTotal = count(array_chunk( $this->Rack->find( 'all' , $params ) ,  21 ) );
			$arrayDivision = array_chunk( $this->Rack->find( 'all' , $params ) ,  21 );
			
			$incOuter = 1;$incIncrement = 1;$incTotal = 0;while( $incTotal < $outerTotal )
			{
				
				require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 
				spl_autoload_register('DOMPDF_autoload'); 
				$dompdf = new DOMPDF();
				
				$dompdf->set_paper(array(0, 0, 794, 1123), 'portrait');
				$html2 = '';				
				$html2 = '<body><table cellpadding="5px" cellspacing="0" border="0" width="100%" style="margin-top: 34px;" >';				
				$inc = 1;$i = 0; while( $i < count($arrayDivision[$incTotal]) )
				{		
					$barcodePath = Router::url('/', true).'/img/racks/barcodes/'.$arrayDivision[$incTotal][$i]['Rack']['AssoiatedName'].'.png';
					if( $i == 0 )
					{
						$html2 .= '<tr>';
						$html2 .= '<td style="padding:25px 0 29px;">';
						$html2 .= '<table border="0" cellpadding="5px" cellspacing="0" align="center" >';
						$html2 .= '<tr>';
						$html2 .= '<td align="center"><img src='.$barcodePath.' width="230" height="75" /></td>';
						$html2 .= '</tr>';
						$html2 .= '<tr>';
						$html2 .= '<td  align="center" style="font-size:32px;border:1px solid grey;">'.$arrayDivision[$incTotal][$i]['Rack']['AssoiatedName'].'</td>';
						$html2 .= '</tr>';
						$html2 .= '</table>';
						if( $inc % 3 == 0 )				
						{
							$html2 .= '</tr>';
							$html2 .= '<tr>';
						}
					}
					else
					{
						$html2 .= '<td style="padding:25px 0 29px;">';
						$html2 .= '<table border="0" cellpadding="5px" cellspacing="0" align="center" >';
						$html2 .= '<tr>';
						$html2 .= '<td align="center"><img src='.$barcodePath.' width="230" height="75" /></td>';
						$html2 .= '</tr>';
						$html2 .= '<tr>';
						$html2 .= '<td  align="center" style="font-size:32px;border:1px solid grey;">'.$arrayDivision[$incTotal][$i]['Rack']['AssoiatedName'].'</td>';
						$html2 .= '</tr>';
						$html2 .= '</table>';
						if( $inc % 3 == 0 )				
						{
							$html2 .= '</tr>';
							$html2 .= '<tr>';
						}
					}				
				$i++;$inc++;
				}
				
				$html2 .= '</table></body>';
				
				$dompdf->load_html($html2);
				$dompdf->load_html(utf8_decode($html2), Configure::read('App.encoding'));
				$dompdf->render();
				//$dompdf->stream("hello.pdf");
				
				$imgPath = WWW_ROOT .'img/racks/barcodes_pdf/'; 
				$path = Router::url('/', true).'img/racks/barcodes_pdf/';

				$date = new DateTime();
				$timestamp = $date->getTimestamp();
				$name = $incIncrement.'.pdf';
				file_put_contents($imgPath.$name, $dompdf->output());
				
			$incTotal++;$incIncrement++;	
			}
			
			/*file_put_contents($imgPath.$name, $dompdf->output());
			$serverPath   =  $path.$rack_level_section.'.pdf' ;                              
			$sendData = array(
			'printerId' => '72096',
			'title' => 'Rack Labels Printing Mode',
			'contentType' => 'pdf_uri',
			'content' => $serverPath,
			'source' => 'Direct'
			);
						
			App::import( 'Controller' , 'Coreprinters' );
			$Coreprinter = new CoreprintersController();
			$d = $Coreprinter->toPrint( $sendData );
			pr($d); exit;*/

		}

	 /*
	  * 
	  * Params, Remove section 
	  * 
	  */	
	 public function removeRackCordinatesByOne()
	 {
		   $this->layout = "";
		   $this->autoRander = false;
		   $rackSectionCordinate = $this->request->data;
		   
		   //Store cordinates of specific Rack-Level-Section
		   $this->loadModel( 'Rack' );
		   
		   $getData = $this->Rack->find( 'first', array('fields' => array('Rack.id'), 'conditions' => array( 'Rack.rack_level_section' => $rackSectionCordinate['rack_level_section'] ) ) );
		   $this->Rack->delete( $getData['Rack']['id'] );		   
		   echo "delete"; exit;
	 }  
	 
	 public function getRackdetailForWarehouseOnClick()
     {
		$this->layout = "";
		$this->autoRander = false;	
		$rackName = $this->request->data['rackInputName'];
		//Load model
		$this->loadModel( 'Rack' );
				
		$rackData = json_decode(json_encode($this->Rack->find('all' , array( 'fields' => array( 'count( Rack.level_association ) as sectionCounter' , 'Rack.rack_name' , 'Rack.level_association' , 'Rack.rack_level_section' , 'Rack.locking_stage_section') , 'conditions' => array( 'Rack.rack_name' => $rackName ),'group' => array('Rack.level_association'), 'order' => array( 'Rack.level_association ASC' ) ))),0);						
		$this->set(compact('rackData') );
		$this->render( 'warehouse_rack' );			
    }
 
}
?>
