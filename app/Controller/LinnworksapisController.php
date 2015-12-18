<?php

ini_set( 'memory_limit' , '2048M' );
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
				/* start for pick list */
				$this->loadModel( 'OpenOrder' );
				$this->loadModel( 'OrderItem' );
				$this->loadModel( 'Product' );
				$orderItems 	=	$this->OrderItem->find('all', array('conditions' => array('OrderItem.update_quantity' => '0')));
								
				foreach($orderItems as $k => $v) {
					$id = $v['OrderItem']['sku'];
					$result[$id][] = $v['OrderItem']['quantity'];
				}

				$new = array();
				foreach($result as $key => $value) {
					$new[] = array('sku' => $key, 'quanity' => array_sum($value));
				}
				/* dome pdf vendor */
				require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 
				spl_autoload_register('DOMPDF_autoload'); 
				$dompdf = new DOMPDF();
				$dompdf->set_paper('A4', 'portrait');
				/* Html for print pick list */
				$date = date("m/d/Y");
				$j=0;
				foreach($new as $sku)
					{
						$j = $j+$sku['quanity'];
					}
					
				$html = '<h2>PickList :- '.$date.'</h2><hr><h2>Total SKU  : - '.$j.'</h2>
						<table border="1" width="100%" >
						<tr>
						<th width="5%" align="center">S.No</th>
						<th width="25%" align="center">SKU</th>
						<th width="60%" align="center">Qty / Item Title</th>
						<th width="25%" align="center">Barcode</th>
						</tr>';
				$i = 1; 
				foreach($new as $sku)
					{
						$product	=	$this->Product->find('first', array('conditions' => array('Product.product_sku' => $sku['sku'])));
						if(count($product) > 0)
						{
							$title		=	$product['Product']['product_name'];
							$barcode	=	$product['ProductDesc']['barcode'];
						}
						else
						{
							$title		=	"Please check inventory";
							$barcode	=	"Please check inventory";
						}
							$html.=	'<tr>
									<td align="center">'.$i.'</td>
									<td>'.$sku['sku'].'</td>
									<td align="left"><b>'.$sku['quanity'] .'</b> X '.substr($title, 0, 40 ).'</td>
									<td>'.$barcode.'</td>
									</tr>';
							$i++;
					}
				$html .= '</table>';
				$dompdf->load_html(utf8_decode($html), Configure::read('App.encoding'));
				$dompdf->render();
				$dompdf->stream("PickList(".$date.").pdf");
				
		}
	
		public function getOpenOrder()
		{
			/* for view of only order */
			$this->layout = 'index';
			$this->loadModel('Order');
			$this->loadModel('Item');
		
			$this->loadModel( 'OpenOrder' );
			$getdetails	=	$this->OpenOrder->find('all', array('conditions' => array('OpenOrder.status' => '0')));
			
			$hiddenArray = array();
			
			$i = 0;
			foreach($getdetails as $getdetail)
			{
				
				$id 			= $getdetail['OpenOrder']['num_order_id'];								
				$itemDetails	=	$this->getAllOrderItem( $id );						
				if( count($itemDetails) > 0 )									
				{
					$results[$i]['NumOrderId']		=	 $getdetail['OpenOrder']['num_order_id'];
					$results[$i]['OrderId']			=	 $getdetail['OpenOrder']['order_id'];
					$results[$i]['Items'] =	$itemDetails;				
					$results[$i]['GeneralInfo']		=	 unserialize($getdetail['OpenOrder']['general_info']);
					$results[$i]['ShippingInfo']	=	 unserialize($getdetail['OpenOrder']['shipping_info']);
					$results[$i]['CustomerInfo']	=	 unserialize($getdetail['OpenOrder']['customer_info']);
					$results[$i]['TotalsInfo']		=	 unserialize($getdetail['OpenOrder']['totals_info']);
					$results[$i]['FolderName']		=	 unserialize($getdetail['OpenOrder']['folder_name']);
					//$results[$i]['Items']			=	 unserialize($getdetail['OpenOrder']['items']);
				}
				else
				{
					$hiddenArray[] = $id;
				}				
			$i++;
			}
			
			$getFirstCounter = count($results);
			//Get Now Bundles order which have been split already inside and store
			$et = 0;while( $et <= count($hiddenArray)-1 )
			{
				$bundleId 			= 	$hiddenArray[$et];								
				$bundleDetails		=	$this->getBundleOrderList( $bundleId );
				
				$bundleCounter = $getFirstCounter;$s = 0;foreach( $bundleDetails as $bundleDetailsIndex => $bundleDetailsValue )
				{
					
					$setData['OrderItem'] = $bundleDetailsValue;				
					//Get Order details now
					$getdetails	=	$this->OpenOrder->find('all', array('conditions' => array('OpenOrder.status' => '0' , 'OpenOrder.num_order_id' => $bundleId)));
					
					//Loop for adding orders in list					
					$results[$bundleCounter]['NumOrderId']		=	 $bundleDetailsValue['OrderItem']['order_id'];
					$results[$bundleCounter]['OrderId']			=	 $getdetails[0]['OpenOrder']['order_id'];
					
					$results[$bundleCounter]['Items'] =	$setData;
					
					$results[$bundleCounter]['GeneralInfo']		=	 unserialize($getdetails[0]['OpenOrder']['general_info']);
					$results[$bundleCounter]['ShippingInfo']	=	 unserialize($getdetails[0]['OpenOrder']['shipping_info']);
					$results[$bundleCounter]['CustomerInfo']	=	 unserialize($getdetails[0]['OpenOrder']['customer_info']);
					$results[$bundleCounter]['TotalsInfo']		=	 unserialize($getdetails[0]['OpenOrder']['totals_info']);
					$results[$bundleCounter]['FolderName']		=	 unserialize($getdetails[0]['OpenOrder']['folder_name']);
					//$results[$i]['Items']			=	 unserialize($getdetail['OpenOrder']['items']);
					
				$s++;$bundleCounter++;	
				}
				
			$et++;
			}
			
			if( isset($results)  )
			{
				$results	=	json_decode(json_encode($results),0);
				$this->set('results', $results);
			}
			
			/* code send for save order short detail in data base*/			
			$express1	=	array();
			$express2	=	array();
			$standerd1	=	array();
			$standerd2	=	array();
			$tracked1	=	array();
			$tracked2	=	array();
				
			if( isset($results) )
			 {
				foreach($results as $data)
				{
					if( isset($data->ShippingInfo->PostalServiceName) &&  $data->ShippingInfo->PostalServiceName == 'Express' && count($data->Items) == 1 )
					{
						$express1[]	=	$data;
					}
					else if( isset($data->ShippingInfo->PostalServiceName) &&  $data->ShippingInfo->PostalServiceName == 'Express' && count($data->Items) > 1 )
					{
						$express2[]	=	$data ;
					}
					if( isset($data->ShippingInfo->PostalServiceName) && ( $data->ShippingInfo->PostalServiceName == 'Standard' || $data->ShippingInfo->PostalServiceName == 'Default') && count($data->Items) == 1 )
					{
						$standerd1[]	=	 $data;
					}
					else if( isset($data->ShippingInfo->PostalServiceName) && ($data->ShippingInfo->PostalServiceName == 'Standard' || $data->ShippingInfo->PostalServiceName == 'Default' ) && count($data->Items) > 1 )
					{
						$standerd2[]	=	 $data;
					}
					if( isset($data->ShippingInfo->PostalServiceName) && $data->ShippingInfo->PostalServiceName == 'Tracked' && count($data->Items) == 1 )
					{
						$tracked1[]	=	 $data;
					}
					else if( isset($data->ShippingInfo->PostalServiceName) && $data->ShippingInfo->PostalServiceName == 'Tracked' && count($data->Items) > 1 )
					{
						$tracked2[]	=	 $data;
					}
				}
				
			}			
		$this->set(compact('express1','express2','standerd1','standerd2','tracked1','tracked2'));
		}
		
		public function getBundleOrderList( $bundleId = null )
		{
			
			$this->loadModel( 'OrderItem' );
			//$orderItem	=	$this->OrderItem->find('all', array('conditions' => array('OrderItem.order_id' => $id) , 'group' => array( 'OrderItem.sku' )));			 			 
			$orderItem	=	$this->OrderItem->find('all', array('conditions' => array('OrderItem.product_order_id_identify' => $bundleId)));			 			 			 
		 return $orderItem;	 
			
		}
		public function getOrderDetail( $id=null )
		{
			$this->layout = 'index';
			$this->loadModel( 'OpenOrder' );
			$getdetails	=	$this->OpenOrder->find('first', array('conditions' => array('OpenOrder.num_order_id' => $id)));
			$itemDetails	=	$this->getAllOrderItem( $id );
			
			$data['OrderId']		=	$getdetails['OpenOrder']['order_id'];
			$data['NumOrderId']		=	$getdetails['OpenOrder']['num_order_id'];
			$data['GeneralInfo']	=	unserialize($getdetails['OpenOrder']['general_info']);
			$data['ShippingInfo']	=	unserialize($getdetails['OpenOrder']['shipping_info']);
			$data['CustomerInfo']	=	unserialize($getdetails['OpenOrder']['customer_info']);
			$data['TotalsInfo']		=	unserialize($getdetails['OpenOrder']['totals_info']);
			$data['FolderName']		=	unserialize($getdetails['OpenOrder']['folder_name']);
			$data['Items']			=	$itemDetails;//unserialize($getdetails['OpenOrder']['items']);
	
			$getDetail				=	json_decode(json_encode($data));
			$this->set('getDetail', $getDetail);
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
			   $this->loadModel('OrderItem');
			  
			   $express1	=	array();
			   $express2	=	array();
			   $standerd1	=	array();
			   $standerd2	=	array();
			   $tracked1	=	array();
			   $tracked2	=	array();
			   
			   $barcode		=	 $this->request->data['barcode'];
			   
			   /*if($barcode)
			   {
				   $results	=	$this->OpenOrder->find('all', array('conditions' => array('OpenOrder.items REGEXP'=>'.*;s:[0-9]+:"'.$barcode.'".*', 'OpenOrder.status' => '0')));
			   }*/
			   
			   if($barcode)
			   {
				   $getItems	=	$this->OrderItem->find('all', array('conditions' =>array('OrderItem.barcode' => $barcode)));
				   
				   foreach( $getItems as $getItem )
				   {
						$orderId[]	=	 $getItem['OrderItem']['order_id'];
						
				   }
				   if(isset($orderId))
						$results	=	$this->OpenOrder->find('all', array('conditions' => array('OpenOrder.num_order_id'=> $orderId, 'OpenOrder.status' => '0')));
			   }
			  
			   $i = 0;
			   if( isset($results) && count( $results ) > 0 )
			   {
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
			   }
				
				
				if(isset($itemdetails))
				{
					$itemdetails	=	json_decode(json_encode($itemdetails), TRUE);
					$myArray = Set::sort($itemdetails, '{n}.GeneralInfo.ReceivedDate', 'ASC');
				
					foreach($myArray as $itemdetail)
					{
						if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Express' && count($itemdetail['Items']) == 1)
						{
							$express1[]	=	$itemdetail;
						}
						if(($itemdetail['ShippingInfo']['PostalServiceName'] == 'Default' || $itemdetail['ShippingInfo']['PostalServiceName'] == 'Standard') && count($itemdetail['Items']) == 1)
						{
							$standerd1[]	=	$itemdetail;
						}
						if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Tracked' && count($itemdetail['Items']) == 1)
						{
							 $tracked1[] = $itemdetail;
						}
						if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Express' && count($itemdetail['Items']) > 1)
						{
							$express2[]	=	$itemdetail;
						}
						if(($itemdetail['ShippingInfo']['PostalServiceName'] == 'Default' || $itemdetail['ShippingInfo']['PostalServiceName'] == 'Standard') && count($itemdetail['Items']) > 1)
						{
							$standerd2[]	=	$itemdetail;
						}
						if($itemdetail['ShippingInfo']['PostalServiceName'] == 'Tracked' && count($itemdetail['Items']) > 1)
						{
							 $tracked2[] = $itemdetail;
						}
					}
				}
			   $this->set(compact('express1','standerd1','tracked1','express2','standerd2','tracked2'));
			   echo $this->render('scansearch');
			   exit;
		   }
		   
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
			   $itemDetails	=	$this->getAllOrderItem( $id );
			  
			   $data['Id']				=	$getOrderDeatils['OpenOrder']['id'];
			   $data['OrderId']			=	$getOrderDeatils['OpenOrder']['order_id'];
			   $data['NumOrderId']		=	$getOrderDeatils['OpenOrder']['num_order_id'];
			   $data['GeneralInfo']		=	unserialize($getOrderDeatils['OpenOrder']['general_info']);
			   $data['ShippingInfo']	=	unserialize($getOrderDeatils['OpenOrder']['shipping_info']);
			   $data['CustomerInfo'] 	=	unserialize($getOrderDeatils['OpenOrder']['customer_info']);
			   $data['FolderName']		=	unserialize($getOrderDeatils['OpenOrder']['folder_name']);
			   //$data['Items']			=	unserialize($getOrderDeatils['OpenOrder']['items']);
			   $data['Items']			=	$itemDetails;
			   $data['ScanningQty']		=	$getOrderDeatils['OpenOrder']['scanning_qty'];
			   $data['Status']			=	$getOrderDeatils['OpenOrder']['status'];
			   
			   $detail					=	json_decode(json_encode($data), TRUE);
			   $this->set(compact('detail', 'itemDetails'));
			   
		   }
		   
		   public function completethebarcode()
		   {
			   $this->autorender = false;
			   $this->layout = '';
			   $this->loadModel('OpenOrder');
			   $this->loadModel('OrderItem');
			    $this->loadModel('Product');
			   $barcode		=	 	$this->request->data['barcode'];
			   $id			=	 	$this->request->data['pkorder'];
			   
			   $quantity	=	$this->OrderItem->find('all', array('conditions' => array('OrderItem.order_id' => $id, 'OrderItem.barcode' => $barcode)));
				
				$itemID		=	$quantity[0]['OrderItem']['id'];
				$totalqty	=	$quantity[0]['OrderItem']['quantity'];
				$upqty		=	$quantity[0]['OrderItem']['update_quantity'];
				$sku		=	$quantity[0]['OrderItem']['sku'];
				$lockqty = 0;
			   
			   if($totalqty  != $upqty)
			   {
				   $upqty	=	$upqty+1;
				   $this->OrderItem->updateAll( array( 'OrderItem.update_quantity'=>$upqty), array( 'OrderItem.id' => $itemID) );
				   $detail	=	$this->Product->find('first', array('conditions' => array('Product.product_sku' => $sku)));
				   $detail['Product']['lock_qty']	=	$detail['Product']['lock_qty'] - 1;
				   $this->Product->updateAll( array( 'Product.lock_qty'=>$detail['Product']['lock_qty']), array( 'Product.product_sku' => $sku) );
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
		   
		   public function getQuantity( $orderId = null, $barcode = null)
		   {
			   $this->loadMOdel( 'OrderItem' );
			   $itemdetails	=	$this->OrderItem->find('first', array('conditions' => array('OrderItem.order_id' => $orderId, 'OrderItem.barcode' => $barcode)));
			   return $itemdetails['OrderItem']['update_quantity'];
			   
		   }
		   
		   /************************** Function use for asign postal tracking ID*********************************/
		   public function asigntrackid()
		   {
			    $this->layout = '';
			    $this->autoRender = false;
			    $this->loadModel('Order');
			    $this->loadModel('OpenOrder');
				$this->loadModel('Item');
				
				$TrackingCode		=	$this->request->data['trackingBarcode'];
				$orderId		=	$this->request->data['pkorder'];
				$result	=	$this->OpenOrder->updateAll( array( 'OpenOrder.track_id'=>$TrackingCode), array( 'OpenOrder.num_order_id' => $orderId ) );
				if(isset($result))
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
			return strtolower(str_replace(')','-',str_replace('(','-',str_replace('<','-',str_replace(' ','-',$serviceProvider.$serviceName.$serviceCode.$country)))));exit;
			}
			else
			{
				//Response Blank         
				echo "none"; exit;
			}
		}  
		   
		public function generatepdfdirect()
		{
			
				$id	=	$this->request->data['pkorderid'];
			
				$this->layout = '';
				$this->autoRender = false;
				
				require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 
				
				spl_autoload_register('DOMPDF_autoload'); 
				$dompdf = new DOMPDF();
				
				$dompdf->set_paper(array(0, 0, 245, 450), 'portrait');
				
				//$dompdf->set_paper( $dompdf->customSize['roll'] , 'portrait');
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
				$barcodeimg 	=  '<img src='.$barcodePath.$barcode.'>';
				$barcodenum		=	explode('.', $barcode);
				
				$setRepArray[] 	=  $barcodeimg;
				$setRepArray[] 	=  $paymentmethod;
				$setRepArray[] 	=  $barcodenum[0];
				$setRepArray[] 	=  $companyname;
				$setRepArray[] 	=  $returnaddress;
				$setRepArray[] 	=  '<img src ='.$imgPath = Router::url('/', true) .'img/vitapure.png height = 36 >';
				
				
				$imgPath = WWW_ROOT .'css/';
								
								
											/*$html2 = '
											<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
					<meta content="" name="description"/>
					<meta content="" name="author"/>
											<body>
				<div id="label" style="width:245px">
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
				<table class="change_order_items" cellpadding="0px" cellspacing="0" style="border-collapse: collapse;">
				<tr>
				<th align="left" class="noleftborder rightborder bottomborder" width="15%">Item No.</th>
				<th align="left" valign="top" width="35%" class="rightborder bottomborder">Description of contents</th>
				<th valign="top" class="center rightborder bottomborder" width="15%">Qty</th>
				<th valign="top" class="center rightborder bottomborder" width="15%">Price</th>
				<th valign="top" class="center bottomborder norightborder" width="20%">Amount</th>
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
				//echo $html;
				//exit;
				
				
				$dompdf->load_html(utf8_decode($html), Configure::read('App.encoding'));
				$dompdf->render();
				$dompdf->stream("OrderId-$ordernumber.pdf");
				
				$imgPath = WWW_ROOT .'img/printPDF/'; 
				$path = Router::url('/', true).'img/printPDF/';
				$date = new DateTime();
				$timestamp = $date->getTimestamp();
				$name	=	'Packagin_Slip_'.$ordernumber.'.pdf';
				
				file_put_contents($imgPath.$name, $dompdf->output());
				$serverPath  	= 	$path.$name ;
				//$serverPath  	= 	$path.'Packagin1.pdf' ;

				
				
				/*$sendData = array(
					'printerId' => '77374',
					'title' => 'Now Print',
					'contentType' => 'pdf_uri',
					'content' => $serverPath,
					'source' => 'Direct'					
				);
				
				App::import( 'Controller' , 'Coreprinters' );
				$Coreprinter = new CoreprintersController();
				$d = $Coreprinter->toPrint( $sendData );
				pr($d); exit;*/
			
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
			public function domeshippingnew()
			{
				$this->layout = '';
				$this->autoRender = false;
				$this->loadModel('Template');
				$id	=	$this->request->data['pkorderid'];
				
				require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 
				
				spl_autoload_register('DOMPDF_autoload'); 
				$dompdf = new DOMPDF();
							
				$order	=	$this->getOpenOrderById( $id );
				//pr($order);
				$postalservices	=	$order['shipping_info']->PostalServiceName;
				$destination		=	$order['customer_info']->Address->Country;
				$total				=	$order['totals_info']->TotalCharge;
				$countries	=	array('Austria','Belgium', 'Bulgaria', 'Croatia', 'Cyprus', 'Czech Republic',
				'Denmark', 'Estonia', 'Finland', 'Germany', 'Greece', 'Hungary', 'Ireland', 'Italy', 'Latvia',
				'Lithuania', 'Luxembourg', 'Malta', 'Netherlands', 'Netherlands', 'Poland', 'Portugal', 'Romania',
				'Netherlands', 'Poland', 'Portugal', 'Romania', 'Slovakia', 'Slovenia', 'Spain', 'Sweden', 'United Kingdom'
				);
				
				
				
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
				$barcode  						= $order['assign_barcode'];
				$barcodenum						= explode('.', $barcode);
				$barcodePath  					= Router::url('/', true).'img/orders/barcode/';
				$barcodeimg 					= '<img src='.$barcodePath.$barcode.'  width = 250>';
				$barcodenum						= explode('.', $barcode);
				
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
				
				
				$dompdf->set_paper(array(0, 0, 280, 500), 'landscape');//landscape//portrait 
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
$html = '<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/><body>
       <div id="label">
       <div class="container">
       <div class="header row">
       </div>
       <table class="footer row" style="padding:20px 0;">
       <tr>
       <td class="leftside leftheading address" style="padding:20px 0;"><h4>SHIP TO:</h4>
       <span class="bold">_ADDRESS1_</span><br>
       _ADDRESS_
       </td>
       <td class="rightside rightheading leftborder">
       <div class="countrycode"><h3>GB</h3>
       </div>
       <div class="barcode center"><div>_BARCODEIMAGE_</div>_BARCODENUMBER_</div>
       </td>
       </tr>
       </table>

       <div class="footer row" style="padding:55px 0; text-align: center;"><span class="bold">If undelivered please return to:</span> Unit 4, Cargo Centre, Jersey Airport, <br>L\'Avenue de la Commune, St Peter, JE3 7BY</div>

       </div>
       </div>
       </body>';
							
				//$htmlcontent =	$this->Template->find('first', array('conditions' => array('Template.id' => $templateId )));
				
				//$html 	=	$htmlcontent['Template']['html'];
				$html .= '<style>'.file_get_contents($cssPath.'pdfstyle.css').'</style>';
				$html 	= $this->setReplaceValueLabel( $setRepArray, $html );
				
				$dompdf->load_html(utf8_decode($html), Configure::read('App.encoding'));
				$dompdf->render();
				$dompdf->stream("OrderIdslip-$ordernumber.pdf");
				
				$imgPath = WWW_ROOT .'img/printPDF/'; 
				$path = Router::url('/', true).'img/printPDF/';
				$date = new DateTime();
				$timestamp = $date->getTimestamp();
				$name	=	'Packagin_Label_'.$ordernumber.'.pdf';
				
				file_put_contents($imgPath.$name, $dompdf->output());
				$serverPath  	= 	$path.$name ;
				
				
				
				/*$sendData = array(
					'printerId' => '74828',
					'title' => 'Now Print',
					'contentType' => 'pdf_uri',
					'content' => $serverPath,
					'source' => 'Direct'
				);
				
				App::import( 'Controller' , 'Coreprinters' );
				$Coreprinter = new CoreprintersController();
				$d = $Coreprinter->toPrint( $sendData );
				pr($d); exit;*/
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
			$this->loadModel('Product');
			$this->loadModel('OpenOrder');
			
			$id =  $this->request->data['id'];
			$userid =  $this->request->data['userID'];
			
			//$result	=	$this->OpenOrder->updateAll(array('OpenOrder.status' => '1', 'OpenOrder.user_id' => $userid), array('OpenOrder.num_order_id' => $id));
			/* get the unserialize openorder detail  */
			$order	=	$this->getOpenOrderById( $id );
			
			if(count($order['items']) == 1)
			{
				$total = 0;
				foreach($order['items'] as $item)
				{
					$quantity		=	 $item->Quantity;
					$sku			=	 $item->SKU;
					$productDetail	=	$this->getProductDetail( $sku );
					$productId		=	$productDetail['Product']['id'];
					$updatedquantity	=	$productDetail['Product']['current_stock_level'] - $quantity;
					
					$total 	=	$quantity + $productDetail['Product']['total_sold'];
					if($productDetail['ProductDesc']['product_type'] == 'Single')
					{
						/* increase the total quantity for record */
						$this->Product->updateAll(array('Product.total_sold' => $total, 'Product.current_stock_level' => $updatedquantity  ), array('Product.id' => $productId));
					}
					else
					{
						
					}
				}
			}
			/* update the status after process */
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
		public function getProductDetail( $sku =null )
		{
			$productDetail	=	$this->Product->find('first', array('conditions' => array('Product.product_sku' => $sku)));
			return $productDetail;
		}
		
		 public function ShowCustomers()
		 {
				$this->layout = 'index';
				$this->loadModel('Customer');
				$customers	=	$this->Customer->find('all');
				$this->set( 'customers' , $customers);
		 }
		 public function checkInventery( $sku = null )
		 {
			 $this->layout = '';
			 $this->autoRender = false;
			 $this->loadModel('Product');
			 $checkinventery	=	$this->Product->find('first', array('conditions' => array('Product.product_sku' => $sku )));
			 if(!empty($checkinventery) )
			 {
				 return '1';
			 }
			 else
			 {
				 return '2';
			 }
		 }
		  public function getAllOrderItem( $id = null )
		 {
			 $this->loadModel( 'OrderItem' );
			 //$orderItem	=	$this->OrderItem->find('all', array('conditions' => array('OrderItem.order_id' => $id) , 'group' => array( 'OrderItem.sku' )));			 			 
			 $orderItem	=	$this->OrderItem->find('all', array('conditions' => array('OrderItem.order_id' => $id)));			 			 
			 
			 /*if( count( $orderItem1 ) > 0 )
			 {
				 //Means order_id, no splitting
				 return $orderItem1;
			 }
			 else
			 {
				 //Means order_id, splitting
				 return $orderItem2;
			 }*/
			 
		 return $orderItem;	 
		 }
		 
		 public function changeCurrency( $total = null, $simple = null )
		   {
			   $this->loadModel( 'CurrencyExchange' );
			   $currency	=	$this->CurrencyExchange->find('first', array('order' => array('CurrencyExchange.date DESC')));
			   $rate	=	$currency['CurrencyExchange']['rate'];
			   if($simple == 'GBP')
			   {
				 $total = (1/$rate) * $total;
			   }
			     return $total; 
				
		   }	
		
}
?>
