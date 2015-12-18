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

				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


					if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
						require_once(dirname(__FILE__).'/lang/eng.php');
						$pdf->setLanguageArray($l);
					}

				$pdf->SetFont('times', '', 8);
				//$pdf->AddPage();
				$j=0;
				$imgPath = WWW_ROOT .'css/';
				$imageurl 	=	Router::url('/img/source', true);;
				$html ='<style>
body{margin:0px;}
#label{padding:10px; width:394px; font-size:11px; color:#000000; font-family:"Helvetica Neue",Helvetica,Arial,sans-serif; }
#label .container{width:100%}
#label .container .header, #label .container .cn22, #label .container .footer{border-bottom:2px solid #000000; clear:both; padding:8px 4px;}
#label .container .footer{line-height:1.2}
#label .container .leftside, #label .container .rightside, #label .container .date, #label .container .sign{}
#label .container .jpoststamp{border:1px solid #000000; padding:1px;width:150px; }
#label .container .stampnumber{width: 35%; border:1px solid #000000; padding:4px; background:#000000;  color:#ffffff; text-align:center; font-size:22px; line-height:1.2}
#label .container .jerseyserial{ padding: 0 5px;    width: 65%; line-height:1; text-transform:uppercase; font-size:12px;font-weight:bold}
#label .container .vatnumber{padding: 2px 0 0 0; line-height:1.2; font-size:11px;font-weight:bold}
#label .container h1{font-family:"Oswald"; font-size:16px; margin:0px}
#label .container h3{font-size:12px;font-weight:bold; margin:0}
#label .container .rightheading{text-align:center;}
#label .container .fullwidth{clear:both}
#label .container .fullwidth h2{text-align:center; font-size:14px; font-weight:bold; margin:0; padding:5px 0;}
#label .container .fullwidth p{line-height:1.2; margin-top:5px}
#label .container .producttype{margin-bottom:5px;}

#label .container .producttype div{border-color: #000000;
border-width:1px;
border-style:solid;
    display: inline-block;
    height: 15px;
    line-height: 1.2;
    margin-right: 5px;
    text-align:center;
    width: 15px;}
	#label .container table{border:none; width:100%}
#label .container th{ font-weight:bold;font-size:12px; }
#label .container th, #label .container td{padding:2px;line-height:1.2;width:auto}
#label .container td table td{padding:0px;}
#label .container .norightborder{border-right:0px;}
#label .container .noleftborder{border-left:0px;}
#label .container .rightborder{border-right:1px solid #000000;}
#label .container .leftborder{border-left:1px solid #000000;}
#label .container .topborder{border-top:1px solid #000000;}
#label .container .bottomborder{border-bottom:1px solid #000000;}
#label .container .center{text-align:center}
#label .container .right{text-align:right}
#label .container .bold{font-weight:bold;font-size:12px; }
#label .container .sign{ margin-top: -20px;}
#label .container .barcode{padding:5px 0;}
#label .container .tracking{padding:5px 0;font-size:12px}
#label .container .address{font-size:12px}
#label .container .barcode div{font-family:"3 of 9 Barcode"; font-size:30px; margin: -5px 0;}
</style>';
				$html .= '<body>
<div id="label">
<div class="container">
<div class="header row">
<table>
<tr>
<td></td>
<td>
<table class="jpoststamp"><tr>
<td class="stampnumber">1</td>
<td class="jerseyserial">Postage Paid
Jersey
Serial 216</td>
</tr>
<tr>
<td colspan="2" class="vatnumber">UK Import VAT Pre-Paid
Auth No 393</td>
</tr>
</table>
</td>
</tr>
</table>

</div>
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
<td><div>&nbsp;</div>Gift</td>
<td><div>&nbsp;</div>Documents</td>
<td><div>&nbsp;</div>Commercial</td>
<td><div>X</div>Merchandise</td>
</tr>
</table>

</div>
<table class="" border="1" cellpadding="5px" cellspacing="0">
<tr>
<th class="noleftborder" width="60%">Quantity and detailed description of contents</th>
<th valign="top" class="center" width="20%">Weight (kg)</th>
<th valign="top" class="center norightborder" width="20%">Value</th>
</tr>
<tr>
<td class="noleftborder">4 x Health & Nutritional Products</td>
<td valign="top" class="center">175.00</td>
<td valign="top" class="center norightborder">£79.99</td>
</tr>
<tr>
<td class="noleftborder">2 x Baby & Children\'s Health</td>
<td valign="top" class="center">75.00</td>
<td valign="top" class="center norightborder">£29.99</td>
</tr>
<tr>
<td valign="top" class="noleftborder"></td>
<td valign="top " ><table>
<tr><td class="center">P & P<br>VAT</td></tr>
</table></td>
<td valign="top " class="norightborder"><table>
<tr><td class="center">£4.99<br>£17.00</td></tr>
</table></td>
</tr>
<tr>
<td valign="top" height="100%" class="noleftborder"><table height="100%">
<tr><td><span class="bold">For commercial items only</span><br>If known, HS tariff number and country of origin of goods</td></tr>
<tr><td class="center">876534</td></tr>
</table></td>
<td valign="top" height="100%"><table height="100%">
<tr><td class="center bold">Total Weight (kg)</td></tr>
<tr><td class="center">175.00</td></tr>
</table></td>
<td valign="top" height="100%"  class="norightborder"><table height="100%">
<tr><td class="center bold">Total Value</td></tr>
<tr><td class="center">£101.98</td></tr>
</table></td>
</tr>
</table>
<div class="fullwidth"><p>I the undersigned, whose name and address are given on the item, certify that the particulars given in this declaration are correct and that this item does not contain any dangerous article or articles prohibited by legislation or by postal or customs regulations.</p>
<div class="date bold">Date: 22 Sep. 2015</div>
<div class="sign right"></div>
</div>
</div>
<div class="footer row">

<table>
<tr>
<td class="leftside leftheading address"><h3>SHIP TO:</h3>
<span class="bold">Mr Test Customer</span><br>
Address Line 1 Address Line 2 <br>
Some Town Some Region<br>
123 ABC<br>
United Country<br>
</td>
<td class="rightside rightheading leftborder">
<div class="tracking bottomborder"><h3>TRACKING #:</h3>
1Z A90 26X 03 9015 6318
</div>
<div class="barcode center">Purchase Order<div>4584327-0</div>4584327-0</div>
</td>
</tr>
</table>
</div>
<div class="footer row"><span class="bold">If undelivered please return to:</span> Unit 4, Cargo Centre, Jersey Airport, L’Avenue de la Commune, St Peter, JE3 7BY</div>

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
	

}
?>
