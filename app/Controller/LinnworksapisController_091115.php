<?php
class LinnworksapisController extends AppController
{
    /* controller used for linnworks api */
    
    var $name = "Linnworksapis";
    
    var $components = array('Session','Upload','Common','Auth');
    
    var $helpers = array('Html','Form','Common','Session','Soap','Number');
    
     public function index()
		{
			$this->layout = "index";
			$this->set('role', 'Linnworks API');
		}
	
	 public function getCategory()
		{
			/* method's ctp file get category */
			$this->layout = "index";
			$this->set('title', 'Category (Linnworks API)');
		}
	
	 public function getorderStatus()
		{
			/* method's ctp file get order status */
			$this->layout = "index";
			$this->set('title', 'Status (Linnworks API)');

		}
	
	 public function getPostalServices()
		{
			/* method's ctp file get postal services */
			$this->layout = "index";
			$this->set('title', 'Postal Service (Linnworks API)');
		}
	
	 public function getLocations()
		{
			/* method's ctp file get location */
			$this->layout = "index";
			$this->set('title', 'Location (Linnworks API)');
		}
	
	 public function getStockItem()
		{
			/* method's ctp file get stock item */
			$this->layout = "index";
			$this->set('title', 'Stock Items (Linnworks API)');
		}
	public function getOrder( $orderID = null, $pkOrderId = null)
		{
			
			$this->layout = "index";
			if($orderID == 'deleteOrder')
			{
				$delete = 'orderdeleted';
				$this->Session->setflash(  "Order Deleted Successful.",  'flash_success' );
			}
			else
			{
				$delete = '';
			}
			$this->set(compact('orderID', 'pkOrderId','delete'));
		}

public function getFilterOrder()
	{
		if($this->request->data)
		{
			$data	=	$this->request->data;
			$this->set('data' , $data);
		}
		$this->layout = "index";
		$this->set('title', 'Filter order (Linnworks API)');
	}


public function downloadExcel()
	{
		$this->autoRender = false;
		$this->layout = '';
		
		$data['Linnworksapi']['order_type'] 	= 	$this->request->data['Linnworksapis']['order_type'];
		$data['Linnworksapi']['location'] 		= 	$this->request->data['Linnworksapis']['location'];
		$data['Linnworksapi']['source'] 		= 	$this->request->data['Linnworksapis']['source'];
		$data['Linnworksapi']['subsource'] 		= 	$this->request->data['Linnworksapis']['subsource'];
		$data['Linnworksapi']['datefrom'] 		= 	$this->request->data['Linnworksapis']['datefrom'];
		$data['Linnworksapi']['dateto'] 		= 	$this->request->data['Linnworksapis']['dateto'];
		$data['Linnworksapi']['orderid'] 		= 	$this->request->data['Linnworksapis']['orderid'];
		App::import('Helper', 'Soap');
		$SoapHelper = new SoapHelper( new View(null) );
		$getData	=	$SoapHelper->getFilteredOrder( $data );
		
		App::import('Helper', 'Number');
		$numberHelper = new NumberHelper( new View(null) );
		
		App::import('Vendor', 'PHPExcel/IOFactory');
		App::import('Vendor', 'PHPExcel');
		$objPHPExcel = new PHPExcel();   
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
		
		$i = 2;
		foreach($getData->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order as $order)
				{
					$contents = array();
					$orderItems = array();
					foreach($order->OrderItems->OrderItem as $item)
						{ 
							$contents[] =	$item->Qty.' X '.$item->ItemTitle;
							$orderItems[] =	$item->OrderItemNumber;
						}
		
					$content = implode(" \n", $contents);
					$orderItem = implode(" \n", $orderItems);
					
					$itemCount	=	count($order->OrderItems->OrderItem);
					
					
					
					$address	=	$order->ShippingAddress->Address1.','.
									$order->ShippingAddress->Address2.','.
									$order->ShippingAddress->Address3;
									
					$address = explode(',', $address);
					$address = implode(" \n ", $address);
		
						
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$i.'', $orderItem);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$i.'', $order->ShippingAddress->Name);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$i.'', $address);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$i.'', $order->ShippingAddress->PostCode );
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$i.'', $order->ShippingAddress->CountryCode);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$i.'', $itemCount);
	
		$totlaCost =	$numberHelper->currency( $order->TotalCost, 'EUR' );
		
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$i.'', $content );
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$i.'', $totlaCost);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$i.'', '5');
		$objPHPExcel->getActiveSheet()->setCellValue('J'.$i.'', '5');
		$objPHPExcel->getActiveSheet()->setCellValue('K'.$i.'', '5');
		$objPHPExcel->getActiveSheet()->setCellValue('L'.$i.'', '5');
		$objPHPExcel->getActiveSheet()->setCellValue('M'.$i.'', '5');
		
		$i++;
				}
		
		
		
		if($this->request->data['Linnworksapis']['order_type'] == 0)
		{
			$objPHPExcel->getActiveSheet()->setTitle('Open Order');
			$objPHPExcel->createSheet();
			$name = 'Open Order';
		}
		if($this->request->data['Linnworksapis']['order_type'] == 1)
		{
			$objPHPExcel->getActiveSheet()->setTitle('Processed Order');
			$objPHPExcel->createSheet();
			$name = 'Procesed Order';
		}
		if($this->request->data['Linnworksapis']['order_type'] == 2)
		{
			$objPHPExcel->getActiveSheet()->setTitle('Cancelled Order');
			$objPHPExcel->createSheet();
			$name = 'Cancelled Order';
		}
		
		
		header('Content-Encoding: UTF-8');
		header('Content-type: text/csv; charset=UTF-8');
		header('Content-Disposition: attachment;filename="'.$name.'.csv"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
		
		$objWriter->save('php://output');
	}

	public function generatePickList()
	{
				App::import('Helper', 'Soap');
				$SoapHelper = new SoapHelper( new View(null) );
			
				$test	=	$this->request->data['Linnworksapis']['orderid'];
			
				$skus	=	explode("---", $test);
				asort($skus);
				$skus	=	array_count_values($skus);
				
				$this->autoRender = false;
				$this->layout = '';
		
				$data	=	array();
				$index = 0;
				
				foreach( $skus as $key => $value)
				{
					$getData	=	$SoapHelper->getOrderById( $key );
					
					foreach($getData->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order as $order)
						{	
							foreach($order->OrderItems->OrderItem as $item)
								{ 
									$data[$index]['Qty']		=	$item->Qty;
									$data[$index]['ItemTitle']	=	$item->ItemTitle;
									$data[$index]['binrack'] 	=	$item->Binrack;
									$data[$index]['barcode'] 	=	$item->Barcode;
									$data[$index]['category'] 	=	$item->Category;
									$data[$index]['ChannelSKU'] =	$item->SKU;
									$data[$index]['PostalServiceName'] =	$getData->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->PostalServiceName;
									$index++;
								}
						}
				}
		
					$json = json_encode($data);
					$arrays = json_decode($json,TRUE);
					$ind = 0;
					
					foreach($arrays as $array)
					{
						$dataNew[$ind]['Qty']			=	$array['Qty'][0];
						$dataNew[$ind]['ItemTitle']		=	$array['ItemTitle'][0];
						$dataNew[$ind]['binrack']		=	(isset($array['binrack'][0])) ? $array['binrack'][0] : 'null';
						$dataNew[$ind]['barcode']		=	(isset($array['barcode'][0])) ? $array['barcode'][0] : 'null';				
						$dataNew[$ind]['ChannelSKU']	=	(isset($array['ChannelSKU'][0])) ? $array['ChannelSKU'][0] : 'null';
						$dataNew[$ind]['PostalServiceName']	=	$array['PostalServiceName'][0];
						$ind++;
					}
					
					/* get the duplicaate value */
					$duplicatedata = $dataNew;
					 
					foreach($dataNew as $dataNewOuter => $dataNewOutervalue)
					{
						foreach($dataNew as $dataNewInner => $dataNewInnervalue)
						{
							if($dataNewOutervalue['ChannelSKU'] === $dataNewInnervalue['ChannelSKU'])
							{
								if($dataNewOuter != $dataNewInner)
								{
									$duplicateValue[$dataNewInner]  = $dataNewInnervalue['ChannelSKU'];
								}
							}
						}
					}
					if( isset($duplicateValue) && count($duplicateValue) > 0)
					{
					$a = array_unique($duplicateValue);
					
					
					$duplicateArray = $dataNew;	
					foreach($duplicateValue as $key => $value)
					{
						unset($dataNew[$key]);
					
					}
					sort($dataNew);
				
					$result = array_merge($dataNew, $a);
					}
					else
					{
						$result	=	$duplicatedata;
					}
					
					$e = 0; $r = 0;
					foreach($result as $keyIndex => $keyValue ) 
					{
				
						$csvData[$r]['Qty'] = 0;
						foreach($duplicatedata as $dupIndex => $dupValue)
						{
							if(isset($keyValue['ChannelSKU']))
							{
								if($keyValue['ChannelSKU'] == $dupValue['ChannelSKU'])
								{
									$csvData[$r]['Qty']			=	$dupValue['Qty'];
									$csvData[$r]['ItemTitle']	=	$dupValue['ItemTitle'];
									$csvData[$r]['binrack']		=	$dupValue['binrack'];
									$csvData[$r]['barcode']		=	$dupValue['barcode'];	
									$csvData[$r]['ChannelSKU']	=	$dupValue['ChannelSKU'];	
								}
							}
							if(isset($keyValue))
							{
								if($keyValue == $dupValue['ChannelSKU'])
								{
									$csvData[$r]['Qty']			=	$csvData[$r]['Qty'] + $dupValue['Qty'];
									$csvData[$r]['ItemTitle']	=	$dupValue['ItemTitle'];
									$csvData[$r]['binrack']		=	$dupValue['binrack'];
									$csvData[$r]['barcode']		=	$dupValue['barcode'];	
									$csvData[$r]['ChannelSKU']	=	$dupValue['ChannelSKU'];
								}
							}
						} 
						$r++;
					}	
				
				
				App::import('Vendor','tcpdf/tcpdf');
			    $pdf = new tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			    $date =	date("Y-m-d");
							 
				$pdf->SetCreator(PDF_CREATOR);
				//$pdf->SetAuthor('Nicola Asuni');
				//$pdf->SetTitle('TCPDF Example 006');
				//$pdf->SetSubject('TCPDF Tutorial');
				//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

				// set default header data
				//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Pick List '.$date, PDF_HEADER_STRING);
				$pdf->SetHeaderData('', '', 'Pick List '.$date, '');

				// set header and footer fonts
				$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				// set margins
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				// set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


					if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
						require_once(dirname(__FILE__).'/lang/eng.php');
						$pdf->setLanguageArray($l);
					}

				$pdf->SetFont('times', '', 8);
				$pdf->AddPage();
				$j=0;
				foreach($csvData as $csvdata)
					{
						$j = $j+$csvdata['Qty'];
					}
				$html = '<h2>Total SKU  : - '.$j.'</h2>
				<table border="1" width="110%" >
					<tr>
						<th width="5%" align="center">S.No</th>
						<th width="20%" align="center">SKU</th>
						<th width="45%" align="center">Qty / Item Title</th>
						<th width="5%" align="center">Qty</th>
						<th width="5%" align="center">Bin Rack</th>
						<th width="10%" align="center" >BarCode</th>
					</tr>';
					$i = 1; 
				foreach($csvData as $csvdata)
					{
					$html.=	'<tr>
						<td align="center">'.$i.'</td>
						<td>'.$csvdata['ChannelSKU'].'</td>
						<td align="left"><b>'.$csvdata['Qty'] .'</b> X '. $csvdata['ItemTitle'].'</td>
						<td align="center">'.$csvdata['Qty'].'</td>
						<td >'.$csvdata['binrack'].'</td>
						<td>'.$csvdata['barcode'].'</td>
					</tr>';
					$i++;
					}
				$html .= '</table>';
			
				$pdf->writeHTML($html, true, false, true, false, '');
				$js = 'print(true);';
				$pdf->IncludeJS($js);
				$pdf->Output('Pick_List_'.$date.'.pdf', 'D');
		}

	/*
	 * 
	 * function use for get open order and save order and item detail in database 
	 * 
	 * */
	 
		/*public function getOpenOrder()
		{
			
			$this->layout = 'index';
			$this->loadModel('Order');
			$this->loadModel('Item');
		
			App::import('Vendor', 'linnwork/api/Auth');
			App::import('Vendor', 'linnwork/api/Factory');
			App::import('Vendor', 'linnwork/api/Orders');
		
			$username = Configure::read('linnwork_api_username');
			$password = Configure::read('linnwork_api_password');
			
			$multi = AuthMethods::Multilogin($username, $password);
			
			$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

			$token = $auth->Token;	
			$server = $auth->Server;
			$results	=	OrdersMethods::GetOpenOrders('100','1','','','00000000-0000-0000-0000-000000000000','',$token, $server);
			
			//pr($results);
			//exit;
			$this->set('results', $results);
			foreach($results->Data as $orderids)
				{
					$orders[]	=	$orderids->OrderId;
				}
				
				$results	=	OrdersMethods::GetOrders($orders,'00000000-0000-0000-0000-000000000000',true,true,$token, $server);
				
				
			
			foreach($results as $result)
				{
					$finddata	=	$this->Order->find('first', array('conditions' => array('Order.num_order_id' =>$result->NumOrderId)));
					if(empty($finddata))
					{
						$data['Order']['num_order_id']		=	$result->NumOrderId;
						$data['Order']['pk_order_id']		=	$result->OrderId;
						$data['Order']['total']				=	$result->TotalsInfo->TotalCharge;
						$data['Order']['postal_service']	=	$result->ShippingInfo->PostalServiceName;
						$data['Order']['customer_name']		=	$result->CustomerInfo->Address->FullName;
						$data['Order']['source']			=	$result->GeneralInfo->Source;
						
						$dateTime	=	explode('T', $result->GeneralInfo->ReceivedDate);
						$data['Order']['received_date']	=	$dateTime[0];
						
						
						$this->Order->saveAll($data);
						$order_id	=	$this->Order->getLastInsertID();

						
						foreach($result->Items as $Item)
						{

							$dataNew['Item']['order_id']	=	$order_id;
							$dataNew['Item']['sku']			=	$Item->SKU;
							$dataNew['Item']['barcode']		=	$Item->BarcodeNumber;
							$dataNew['Item']['quantity']	=	$Item->Quantity;
							$dataNew['Item']['title']	=	$Item->Title;
							$dataNew['Item']['priceperunit']	=	$Item->PricePerUnit;
							$dataNew['Item']['discount']	=	$Item->Discount;
							$dataNew['Item']['tax']	=	$Item->Tax;
							$dataNew['Item']['costinctax']	=	$Item->CostIncTax;
							$this->Item->saveAll($dataNew);

						}
					}
				}
			
			
			
				$express1	=	array();
				$express2	=	array();
				$standerd1	=	array();
				$standerd2	=	array();
				$tracked1	=	array();
				$tracked2	=	array();
				
				foreach($results as $data)
				{
					if($data->ShippingInfo->PostalServiceName == 'Express' && count($data->Items) == 1 )
					{
						$express1[]	=	$data;
					}
					else if( $data->ShippingInfo->PostalServiceName == 'Express' && count($data->Items) > 1 )
					{
						$express2[]	=	$data ;
					}
					if($data->ShippingInfo->PostalServiceName == 'Standard' && count($data->Items) == 1 )
					{
						$standerd1[]	=	 $data;
					}
					else if( $data->ShippingInfo->PostalServiceName == 'Standard' && count($data->Items) > 1 )
					{
						$standerd2[]	=	 $data;
					}
					if($data->ShippingInfo->PostalServiceName == 'Tracked' && count($data->Items) == 1 )
					{
						$tracked1[]	=	 $data;
					}
					else if( $data->ShippingInfo->PostalServiceName == 'Tracked' && count($data->Items) > 1 )
					{
						$tracked2[]	=	 $data;
					}
				}
				
				$this->set(compact('express1','express2','standerd1','standerd2','tracked1','tracked2'));
		}*/
		
		
		
		public function getOpenOrder()
		{
			/* for view of only order */
			$this->layout = 'index';
			$this->loadModel('Order');
			$this->loadModel('Item');
		
			$this->loadModel( 'OpenOrder' );
			$getdetails	=	$this->OpenOrder->find('all', array('conditions' => array('OpenOrder.status' => '0')));
			$i = 0;
			
			foreach($getdetails as $getdetail)
			{
				$results[$i]['OrderId']			=	 $getdetail['OpenOrder']['order_id'];
				$results[$i]['NumOrderId']		=	 $getdetail['OpenOrder']['num_order_id'];
				$results[$i]['GeneralInfo']		=	 unserialize($getdetail['OpenOrder']['general_info']);
				$results[$i]['ShippingInfo']	=	 unserialize($getdetail['OpenOrder']['shipping_info']);
				$results[$i]['CustomerInfo']	=	 unserialize($getdetail['OpenOrder']['customer_info']);
				$results[$i]['TotalsInfo']		=	 unserialize($getdetail['OpenOrder']['totals_info']);
				$results[$i]['FolderName']		=	 unserialize($getdetail['OpenOrder']['folder_name']);
				$results[$i]['Items']			=	 unserialize($getdetail['OpenOrder']['items']);
				
				$i++;
			}
		
			$results	=	json_decode(json_encode($results),0);
			$this->set('results', $results);
			
			/* code send for save order short detail in data base*/
			
				$express1	=	array();
				$express2	=	array();
				$standerd1	=	array();
				$standerd2	=	array();
				$tracked1	=	array();
				$tracked2	=	array();
				
				foreach($results as $data)
				{
					
					if($data->ShippingInfo->PostalServiceName == 'EXPRESS' && count($data->Items) == 1 )
					{
						$express1[]	=	$data;
					}
					else if( $data->ShippingInfo->PostalServiceName == 'EXPRESS' && count($data->Items) > 1 )
					{
						$express2[]	=	$data ;
					}
					if($data->ShippingInfo->PostalServiceName == 'Standard' && count($data->Items) == 1 )
					{
						$standerd1[]	=	 $data;
					}
					else if( $data->ShippingInfo->PostalServiceName == 'Standard' && count($data->Items) > 1 )
					{
						$standerd2[]	=	 $data;
					}
					if($data->ShippingInfo->PostalServiceName == 'TRACKED' && count($data->Items) == 1 )
					{
						$tracked1[]	=	 $data;
					}
					else if( $data->ShippingInfo->PostalServiceName == 'TRACKED' && count($data->Items) > 1 )
					{
						$tracked2[]	=	 $data;
					}
				}
				
				$this->set(compact('express1','express2','standerd1','standerd2','tracked1','tracked2'));
		}
		
		
		
		
		
		/*public function orderProcess()
		{
			
			App::import('Vendor', 'linnwork/api/Auth');
			App::import('Vendor', 'linnwork/api/Factory');
			App::import('Vendor', 'linnwork/api/Orders');
		
			$username	=	Configure::read('linnwork_api_username');
			$password	=	Configure::read('linnwork_api_password');
			
			$multi = AuthMethods::Multilogin($username, $password);
			
			$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

			$token 			= 	$auth->Token;	
			$server 		= 	$auth->Server;
			$scanPerformed 	= 	true;
			$orderId		=	$this->request->data['id'];
			
			$result = OrdersMethods::ProcessOrder($orderId,$scanPerformed,$token, $server);
			if($result->Processed == 1)
			{
				echo "1";
				exit;
			}
			else
			{
				echo "2";
				exit;
			}
		}*/
		
		public function orderCancel()
		{
			
			App::import('Vendor', 'linnwork/api/Auth');
			App::import('Vendor', 'linnwork/api/Factory');
			App::import('Vendor', 'linnwork/api/Orders');
		
			$username	=	Configure::read('linnwork_api_username');
			$password	=	Configure::read('linnwork_api_password');
			
			$multi = AuthMethods::Multilogin($username, $password);
			
			$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

			$token 			= 	$auth->Token;	
			$server 		= 	$auth->Server;
			
			$getContent	=	explode('##$#', $this->request->data['content']);
			$orderId	=	$getContent['0'];
			$fulFilment	=	$getContent['1'];
			$refund		=	$getContent['2'];
			$note 		= 	'test note';
			
			
			$result = OrdersMethods::CancelOrder($orderId,$fulFilment,$refund,$note,$token, $server);
			echo "1";
			exit;
			
		}
		
		
		
		
		
		public function getOrderDetail( $id=null )
		{
			$this->layout = 'index';
			$this->loadModel( 'OpenOrder' );
			$getdetails	=	$this->OpenOrder->find('first', array('conditions' => array('OpenOrder.num_order_id' => $id)));
			
			$data['OrderId']		=	$getdetails['OpenOrder']['order_id'];
			$data['NumOrderId']		=	$getdetails['OpenOrder']['num_order_id'];
			$data['GeneralInfo']	=	unserialize($getdetails['OpenOrder']['general_info']);
			$data['ShippingInfo']	=	unserialize($getdetails['OpenOrder']['shipping_info']);
			$data['CustomerInfo']	=	unserialize($getdetails['OpenOrder']['customer_info']);
			$data['TotalsInfo']		=	unserialize($getdetails['OpenOrder']['totals_info']);
			$data['FolderName']		=	unserialize($getdetails['OpenOrder']['folder_name']);
			$data['Items']			=	unserialize($getdetails['OpenOrder']['items']);
	
			$getDetail				=	json_decode(json_encode($data));
			$this->set('getDetail', $getDetail);
		}
		
		
		
		
		
		
		
		
		
		/*public function getOrderDetail($orderID = null, $pkOrderId=null)
		{
			$this->layout = 'index';
			$this->set(compact('orderID', 'pkOrderId'));
		}*/

		public function orderDelete()
		{
			App::import('Vendor', 'linnwork/api/Auth');
			App::import('Vendor', 'linnwork/api/Factory');
			App::import('Vendor', 'linnwork/api/Orders');
		
			$username	=	Configure::read('linnwork_api_username');
			$password	=	Configure::read('linnwork_api_password');
			
			$multi = AuthMethods::Multilogin($username, $password);
			$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

			$token 			= 	$auth->Token;	
			$server 		= 	$auth->Server;
			
			$orderid	=	$this->request->data['id'];
		
			$result = OrdersMethods::DeleteOrder($orderid, $token, $server);
			
			echo "1";
			exit;
			
		}
 	public function rearrangeOrder()
		   {
				$this->layout = 'index';
			  
			    //$orders	=	explode("##$#",$this->request->data['Linnworksapis']['data']);
			   
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
				//pr($openorder);
				//exit;
				foreach($openorder->Data as $orderids)
				{
					$orders[]	=	$orderids->OrderId;
				}
				
				$results	=	OrdersMethods::GetOrders($orders,'00000000-0000-0000-0000-000000000000',true,true,$token, $server);
			
				$express1	=	array();
				$express2	=	array();
				$standerd1	=	array();
				$standerd2	=	array();
				$tracked1	=	array();
				$tracked2	=	array();
				
				foreach($results as $data)
				{
					
					if($data->ShippingInfo->PostalServiceName == 'Express' && count($data->Items) == 1 )
					{
						$express1[]	=	$data;
					}
					else if( $data->ShippingInfo->PostalServiceName == 'Express' && count($data->Items) > 1 )
					{
						$express2[]	=	$data ;
					}
					if($data->ShippingInfo->PostalServiceName == 'Standard' && count($data->Items) == 1 )
					{
						$standerd1[]	=	 $data;
					}
					else if( $data->ShippingInfo->PostalServiceName == 'Standard' && count($data->Items) > 1 )
					{
						$standerd2[]	=	 $data;
					}
					if($data->ShippingInfo->PostalServiceName == 'Tracked' && count($data->Items) == 1 )
					{
						$tracked1[]	=	 $data;
					}
					else if( $data->ShippingInfo->PostalServiceName == 'Tracked' && count($data->Items) > 1 )
					{
						$tracked2[]	=	 $data;
					}
					
					
				}
				
				$this->set(compact('results','express1','express2','standerd1','standerd2','tracked1','tracked2'));
		   }

			
		   public function labelAssign()
		   {
			 
			    App::import('Vendor', 'linnwork/api/Auth');
				App::import('Vendor', 'linnwork/api/Factory');
				App::import('Vendor', 'linnwork/api/PrintService');
			
				$username = Configure::read('linnwork_api_username');
				$password = Configure::read('linnwork_api_password');
				
				$multi = AuthMethods::Multilogin($username, $password);
				
				$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

				$token = $auth->Token;	
				$server = $auth->Server;
				
				$orderIdArray[]	=	$this->request->data['id'];
				$IDs = $orderIdArray;
				$parameters = '[]';
			
			    $result 	= 	PrintServiceMethods::CreatePDFfromJobForceTemplate('Invoice Template',$IDs,24,$parameters,'PDF',$token, $server);
			    $results 	= 	PrintServiceMethods::CreatePDFfromJobForceTemplate('Invoice Template',$IDs,20,$parameters,'PDF',$token, $server);
			    $pdf		=	$result->URL."#".$results->URL;
			    echo $pdf; 
			    exit;
		   }
		   public function barcodeScane()
		   {
			   $this->layout = "index";
		   }
		   
		    /*
		    * function use for get search list after scanning the barcode
		    * 
		    * */
		   
		   public function getsearchlist()
		   {
			   $this->autoRender = false;
			   $this->layout = '';
			  
			   $this->loadModel('OpenOrder');
			  
			   $express1	=	array();
			   $express2	=	array();
			   $standerd1	=	array();
			   $standerd2	=	array();
			   $tracked1	=	array();
			   $tracked2	=	array();
			   
			   $barcode		=	 $this->request->data['barcode'];
			   
			   if($barcode)
			   {
				   $results	=	$this->OpenOrder->find('all', array('conditions' => array('OpenOrder.items REGEXP'=>'.*;s:[0-9]+:"'.$barcode.'".*', 'OpenOrder.status' => '0')));
			   }
			
			   $i = 0;
			   foreach($results as $result)
			   {
				   $itemdetails[$i]['Id']				=	$result['OpenOrder']['id'];
				   $itemdetails[$i]['OrderId']			=	$result['OpenOrder']['order_id'];
				   $itemdetails[$i]['NumOrderId']		=	$result['OpenOrder']['num_order_id'];
				   $itemdetails[$i]['GeneralInfo']		=	unserialize($result['OpenOrder']['general_info']);
				   $itemdetails[$i]['ShippingInfo']		=	unserialize($result['OpenOrder']['shipping_info']);
				   $itemdetails[$i]['CustomerInfo']		=	unserialize($result['OpenOrder']['customer_info']);
				   $itemdetails[$i]['TotalsInfo']		=	unserialize($result['OpenOrder']['totals_info']);
				   $itemdetails[$i]['FolderName']		=	unserialize($result['OpenOrder']['folder_name']);
				   $itemdetails[$i]['Items']			=	unserialize($result['OpenOrder']['items']);
				   $i++;
			   }
				
				
				if(isset($itemdetails))
				{
					$itemdetails	=	json_decode(json_encode($itemdetails), TRUE);
					$myArray = Set::sort($itemdetails, '{n}.GeneralInfo.ReceivedDate', 'ASC');
				
					foreach($myArray as $itemdetail)
					{
						if($itemdetail['ShippingInfo']['PostalServiceName'] == 'EXPRESS' && count($itemdetail['Items']) == 1)
						{
							$express1[]	=	$itemdetail;
						}
						if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Standard' && count($itemdetail['Items']) == 1)
						{
							$standerd1[]	=	$itemdetail;
						}
						if($itemdetail['ShippingInfo']['PostalServiceName'] == 'TRACKED' && count($itemdetail['Items']) == 1)
						{
							 $tracked1[] = $itemdetail;
						}
						if($itemdetail['ShippingInfo']['PostalServiceName'] == 'EXPRESS' && count($itemdetail['Items']) > 1)
						{
							$express2[]	=	$itemdetail;
						}
						if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Standard' && count($itemdetail['Items']) > 1)
						{
							$standerd2[]	=	$itemdetail;
						}
						if($itemdetail['ShippingInfo']['PostalServiceName'] == 'TRACKED' && count($itemdetail['Items']) > 1)
						{
							 $tracked2[] = $itemdetail;
						}
					}
				}
			   $this->set(compact('express1','standerd1','tracked1','express2','standerd2','tracked2'));
			   echo $this->render('scansearch');
			   exit;
		   }
		   
		   
		   
		   
		   
		   /* public function getsearchlist()
		   {
			   $this->autoRender = false;
			   $this->layout = '';
			   $express1	=	array();
				
			   $standerd1	=	array();
				
			   $tracked1	=	array();
				
			   
			   
			   $this->loadModel('Order');
			   $this->loadModel('Item');
			   
			   $barcode			=	 $this->request->data['barcode'];
			   $resultpopups	=	 $this->Order->find('all');
			   if($barcode)
			   {
				   $itemdetails	=	$this->Item->find('all',array('conditions'=>array('Item.barcode'=> $barcode), 'order'=>'Order.received_date ASC'));
			   }
			   $myArray = Set::sort($itemdetails, '{n}.Item.quantity', 'asc');
			   
			   foreach($myArray as $itemdetail)
			   {
				   $ids[] = $itemdetail['Item']['order_id'];
			   }
				if(isset($ids) && count($ids) > 0)
					{
					   foreach($ids as $id)
					   {
						   $orders	=	$this->Order->find('all',array('conditions'=>array('Order.id'=> $id,'Order.status'=>0)));
						   foreach($orders as $order)
						   {	
							   if($order['Order']['postal_service'] == 'Express')
							   {
								   $express1[]	=	$order;
							   }
							   if($order['Order']['postal_service'] == 'Standard')
							   {
								   $standerd1[]	=	$order;
							   }
							   if($order['Order']['postal_service'] == 'Tracked')
							   {
								   $tracked1[] = $order;
							   }
						   }
					}
				}
				else
				{
					
				}
			   
			   $this->set(compact('resultpopups','express1','standerd1','tracked1'));
			   echo $this->render('scansearch');
			   exit;
		   }*/
		   
		   
		   
		    public function dispatchConsole()
			{
				$this->layout = 'index';
			}
			
			/********************* function use for confirm barcode *********************************/
		   public function confirmBarcode( $id = null)
		   {
			   $this->layout='index';
			   $this->loadModel('OpenOrder');
			   $orderDI		=	$id;
			   $getOrderDeatils	=	$this->OpenOrder->find('first', array('conditions' => array('OpenOrder.num_order_id' => $id )));
			   
			   $data['Id']				=	$getOrderDeatils['OpenOrder']['id'];
			   $data['OrderId']			=	$getOrderDeatils['OpenOrder']['order_id'];
			   $data['NumOrderId']		=	$getOrderDeatils['OpenOrder']['num_order_id'];
			   $data['GeneralInfo']		=	unserialize($getOrderDeatils['OpenOrder']['general_info']);
			   $data['ShippingInfo']	=	unserialize($getOrderDeatils['OpenOrder']['shipping_info']);
			   $data['CustomerInfo'] 	=	unserialize($getOrderDeatils['OpenOrder']['customer_info']);
			   $data['FolderName']		=	unserialize($getOrderDeatils['OpenOrder']['folder_name']);
			   $data['Items']			=	unserialize($getOrderDeatils['OpenOrder']['items']);
			   $data['ScanningQty']		=	$getOrderDeatils['OpenOrder']['scanning_qty'];
			   $data['Status']			=	$getOrderDeatils['OpenOrder']['status'];
			   
			   $detail					=	json_decode(json_encode($data), TRUE);
			   $this->set(compact('detail'));
			   
		   }
		   /************************************************************************************************/
		   
		   
			
			
			/*public function confirmBarcode( $id = null)
		   {
			   $this->layout='index';
			   $this->loadModel('Order');
			   $orderDI		=	$id;
			   $getOrderDeatils	=	$this->Order->find('first', array('conditions' => array('Order.pk_order_id' => $id )));
			   $this->set(compact('getOrderDeatils', 'id'));
			   
		   }*/
		  /* public function completethebarcode()
		   {
			   $this->autorender = false;
			   $this->layout = '';
			   $this->loadModel('Item');
			   $barcode	=	 $this->request->data['barcode'];
			   $id		=	 	$this->request->data['pkorder'];
			   $itemQty		=	$this->Item->find('first', array('conditions' => array('Item.order_id' => $id, 'Item.barcode' => $barcode)));
			   
			   
			   
			   if($itemQty)
			   {
				   $itemid		=	 $itemQty['Item']['id'];
				   $qty			=	 $itemQty['Item']['quantity'];
				   $upqty		=	 $itemQty['Item']['updatequantity'];
				}
			   
			   if(isset($qty) && $qty > 0 && $qty > $upqty)
			   {
				   $upqty	=	$upqty+1;
				   $this->Item->updateAll( array( 'Item.updatequantity'=>$upqty), array( 'Item.order_id' => $id, 'Item.barcode' => $barcode ) );
				   $data['status'] = 1;
				   $data['msg'] = $upqty;
				   echo (json_encode(array('status' => '1', 'msg' => $upqty, 'id' => $itemid)));
				   exit;
				}
				else
				{
					echo "2";
					exit;
				}
			   
			   
		   }*/
		   
		   /**************************** Function use for confirm the barcode ******************************/
		   
		   public function completethebarcode()
		   {
			   $this->autorender = false;
			   $this->layout = '';
			   $this->loadModel('OpenOrder');
			   $barcode		=	 	$this->request->data['barcode'];
			   $id			=	 	$this->request->data['pkorder'];
			   
			   $itemQty		=	$this->OpenOrder->find('first', array('conditions' => array('OpenOrder.order_id' => $id, 'OpenOrder.items REGEXP'=>'.*;s:[0-9]+:"'.$barcode.'".*')));
			   $itemQty['OpenOrder']['scanning_qty'];
			   $items	=	unserialize($itemQty['OpenOrder']['items']);
			   $totalqty = 0;
			   foreach($items as $item)
			   {
				   $totalqty  = $totalqty + $item->Quantity;
			   }
			   
			   if($itemQty)
			   {
				  $upqty		=	 $itemQty['OpenOrder']['scanning_qty'];
			   }
			   
			   if($totalqty  != $upqty)
			   {
				   $upqty	=	$upqty+1;
				   $this->OpenOrder->updateAll( array( 'OpenOrder.scanning_qty'=>$upqty), array( 'OpenOrder.order_id' => $id, 'OpenOrder.items REGEXP'=>'.*;s:[0-9]+:"'.$barcode.'".*' ) );
				   $data['status'] = 1;
				   $data['msg'] = $upqty;
				   echo (json_encode(array('status' => '1', 'msg' => $upqty, 'id' => $id)));
				   exit;
				}
				else
				{
					echo "2";
					exit;
				}
		   }
		   /*********************************************************************************************/
		   
		   /************************** Function use for asign postal tracking ID*********************************/
		   public function asigntrackid()
		   {
			    $this->layout = '';
			    $this->autoRender = false;
			    $this->loadModel('Order');
				$this->loadModel('Item');
				App::import('Vendor', 'linnwork/api/Auth');
				App::import('Vendor', 'linnwork/api/Factory');
				App::import('Vendor', 'linnwork/api/Orders');
				App::import('Vendor', 'linnwork/api/PrintService');
			
				$username = Configure::read('linnwork_api_username');
				$password = Configure::read('linnwork_api_password');
				
				$multi = AuthMethods::Multilogin($username, $password);
				
				$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

				$token = $auth->Token;	
				$server = $auth->Server;
				
				$Postalservice		=	$this->request->data['postalservice'];
				$TrackingCode		=	$this->request->data['trackingBarcode'];
				
				$info['PostalServiceName'] 	= $Postalservice;
				$info['TrackingNumber'] 	= $TrackingCode;
				$info['ManualAdjust'] 		= true;
				$scanPerformed 	= 	true;
				$information	=	json_encode($info);
				
				$orderId		=	$this->request->data['pkorder'];
				
				$results		=	OrdersMethods::SetOrderShippingInfo($orderId, $info, $token, $server);
				
				
				if(isset($results->ShippingInfo->TrackingNumber))
				{
					
					$orderIdArray[]	=	$orderId;
				
					$IDs = $orderIdArray;
					$parameters = '[]';
			
					$result 	= 	PrintServiceMethods::CreatePDFfromJobForceTemplate('Invoice Template',$IDs,27,$parameters,'PDF',$token, $server);
					$results 	= 	PrintServiceMethods::CreatePDFfromJobForceTemplate('Invoice Template',$IDs,27,$parameters,'PDF',$token, $server);
					$pdf		=	$result->URL."#".$results->URL;
					echo $pdf;
					exit;
				}
				else
				{
					echo "2";
					exit;
				}
			   
		   }
		   /*****************************************************************************************************/
		   
		   
		    /*********************** function use for generate the label and slip pdf for print  ************************/
		   
		   public function generatepdf()
		   {
			    App::import('Vendor', 'linnwork/api/Auth');
				App::import('Vendor', 'linnwork/api/Factory');
				App::import('Vendor', 'linnwork/api/PrintService');
			
				$username = Configure::read('linnwork_api_username');
				$password = Configure::read('linnwork_api_password');
				
				$multi = AuthMethods::Multilogin($username, $password);
				
				$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

				$token = $auth->Token;	
				$server = $auth->Server;
				
				$orderIdArray[]	=	$this->request->data['pkorderid'];
				
				$IDs = $orderIdArray;
				$parameters = '[]';
			
			    $result 	= 	PrintServiceMethods::CreatePDFfromJobForceTemplate('Invoice Template',$IDs,27,$parameters,'PDF',$token, $server);
			    $results 	= 	PrintServiceMethods::CreatePDFfromJobForceTemplate('Invoice Template',$IDs,27,$parameters,'PDF',$token, $server);
			    $pdf		=	$result->URL."#".$results->URL;
			    if($result->URL && $result->URL)
			    {
						echo $pdf; 
						exit;
				}
				else
				{
						echo "2"; 
						exit;
				}
		   }
		   
		   /*******************************************************************************************************/
		   
		   
		   
		   
		  /* public function generatepdf()
		   {
			    App::import('Vendor', 'linnwork/api/Auth');
				App::import('Vendor', 'linnwork/api/Factory');
				App::import('Vendor', 'linnwork/api/PrintService');
			
				$username = Configure::read('linnwork_api_username');
				$password = Configure::read('linnwork_api_password');
				
				$multi = AuthMethods::Multilogin($username, $password);
				
				$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

				$token = $auth->Token;	
				$server = $auth->Server;
				
				$orderIdArray[]	=	$this->request->data['pkorderid'];
				$IDs = $orderIdArray;
				$parameters = '[]';
			
			    $result 	= 	PrintServiceMethods::CreatePDFfromJobForceTemplate('Invoice Template',$IDs,24,$parameters,'PDF',$token, $server);
			    $results 	= 	PrintServiceMethods::CreatePDFfromJobForceTemplate('Invoice Template',$IDs,20,$parameters,'PDF',$token, $server);
			    $pdf		=	$result->URL."#".$results->URL;
			    echo $pdf; 
			    exit;
		   }*/
		   
		   
		   /*************************************** function use for process open order ***********************/
		  /* public function processorder()
		   {
			   
				$this->loadModel('OpenOrder');
				App::import('Vendor', 'linnwork/api/Auth');
				App::import('Vendor', 'linnwork/api/Factory');
				App::import('Vendor', 'linnwork/api/Orders');
		
				$username	=	Configure::read('linnwork_api_username');
				$password	=	Configure::read('linnwork_api_password');
			
				$multi = AuthMethods::Multilogin($username, $password);
				$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

				$token 			= 	$auth->Token;	
				$server 		= 	$auth->Server;
				$scanPerformed 	= 	true;
				$orderId		=	$this->request->data['id'];
				$result = OrdersMethods::ProcessOrder($orderId,$scanPerformed,$token, $server);
				$this->OpenOrder->updateAll( array( 'OpenOrder.status'=>'1'), array( 'OpenOrder.order_id' => $orderId ) );
				
				if($result->Processed == 1)
				{
					echo "1";
					exit;
				}
				else
				{
					echo "2";
					exit;
				}
		   }*/
		   
		   
		   
		   /*public function processorder()
		   {
			   
				$this->loadModel('Order');
				App::import('Vendor', 'linnwork/api/Auth');
				App::import('Vendor', 'linnwork/api/Factory');
				App::import('Vendor', 'linnwork/api/Orders');
		
				$username	=	Configure::read('linnwork_api_username');
				$password	=	Configure::read('linnwork_api_password');
			
				$multi = AuthMethods::Multilogin($username, $password);
			
				$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

				$token 			= 	$auth->Token;	
				$server 		= 	$auth->Server;
				$scanPerformed 	= 	true;
				$orderId		=	$this->request->data['id'];
				$result = OrdersMethods::ProcessOrder($orderId,$scanPerformed,$token, $server);
				$this->Order->updateAll( array( 'Order.status'=>'1'), array( 'Order.pk_order_id' => $orderId ) );
				
				if($result->Processed == 1)
				{
					echo "1";
					$this->Session->setFlash('Order Precessed Successfully','flash_success');
					exit;
				}
				else
				{
					echo "2";
					$this->Session->setFlash('Some Error In Order Process','flash_danger');
					exit;
				}
				
				
		   }*/
		   
		   
		   public function saveopenorder()
		   {
			    $this->layout = '';
			    $this->autoRender = false;
			    $this->loadModel('Order');
				$this->loadModel('Item');
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
				
			
				$count = 0;
				foreach($results as $result)
				{
					$finddata	=	$this->Order->find('first', array('conditions' => array('Order.num_order_id' =>$result->NumOrderId)));
					if(empty($finddata))
					{
						$data['Order']['num_order_id']		=	$result->NumOrderId;
						$data['Order']['pk_order_id']		=	$result->OrderId;
						$data['Order']['total']				=	$result->TotalsInfo->TotalCharge;
						$data['Order']['postal_service']	=	$result->ShippingInfo->PostalServiceName;
						$data['Order']['customer_name']		=	$result->CustomerInfo->Address->FullName;
						$data['Order']['source']			=	$result->GeneralInfo->Source;
						
						$dateTime	=	explode('T', $result->GeneralInfo->ReceivedDate);
						$data['Order']['received_date']	=	$dateTime[0];
						
						
						$this->Order->saveAll($data);
						$order_id	=	$this->Order->getLastInsertID();

						
						foreach($result->Items as $Item)
						{

							$dataNew['Item']['order_id']	=	$order_id;
							$dataNew['Item']['sku']			=	$Item->SKU;
							$dataNew['Item']['barcode']		=	$Item->BarcodeNumber;
							$dataNew['Item']['quantity']	=	$Item->Quantity;
							$dataNew['Item']['title']	=	$Item->Title;
							$dataNew['Item']['priceperunit']	=	$Item->PricePerUnit;
							$dataNew['Item']['discount']	=	$Item->Discount;
							$dataNew['Item']['tax']	=	$Item->Tax;
							$dataNew['Item']['costinctax']	=	$Item->CostIncTax;
							$this->Item->saveAll($dataNew);

						}
						$count++;
					}
				}
				echo $count;
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
					 'ServiceCounter.service_code' => $serviceCode        
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
			return strtolower(str_replace('<','-',str_replace(' ','-',$serviceProvider.$serviceName.$serviceCode))); exit;
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
		   
		public function generatepdfdirect()
		{
				$id	=	$this->request->data['pkorderid'];
			
				$this->layout = '';
				$this->autoRender = false;
				
				require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 
				
				spl_autoload_register('DOMPDF_autoload'); 
				$dompdf = new DOMPDF();
				
				$dompdf->set_paper(array(0, 0, 394, 567), 'portrait');
				$this->loadModel( 'PackagingSlip' );
				
				$order	=	$this->getOpenOrderById( $id );
				
				$k = '10';
				$companyname = '';
				$returnaddress = '';
				switch ($k) {
								case 0:
									echo "";
									break;
								case 1:
									echo "";
									break;
								case 2:
									echo "";
									break;
								default:
								   $companyname 	 =  'Jij Group';
								   $returnaddress 	 =  'Address Line 1 <br> Address Line 2 <br>Some Town Some Region 123 ABC <br>United Country';
							}
				
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
				$barcode  			=   	$order['assign_barcode'];
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
							<td valign="top" class="noleftborder rightborder bottomborder">'.$i.'</td>
							<td valign="top" class="rightborder bottomborder">'.substr($item->Title, 0, 10 ).'</td>
							<td valign="top" class="center rightborder bottomborder">'.$item->Quantity.'</td>
							<td valign="top" class="right rightborder bottomborder">'.$item->PricePerUnit.'</td>
							<td valign="top" class="right bottomborder norightborder">'.$item->Quantity * $item->PricePerUnit.'</td>
							</tr>';
					$i++;
				}
				$totalitem = $i - 1;
				$setRepArray[]	=	 $str;
				$setRepArray[]	=	 $totalitem;
				$setRepArray[]	=	 $subtotal;
				$Path 			= 	'/wms/img/client/';
				$img			=	 '<img src=http://localhost/wms/img/client/demo.png height="50" width="50">';
				$setRepArray[]	=	 $img;
				$setRepArray[]	=	 $postagecost;
				$setRepArray[]	=	 $tax;
				$totalamount	=	 (float)$subtotal + (float)$postagecost + (float)$tax;
				$setRepArray[]	=	 $totalamount;
				$setRepArray[]	=	 $address;
				$barcodePath  	=  Router::url('/', true).'img/orders/barcode/';
				$barcodeimg 	=  '<img src='.$barcodePath.$barcode.' width = 180 height = 40 >';
				$barcodenum		=	explode('.', $barcode);
				
				$setRepArray[] 	=  $barcodeimg;
				$setRepArray[] 	=  $paymentmethod;
				$setRepArray[] 	=  $barcodenum[0];
				$setRepArray[] 	=  $companyname;
				$setRepArray[] 	=  $returnaddress;
				$setRepArray[] 	=  '<img src ='.$imgPath = Router::url('/', true) .'img/vitapure.png height = 50 >';
				
				
				$imgPath = WWW_ROOT .'css/';
				
							/*$html2 = '
							<body>
<div id="label">
<div class="container">
<table class="header row">
<tr>
<td>_LOGO_</td>
<td align="center">_BARCODE_<br>_BARCODENUMBER_
</td>
</tr>
</table>


<table class="cn22 row">
<tr>
<td class="leftside address" valign="top"><h4>Ship From:</h4>
<span class="bold">_COMPANYNAME_</span><br>
_RETURNADDRESS_
</td>

<td class="rightside address" valign="top"><h4>Ship To:</h4>
_ADDRESS1_ <br>
_ADDRESS_
</td>
</tr>
</table>
<div class="">

</div>
<table class="header row">
<tr>
<td class="leftside"><span class="bold">Order No.:</span> _ORDERNUMBER_

</td>
<td><span class="bold">Ship Via:</span> _COURIER_</td>
</tr>
<tr>
<td class="rightside">
<span class="bold">Payment Method:</span> _PAYMENTMETHOD_
</td>
<td><span class="bold">Order Date:</span> _RECIVEDATE_</td>
</tr>
</table>

<div class="tablesection row">
<table class="change_order_items" cellpadding="5px" cellspacing="0" style="border-collapse: collapse;">
<tr>
<th align="left" class="noleftborder rightborder bottomborder" width="15%">Item No.</th>
<th align="left" valign="top" width="40%" class="rightborder bottomborder">Description of contents</th>
<th valign="top" class="center rightborder bottomborder" width="15%">Qty</th>
<th valign="top" class="center rightborder bottomborder" width="15%">Price</th>
<th valign="top" class="center bottomborder norightborder" width="15%">Amount</th>
</tr>
_ORDERSUMMARY_
</table>
<table>
<tr>
<td class="otherinfo">
<div><span class="bold">Total Item Count:</span>_TOTALITEM_</div></td>
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
</div>

</body>';*/
				
				
				$html2 	=	$gethtml[0]['PackagingSlip']['html'];
				$html2 .= '<style>'.file_get_contents($imgPath.'pdfstyle.css').'</style>';
				$html 	= $this->setReplaceValue( $setRepArray, $html2 );
				
				
				
				$dompdf->load_html(utf8_decode($html), Configure::read('App.encoding'));
				$dompdf->render();
				$dompdf->stream("OrderId-$ordernumber.pdf");
				
				$imgPath = WWW_ROOT .'img/printPDF/'; 
				$path = Router::url('/', true).'img/printPDF/';
				$date = new DateTime();
				$timestamp = $date->getTimestamp();
				$name	=	'Packagin_Label_.'.$ordernumber.'.pdf';
				
				file_put_contents($imgPath.$name, $dompdf->output());
				$serverPath  	= 	$path.$name ;
				
				
				
				$sendData = array(
					'printerId' => '74830',
					'title' => 'Now Print',
					'contentType' => 'pdf_uri',
					'content' => $serverPath,
					'source' => 'Direct'
				);
				
				//App::import( 'Controller' , 'Coreprinters' );
				//$Coreprinter = new CoreprintersController();
				//$d = $Coreprinter->toPrint( $sendData );
				//pr($d); exit;
			
		}
		
		function setReplaceValue( $setRepArray, $htmlString )
		{
	
			$constArray = array();
			$constArray[] = '_ADDRESS1_';
			$constArray[] = '_ADDRESS2_';
			$constArray[] = '_ADDRESS3_';
			$constArray[] = '_TOWN_';
			$constArray[] = '_RESION_';
			$constArray[] = '_POSTCODE_';
			$constArray[] = '_COUNTRY_';
			$constArray[] = '_PHONE_';
			$constArray[] = '_ORDERNUMBER_';
			$constArray[] = '_COURIER_';
			$constArray[] = '_RECIVEDATE_';
			$constArray[] = '_ORDERSUMMARY_';
			$constArray[] = '_TOTALITEM_';
			$constArray[] = '_SUBTOTAL_';
			$constArray[] = '_IMAGE_';
			$constArray[] = '_POSTAGECOST_';
			$constArray[] = '_TAX_';
			$constArray[] = '_TOTALAMOUNT_';
			$constArray[] = '_ADDRESS_';
			$constArray[] = '_BARCODE_';
			$constArray[] = '_PAYMENTMETHOD_';
			$constArray[] = '_BARCODENUMBER_';
			$constArray[] = '_COMPANYNAME_';
			$constArray[] = '_RETURNADDRESS_';
			$constArray[] = '_LOGO_';
			
			
			$getRep = $htmlString;
			$getRep = str_replace( $constArray[0],$setRepArray[0],$getRep );
			$getRep = str_replace( $constArray[1],$setRepArray[1],$getRep );
			$getRep = str_replace( $constArray[2],$setRepArray[2],$getRep );
			$getRep = str_replace( $constArray[3],$setRepArray[3],$getRep );
			$getRep = str_replace( $constArray[4],$setRepArray[4],$getRep );
			$getRep = str_replace( $constArray[5],$setRepArray[5],$getRep );
			$getRep = str_replace( $constArray[6],$setRepArray[6],$getRep );
			$getRep = str_replace( $constArray[7],$setRepArray[7],$getRep );
			$getRep = str_replace( $constArray[8],$setRepArray[8],$getRep );
			$getRep = str_replace( $constArray[9],$setRepArray[9],$getRep );
			$getRep = str_replace( $constArray[10],$setRepArray[10],$getRep );
			$getRep = str_replace( $constArray[11],$setRepArray[11],$getRep );
			$getRep = str_replace( $constArray[12],$setRepArray[12],$getRep );
			$getRep = str_replace( $constArray[13],$setRepArray[13],$getRep );
			$getRep = str_replace( $constArray[14],$setRepArray[14],$getRep );
			$getRep = str_replace( $constArray[15],$setRepArray[15],$getRep );
			$getRep = str_replace( $constArray[16],$setRepArray[16],$getRep );
			$getRep = str_replace( $constArray[17],$setRepArray[17],$getRep );
			$getRep = str_replace( $constArray[18],$setRepArray[18],$getRep );
			$getRep = str_replace( $constArray[19],$setRepArray[19],$getRep );
			$getRep = str_replace( $constArray[20],$setRepArray[20],$getRep );
			$getRep = str_replace( $constArray[21],$setRepArray[21],$getRep );
			$getRep = str_replace( $constArray[22],$setRepArray[22],$getRep );
			$getRep = str_replace( $constArray[23],$setRepArray[23],$getRep );
			$getRep = str_replace( $constArray[24],$setRepArray[24],$getRep );
			return $getRep;
			
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
				$data['template_id']		=	 $order['OpenOrder']['template_id'];
				return $data;
				
			}
			
	   public function domeshipping( )
		{
			
				$this->layout = '';
				$this->autoRender = false;
				$this->loadModel('Template');
				$id	=	$this->request->data['pkorderid'];
				
				require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 
				
				spl_autoload_register('DOMPDF_autoload'); 
				$dompdf = new DOMPDF();
							
				$order	=	$this->getOpenOrderById( $id );
			
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
				$barcode  			=   	$order['assign_barcode'];
				$items				=	 	$order['items'];
				$templateId			=	 	$order['template_id'];
				
				
				$str = ''; 
				$totlaWeight	=	0;
				foreach($items as $item)
				{
					$str	.= '<tr>
							<td class="noleftborder rightborder bottomborder">'.$item->Quantity.' x '.substr($item->Title, 0, 15 ).'</td>
							<td valign="top" class="center rightborder bottomborder">'.$item->Weight.'</td>
							<td valign="top" class="center norightborder bottomborder">£'.$item->Quantity * $item->PricePerUnit.'</td>
							</tr>';
							$totlaWeight = $totlaWeight + $item->Weight;
				}
				
				
				$address			=		'';
				//$address			.=		($address2 != '') ? $address2.'<br>' : '' ; 
				$address			.=		($address3 != '') ? $address3.'<br>' : '' ;
				$address			.=		(isset($town)) ? $town.'<br>' : '';
				$address			.=		(isset($resion)) ? $resion.'<br>' : '';
				$address			.=		(isset($postcode)) ? $postcode.'<br>' : '';
				$address			.=		(isset($country)) ? $country.'<br>' : '';
											
				$recivedate			=	 	explode('T', $order['general_info']->ReceivedDate);
				
				$currentdate	=	 date("j, F  Y");
				
				$setRepArray = array();
				$setRepArray[] 					= $address1;
				$setRepArray[] 					= $address2;
				$setRepArray[] 					= $address3;
				$setRepArray[] 					= $town;
				$setRepArray[] 					= $resion;
				$setRepArray[] 					= $address;
				$setRepArray[] 					= $country;
				$barcode  			=   	$order['assign_barcode'];
				$barcodenum		=	explode('.', $barcode);
				$barcodePath  	=  Router::url('/', true).'img/orders/barcode/';
				$barcodeimg 	=  '<img src='.$barcodePath.$barcode.' width = 180 height = 40 >';
				$barcodenum		=	explode('.', $barcode);
				
				$setRepArray[] 	=    $barcodeimg;
				$setRepArray[] 	=    $barcodenum[0];
				$setRepArray[]	=	 $str;
				$setRepArray[]	=	 $totlaWeight;
				$setRepArray[]	=	 $tax;
				$setRepArray[]	=	 $currentdate;
				$logopath	=	Router::url('/', true).'img/';
				$setRepArray[]	=	 '<img src="'.$logopath.'logo.jpg" >';
				$logo			=	'<img src="'.$logopath.'logo.jpg" >';
				$signature		=	'<img src="'.$logopath.'sig.jpg" >';
				
				$setRepArray[]	=	 $logo;
				$setRepArray[]	=	 '';
				$setRepArray[]	=	 $signature;
				
				
				$dompdf->set_paper(array(0, 0, 377, 566), 'portrait');
				$cssPath = WWW_ROOT .'css/';
				$imgPath = Router::url('/', true) .'img/';
				
				
				
				/*$html 	= '<body>
<div id="label">
<div class="container">
<table class="header row">
<tr>
<td width="60%">_LOGO_</td>
<td width="40%" align="right">
<table class="jpoststamp "><tr>
<td class="stampnumber">1</td>
<td class="jerseyserial">Postage Paid<br>
Jersey<br>
Serial 216</td>
</tr>
<tr>
<td colspan="2" class="vatnumber">UK Import VAT Pre-Paid<br>
Auth No 393</td>
</tr>
</table>
</td>
</tr>
</table>

<div class="cn22 row">
<table>
<tr>
<td class="leftside leftheading"><h1>CUSTOMS DECLARATION</h1>
Great Britain
</td>
<td class="rightside rightheading"><h1>CN 22</h1>
May be opened officially
</td>
</tr>
</table>


<div class="fullwidth"><h2>Important!</h2></div>
<div class="producttype">
<table>
<tr>
<td><span>&nbsp;</span>Gift</td>
<td><span>&nbsp;</span>Documents</td>
<td><span>&nbsp;</span>Commercial</td>
<td><span>X</span>Merchandise</td>
</tr>
</table>

</div>

<table class="" cellpadding="5px" cellspacing="0" style="border-collapse:collapse" width="100%">
<tr>
<th class="noleftborder topborder rightborder bottomborder" width="60%">Quantity and detailed description of contents</th>
<th valign="top" class="center topborder rightborder bottomborder " width="20%">Weight (kg)</th>
<th valign="top" class="center topborder norightborder bottomborder" width="20%">Value</th>
</tr>
_ORDERDETAIL_
<tr>
<td valign="top" class="noleftborder rightborder bottomborder"></td>
<td valign="top " class="rightborder bottomborder">
<table>
<tr><td class="center">P & P<br>VAT</td></tr>
</table></td>
<td valign="top " class="norightborder bottomborder">
<table>
<tr><td class="center">£ 0<br>£_TAX_</td></tr>
</table>
</td>
</tr>
<tr>
<td valign="top" height="auto" class="noleftborder bottomborder rightborder">
<table height="100%">
<tr><td><span class="bold">For commercial items only</span><br>If known, HS tariff number and country of origin of goods</td></tr>
<tr><td class="center">876534</td></tr>
</table></td>
<td valign="top" height="auto" class="bottomborder rightborder">
<table height="100%" >
<tr><td class="center bold">Total Weight (kg)</td></tr>
<tr><td class="center">175.00</td></tr>
</table></td>
<td valign="top" height="auto"  class="norightborder bottomborder">
<table height="100%">
<tr><td class="center bold">Total Value</td></tr>
<tr><td class="center">£101.98</td></tr>
</table></td>
</tr>
</table>
<div class="fullwidth"><p>I the undersigned, whose name and address are given on the item, certify that the particulars given in this declaration are correct and that this item does not contain any dangerous article or articles prohibited by legislation or by postal or customs regulations.</p>
<table>
<tr>
<td class="date bold">Date: _CURRENTDATE_</td>
<td class="sign right">_SIGNATURE_</td>
</tr>
</table>
</div>
</div>
<div class="footer row">

<table>
<tr>
<td class="leftside leftheading address"><h3>SHIP TO:</h3>
<span class="bold">_ADDRESS1_</span><br>
_ADDRESS_
United Country<br>
</td>
<td class="rightside rightheading leftborder">
<div class="tracking bottomborder"><h3>TRACKING #:</h3>
1Z A90 26X 03 9015 6318
</div>
<div class="barcode center">Purchase Order<div>_BARCODEIMAGE_</div>_BARCODENUMBER_</div>
</td>
</tr>
</table>
</div>
<div class="footer row"><span class="bold">If undelivered please return to:</span> Unit 4, Cargo Centre, Jersey Airport, L’Avenue de la Commune, St Peter, JE3 7BY</div>

</div>
</div>

</body>';*/
							
				$htmlcontent =	$this->Template->find('first', array('conditions' => array('Template.id' => $templateId )));
				
				$html 	=	$htmlcontent['Template']['html'];
				$html .= '<style>'.file_get_contents($cssPath.'pdfstyle.css').'</style>';
				$html 	= $this->setReplaceValueLabel( $setRepArray, $html );
				
				//echo $html; 
				$dompdf->load_html(utf8_decode($html), Configure::read('App.encoding'));
				$dompdf->render();
				$dompdf->stream("OrderIdslip-$ordernumber.pdf");
				
				$imgPath = WWW_ROOT .'img/printPDF/'; 
				$path = Router::url('/', true).'img/printPDF/';
				$date = new DateTime();
				$timestamp = $date->getTimestamp();
				$name	=	'Packagin_Slip_'.$ordernumber.'.pdf';
				
				file_put_contents($imgPath.$name, $dompdf->output());
				$serverPath  	= 	$path.$name ;
				
				
				
				$sendData = array(
					'printerId' => '74828',
					'title' => 'Now Print',
					'contentType' => 'pdf_uri',
					'content' => $serverPath,
					'source' => 'Direct'
				);
				
				
				//App::import( 'Controller' , 'Coreprinters' );
				//$Coreprinter = new CoreprintersController();
				//$d = $Coreprinter->toPrint( $sendData );
				//pr($d); exit;
		}
		
		function setReplaceValueLabel( $setRepArray, $htmlString )
		{
	
			$constArray = array();
			$constArray[] = '_ADDRESS1_';
			$constArray[] = '_ADDRESS2_';
			$constArray[] = '_ADDRESS3_';
			$constArray[] = '_TOWN_';
			$constArray[] = '_RESION_';
			$constArray[] = '_ADDRESS_';
			$constArray[] = '_COUNTRY_';
			$constArray[] = '_BARCODEIMAGE_';
			$constArray[] = '_BARCODENUMBER_';
			$constArray[] = '_ORDERDETAIL_';
			$constArray[] = '_TAX_';
			$constArray[] = '_DATE_';
			$constArray[] = '_CURRENTDATE_';
			$constArray[] = '_LOGO_';
			$constArray[] = '';
			$constArray[] = '_SIGNATURE_';
			
			
			$getRep = $htmlString;
			$getRep = str_replace( $constArray[0],$setRepArray[0],$getRep );
			$getRep = str_replace( $constArray[1],$setRepArray[1],$getRep );
			$getRep = str_replace( $constArray[2],$setRepArray[2],$getRep );
			$getRep = str_replace( $constArray[3],$setRepArray[3],$getRep );
			$getRep = str_replace( $constArray[4],$setRepArray[4],$getRep );
			$getRep = str_replace( $constArray[5],$setRepArray[5],$getRep );
			$getRep = str_replace( $constArray[6],$setRepArray[6],$getRep );
			$getRep = str_replace( $constArray[7],$setRepArray[7],$getRep );
			$getRep = str_replace( $constArray[8],$setRepArray[8],$getRep );
			$getRep = str_replace( $constArray[9],$setRepArray[9],$getRep );
			$getRep = str_replace( $constArray[10],$setRepArray[10],$getRep );
			$getRep = str_replace( $constArray[11],$setRepArray[11],$getRep );
			$getRep = str_replace( $constArray[12],$setRepArray[12],$getRep );
			$getRep = str_replace( $constArray[13],$setRepArray[13],$getRep );
			$getRep = str_replace( $constArray[14],$setRepArray[14],$getRep );
			$getRep = str_replace( $constArray[15],$setRepArray[15],$getRep );
			return $getRep;
			
		}
		
		public function processorder()
		{
			$id =  $this->request->data['id'];
			$userid =  $this->request->data['userID'];
			$this->loadModel('OpenOrder');
			$result	=	$this->OpenOrder->updateAll(array('OpenOrder.status' => '1', 'OpenOrder.user_id' => $userid), array('OpenOrder.num_order_id' => $id));
			if($result)
			{
				echo "1";
				exit;
			}
			else
			{
				echo "2";
				exit;
			}
		}
}
?>
