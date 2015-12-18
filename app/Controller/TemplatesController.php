<?php
class TemplatesController extends AppController
{
    
    var $name = "Templates";
    
    var $components = array('Session','Upload','Common','Auth');
    
    var $helpers = array('Html','Form','Common','Session');
    
    /*
     * funcation use for add and Update the postal service 
     * 
     * */
    
    public function AddTemplate()
    {
		$this->layout = 'index';
		$this->loadModel('PostalProvider');
		$this->loadModel('PostalServiceDesc');
		$this->loadModel('Template');
		
		if($this->request->is('post'))
		{
			
			$this->request->data['Template']['provider_id']	=	$this->request->data['Template']['provider_id'];
			$this->request->data['Template']['service_id']	=	$this->request->data['Template']['ids'];
			$this->request->data['Template']['html']		=	$this->request->data['Template']['html'];
			$this->request->data['Template']['name']		=	$this->request->data['Template']['name'];
			$this->Template->saveAll( $this->request->data );
			
			$templateid	=	$this->Template->getLastInsertId();
			$serviceids	=	explode(',', $this->request->data['Template']['service_id']);
			
			foreach($serviceids as $key => $value)
			{
				$this->request->data['PostalServiceDesc']['id']			=	$value;
				$this->request->data['PostalServiceDesc']['template_id']	=	$templateid;
				$this->PostalServiceDesc->saveAll($this->request->data['PostalServiceDesc'],array('validate' => false));
			}	
			
		}
		$courier		=	$this->PostalProvider->find('list', array('fields' => 'id, provider_name'));
		$postalservices	=	$this->PostalServiceDesc->find('all', array('conditions' => array('PostalServiceDesc.postal_provider_id' => '1')));
		
		$this->set('courier', $courier);
		$this->set('postalservices', $postalservices);
	}
	
	public function getselectedservice()
	{
		$this->layout = '';
		$this->autoRender = false;
		$id	=	$this->request->data['id'];
		$this->loadModel('PostalServiceDesc');
		$postalservices	=	$this->PostalServiceDesc->find('all', array('conditions' => array('PostalServiceDesc.postal_provider_id' => $id, 'PostalServiceDesc.template_id' => '0' )));
		$this->set('postalservices', $postalservices);
		$this->render('service');
	}
	
	public function AddPackagingSlip()
	{
		$this->layout = 'index';
		$this->loadModel('PackagingSlip');
		if($this->request->is('post'))
		{
			$this->PackagingSlip->saveAll( $this->request->data );
			$this->Session->setflash(  "Add Packaging Slip Successful.",  'flash_success' );
		}
	}
	
	public function showTemplate()
	{
		$this->layout = 'index';
		$this->loadModel('Template');
		$templates	=	$this->Template->find('all');
		$this->set('templates', $templates);
	}
	
	public function editTemplate( $id = null )
	{
		$this->layout = 'index';
		$this->loadModel('Template');
		$this->loadModel('PostalProvider');
		
		$template	=	$this->Template->find('first', array('conditions' => array('Template.id' => $id)));
		$courier		=	$this->PostalProvider->find('list', array('fields' => 'id, provider_name'));
		
		$this->request->data	=	$template;
		$this->set('courier', $courier);
		
	}
	
	
	
	
	public function domprint()
		{
				$this->layout = '';
				$this->autoRender = false;
			
				//App::import('Vendor','dompdf_config.inc');
				require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 
				
				spl_autoload_register('DOMPDF_autoload'); 
				$dompdf = new DOMPDF();
				//$paper_size = array(100,150,360,360);
				$dompdf->set_paper(array(0, 0, 394, 567), 'portrait');
				
				$this->layout = '';
				//$this->autoRender = false;
				
				$this->loadModel( 'PackagingSlip' );
				
				$order	=	$this->getOpenOrderById('100028');
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
				$barcode  			 =   $order['assign_barcode'];
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
							<td valign="top" class="">'.substr($item->Title, 0, 10 ).'</td>
							<td valign="top" class="">'.$item->Quantity.'</td>
							</tr>';
					$i++;
				}
				$totalitem = $i - 1;
				$setRepArray[]	=	 $str;
				$setRepArray[]	=	 $totalitem;
				$setRepArray[]	=	 $subtotal;
				$Path 			= 	'/wms/img/client/';
				$img			=	 '<img src=http://localhost/wms/img/client/demo.png height="50" width="50">';
				//$img			=	 '<img src='.$Path.'demo.png alt="test alt attribute" width="100" height="100" border="0" />';
				$setRepArray[]	=	 $img;
				$setRepArray[]	=	 $postagecost;
				$setRepArray[]	=	 $tax;
				$totalamount	=	 (float)$subtotal + (float)$postagecost + (float)$tax;
				$setRepArray[]	=	 $totalamount;
				$setRepArray[]	=	 $address;
				$barcodePath  =  Router::url('/', true).'img/orders/barcode/';
				$barcodeimg  =  '<img src='.$barcodePath.$barcode.' width=400px>';
				$setRepArray[] =  $barcodeimg;
				
				
				$imgPath = WWW_ROOT .'css/';
				
							$html2 = '
							<body>
<div id="label">
<div class="container">
<table class="header row" style="border-bottom:0px">
<tr>
<td><h4>
<u>Ship To:</u></h4>
_ADDRESS1_ <br>
_ADDRESS_
</td>
<td style="text-align:right" valign="top"><img src=http://lovevitamins.com/wms/img/rainbow.png width="200px">
</td>
</tr>
</table>
<table class="header row" style="margin:0 0 20px 0; border-bottom:0px">
<tr>
<td width="33%"><span class="bold">Order No.</span>

</td>
<td width="33%" align="right"><span class="bold">Order Date</span></td>
</tr>
<tr>
<td>_ORDERNUMBER_
</td>
<td align="right">_RECIVEDATE_</td>
</tr>
</table>


<div class="tablesection row" style="margin:20px 0 0 0;">
<table class="change_order_items" cellpadding="5px" cellspacing="0" border="1" style=" border-collapse: collapse; margin:0px;" >
<tr>
<th style="" align="left" class="" width="15%">Item No.</th>
<th style="" align="left" valign="top" width="70%" class="">Description of contents</th>
<th style="" valign="top" class="" width="15%">Qty</th>
</tr>
_ORDERSUMMARY_
</table>
<table>
<tr>
<td class="otherinfo" style="text-align:right">
<div style="margin-bottom:10px"><span class="bold" >Total Quantity of Goods:</span> _TOTALITEM_</div></td>
</tr>
</table>

<div style="padding:10px 0;text-align:center; font-size:24px">_BARCODE_<br>4584327-0</div>


</div>
<div class="footer row" style="text-align:center; border-bottom:0px;" >
<b>Thank you for purchasing from Rainbow Retail!</b> <br> Please keep this packaging slip as your verification of delivery. 
</div>

</div>
</div>

</body>';
				
				
				//$html2 	=	$gethtml[0]['PackagingSlip']['html'];
				$html2 .= '<style>'.file_get_contents($imgPath.'pdfstyle.css').'</style>';
				$html 	= $this->setReplaceValue( $setRepArray, $html2 );
				
				//echo $html;
				//exit;
								//$dompdf->load_html($html);
				$dompdf->load_html(utf8_decode($html), Configure::read('App.encoding'));
				$dompdf->render();
				$dompdf->stream("hello.pdf");
				
				
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
			return $getRep;
			
		}
		
		
		 public function domeshipping( )
		{
			
				$this->layout = '';
				$this->autoRender = false;
				$this->loadModel('Template');
				//$id	=	$this->request->data['pkorderid'];
			
				require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php'); 
				
				spl_autoload_register('DOMPDF_autoload'); 
				$dompdf = new DOMPDF();
				
				
				$order	=	$this->getOpenOrderById( '100028' );
			
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
				//$templateId			=	 	$order['template_id'];
				
				
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
				$barcodeimg 	=  '<img src='.$barcodePath.$barcode.' width=500 >';
				$barcodenum		=	explode('.', $barcode);
				
				$setRepArray[] 	=  $barcodeimg;
				$setRepArray[] 	=  $barcodenum[0];
				$setRepArray[]	=	 $str;
				$setRepArray[]	=	 $totlaWeight;
				$setRepArray[]	=	 $tax;
				$setRepArray[]	=	 $currentdate;
				
				
				
				$dompdf->set_paper(array(0, 0, 377, 566), 'landsscape');
				$cssPath = WWW_ROOT .'css/';
				$imgPath = Router::url('/', true) .'img/';
				
				
				
				$html 	= '<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
 <meta content="" name="description"/>
 <meta content="" name="author"/><body>
       <div id="label">
       <div class="container">
<table style="padding:20px 0; border-bottom:3px solid #000000">
<tr>
<td align="right" height="80px">
<table class="header1" align="right" >
<tr>
<td class="rightborder aprior" style="padding-right:10px">
<img src="http://lovevitamins.com/wms/img/a_prior.png">
<div>If undelivered please return to</div>
<div class="po">PO BOX 9321</div>
<div>1934 E.M.C. Brucargo, Belgium</div>
</td>
<td class="bpost" style="padding-left:10px">
<img src="http://lovevitamins.com/wms/img/bpost.png">
<div class="po">PB-PP | BPI-9321</div>
<div>BELGIE(N)-BELGIQUE</div>
</td>
</tr>
</table>
</td>
</tr>
</table>

       <table>
	   <tr><td><table style="width:auto; margin:20px 0;">
	   <tr>
	   <td valign="top"><h4>SHIP TO:</h4></td>
	   <td><table>
       <tr>
       <td class="leftside leftheading address">
       <span class="bold">_ADDRESS1_</span><br>
       _ADDRESS_
       </td>
       </tr>
       </table></td>
	   </tr>
	   </table></td>
	   <td style="text-align:right"> <div class="countrycode"><h3 style="font-size:60px;color:#666666">BE</h3>
       </div></td>
	   </tr>
	   </table>
<div class="footer row" style="padding:20px 0; text-align: center; border-top:3px solid #000000; border-bottom:3px solid #000000">	   
<div class="barcode center"><div>_BARCODEIMAGE_</div></div>
</div>
       <div class="footer row" style="display:none; padding:20px 0; text-align: center; border-top:3px solid #000000; border-bottom:3px solid #000000"><span class="bold">If undelivered please return to:</span><br> E.M.C. Building 829 C, 1931 Zaventem - Brucargo, Belgium</div>

       </div>
       </div>
       </body>';
							
				//$htmlcontent =	$this->Template->find('first', array('conditions' => array('Template.id' => $templateId )));
				
				//$html 	=	$htmlcontent['Template']['html'];
				
				$html .= '<style>'.file_get_contents($cssPath.'pdfstyle.css').'</style>';
				$html 	= $this->setReplaceValueLabel( $setRepArray, $html );
				
				
				//echo $html;
				//exit;
				$dompdf->load_html(utf8_decode($html), Configure::read('App.encoding'));
				$dompdf->render();
				$dompdf->stream("OrderIdslip-$ordernumber.pdf");
				
				
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
			return $getRep;
			
		}
		
    
}
?>
