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
							<td valign="top" class="noleftborder rightborder bottomborder">'.$i.'</td>
							<td valign="top" class="rightborder bottomborder">'.substr($item->Title, 0, 10 ).'</td>
							<td valign="top" class="center norightborder bottomborder">'.$item->Quantity.'</td>
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
							<!--<body>
<div id="label">
<div class="container">
<table class="header row" style="border-bottom:0px">
<tr>
<td><img src=http://lovevitamins.com/wms/img/sfl.png width="200px"></td>
<td style="text-align:right"><span class="bold">Order Date</span><br>_RECIVEDATE_
</td>
</tr>
</table>


<table class="cn22 row" cellpadding="2px">
<tr>
<td class="leftside address" valign="top"><h4 style="background:#333333; color:#ffffff">Ship From:</h4>
<span class="bold">Store For Life</span><br>
Unit 4 Airport Cargo Centre,<br>
L\'avenue De Commune,<br>
St Peter, Jersey<br>
JE3 7BY<br>
E: sales@storeforlife.co.uk<br>
T: 0845 1393900
</td>
<td class="rightside address" valign="top"><h4 style="background:#333333; color:#ffffff">Ship To:</h4>
_ADDRESS1_ <br>
_ADDRESS_
</td>
</tr>
</table>
<div class="">

</div>
<table class="header row">
<tr>
<td width="33%"><span class="bold">Order No.</span>

</td>
<td width="33%"><span class="bold">Ship Via</span></td>
<td width="34%">
<span class="bold">Payment Method</span>
</td>
</tr>
<tr>
<td>_ORDERNUMBER_
</td>
<td>_COURIER_</td>
<td>Paypal
</td>
</tr>
</table>
<div style="padding:10px 0;margin:0 auto;text-align:center; font-size:24px">_BARCODE_<br>4584327-0</div>
<div class="tablesection row">
<table class="change_order_items" cellpadding="5px" cellspacing="0" style="border-collapse: collapse;">
<tr>
<th style="background:#333333; color:#ffffff" align="left" class="noleftborder rightborder nobottomborder" width="15%">Item No.</th>
<th style="background:#333333; color:#ffffff" align="left" valign="top" width="70%" class="rightborder nobottomborder">Description of contents</th>
<th style="background:#333333; color:#ffffff" valign="top" class="center norightborder nobottomborder" width="15%">Qty</th>
</tr>
_ORDERSUMMARY_
</table>
<table>
<tr>
<td class="otherinfo" style="text-align:right">
<div><span class="bold" >Total Quantity of Goods:</span> _TOTALITEM_</div></td>
</tr>
</table>


</div>
<div class="footer row" style="text-align:center">
Thanks you for your business! It was a pleasure to serve you.
</div>

</div>
</div>

</body>-->
';
				
				
				//$html2 	=	$gethtml[0]['PackagingSlip']['html'];
				$html2 .= '<style>'.file_get_contents($imgPath.'pdfstyle.css').'</style>';
				$html 	= $this->setReplaceValue( $setRepArray, $html2 );
				
				echo $html;
				exit;
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
				//BPost Post
				//$barcodeimg 	=  '<img src='.$barcodePath.$barcode.' width=500 >';
				
				//Jersey Post
				$barcodeimg 	=  '<img src='.$barcodePath.$barcode.' width=150 >';
				$barcodenum		=	explode('.', $barcode);
				
				$setRepArray[] 	=  $barcodeimg;
				$setRepArray[] 	=  $barcodenum[0];
				$setRepArray[]	=	 $str;
				$setRepArray[]	=	 $totlaWeight;
				$setRepArray[]	=	 $tax;
				$setRepArray[]	=	 $currentdate;
				
				
				//BPost Post
				//$dompdf->set_paper(array(0, 0, 377, 566), 'landsscape');
				
				//Jersey Post
				$dompdf->set_paper(array(0, 0, 377, 566), 'portrait');
				
				$cssPath = WWW_ROOT .'css/';
				$imgPath = Router::url('/', true) .'img/';
				
				
				
				$html 	= '<!--<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
 <meta content="" name="description"/>
 <meta content="" name="author"/><body>
       <div id="label">
       <div class="container">
       <table>
	   <tr><td><table style="width:auto; margin:30px 0;">
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
	   <td style="text-align:right"> <div class="countrycode"><h3 style="font-size:60px;color:#666666">GB</h3>
       </div></td>
	   </tr>
	   </table>
	   
<div class="barcode center" style="padding:20px 0;; border-top:3px solid #000000"><div>_BARCODEIMAGE_</div></div>
       <div class="footer row" style="padding:20px 0; text-align: center; border-top:3px solid #000000; border-bottom:3px solid #000000"><span class="bold">Return address:</span> Unit 4, Cargo Centre, Jersey Airport, <br>L\'Avenue de la Commune, St Peter, JE3 7BY</div>

       </div>
       </div>
       </body> ->
	   
	   <!- <body>
<div id="label">
<div class="container">
<table class="header row">
<tr>
<td width="59%"><img src="http://lovevitamins.com/wms/img/logo.jpg"></td>
<td width="41%" align="right">
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
<td width="25%"><span>&nbsp;</span>Gift</td>
<td width="25%"><span>&nbsp;</span>Documents</td>
<td width="25%"><span>&nbsp;</span>Commercial</td>
<td width="25%"><span>X</span>Merchandise</td>
</tr>
</table>

</div>

<table class="" cellpadding="1px" cellspacing="0" style="border-collapse:collapse" width="100%">
<tr>
<th class="noleftborder topborder rightborder bottomborder" width="60%">Quantity and detailed description of contents</th>
<th valign="top" class="center topborder rightborder bottomborder " width="20%">Weight (kg)</th>
<th valign="top" class="center topborder norightborder bottomborder" width="20%">Value</th>
</tr>
_ORDERDETAIL_
<tr>
<td class="noleftborder topborder rightborder " ></td>
<td valign="top" class="center topborder rightborder" >P & P</td>
<td valign="top" class="center topborder norightborder" >£0</td>
</tr>
<tr>
<td class="center noleftborder bottomborder rightborder " ></td>
<td valign="top" class="center bottomborder rightborder  " >VAT</td>
<td valign="top" class="center bottomborder norightborder " >£_TAX_</td>
</tr>

<tr>
<td class="noleftborder topborder rightborder " ><span class="bold">For commercial items only</span><br>If known, HS tariff number and country of origin of goods</td>
<td valign="top" class="center topborder rightborder bold" >Total Weight (kg)</td>
<td valign="top" class="center topborder norightborder bold" >Total Value</td>
</tr>
<tr>
<td class="center noleftborder bottomborder rightborder " >876534</td>
<td valign="top" class="center bottomborder rightborder  " >175.00</td>
<td valign="top" class="center bottomborder norightborder " >£101.98</td>
</tr>
</table>
<div class="fullwidth"><p>I the undersigned, whose name and address are given on the item, certify that the particulars given in this declaration are correct and that this item does not contain any dangerous article or articles prohibited by legislation or by postal or customs regulations.</p>
<table>
<tr>
<td class="date bold">Date: 09 Nov. 2015</td>
<td class="sign right"><img src="http://lovevitamins.com/wms/img/signature.png"></td>
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
<div class="footer row"><span class="bold">If undelivered please return to:</span> Unit 4, Cargo Centre, Jersey Airport, L\'Avenue de la Commune, St Peter, JE3 7BY</div>

</div>
</div>

</body>-->

<body>
<div id="label">
<div class="container">
<div class="footer row">

<table>
<tr>
<td class="leftside leftheading address"><h3>SHIP TO:</h3>
<span class="bold">_ADDRESS1_</span><br>
_ADDRESS_
United Country<br>
</td>
<td class="rightside rightheading leftborder">
<div class="barcode center bottomborder"><div>_BARCODEIMAGE_</div>_BARCODENUMBER_</div>
<div class="tracking"><h3>TRACKING #:</h3>
1Z A90 26X 03 9015 6318
</div>

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
<td width="25%"><span>&nbsp;</span>Gift</td>
<td width="25%"><span>&nbsp;</span>Documents</td>
<td width="25%"><span>&nbsp;</span>Commercial</td>
<td width="25%"><span>X</span>Merchandise</td>
</tr>
</table>

</div>

<table class="" cellpadding="1px" cellspacing="0" style="border-collapse:collapse" width="100%">
<tr>
<th class="noleftborder topborder rightborder bottomborder" width="60%">Quantity and detailed description of contents</th>
<th valign="top" class="center topborder rightborder bottomborder " width="20%">Weight (kg)</th>
<th valign="top" class="center topborder norightborder bottomborder" width="20%">Value</th>
</tr>
_ORDERDETAIL_
<tr>
<td class="noleftborder topborder rightborder " ></td>
<td valign="top" class="center topborder rightborder" >P & P</td>
<td valign="top" class="center topborder norightborder" >£0</td>
</tr>
<tr>
<td class="center noleftborder bottomborder rightborder " ></td>
<td valign="top" class="center bottomborder rightborder  " >VAT</td>
<td valign="top" class="center bottomborder norightborder " >£_TAX_</td>
</tr>

<tr>
<td class="noleftborder topborder rightborder " ><span class="bold">For commercial items only</span><br>If known, HS tariff number and country of origin of goods</td>
<td valign="top" class="center topborder rightborder bold" >Total Weight (kg)</td>
<td valign="top" class="center topborder norightborder bold" >Total Value</td>
</tr>
<tr>
<td class="center noleftborder bottomborder rightborder " >876534</td>
<td valign="top" class="center bottomborder rightborder  " >175.00</td>
<td valign="top" class="center bottomborder norightborder " >£101.98</td>
</tr>
</table>
<div class="fullwidth"><p>I the undersigned, whose name and address are given on the item, certify that the particulars given in this declaration are correct and that this item does not contain any dangerous article or articles prohibited by legislation or by postal or customs regulations.</p>
<table>
<tr>
<td class="date bold">Date: 09 Nov. 2015</td>
<td class="sign right"><img src="http://lovevitamins.com/wms/img/signature.png"></td>
</tr>
</table>
</div>
</div>

<table class="header row">
<tr>
<td width="59%"><img src="http://lovevitamins.com/wms/img/logo.jpg"></td>
<td width="41%" align="right">
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
<div class="footer row"><span class="bold">If undelivered please return to:</span> Unit 4, Cargo Centre, Jersey Airport, L\'Avenue de la Commune, St Peter, JE3 7BY</div>

</div>
</div>

</body>

	   ';
							
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
