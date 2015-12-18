<?php
ini_set('display_errors',1);
	include("api/Factory.php");
	include("api/Auth.php");
	//include("api/ImportExport.php");
	include("api/Orders.php");
	include("api/ProcessedOrders.php");
	include("api/PrintService.php");
		
	$username = "jijgrouptest@gmail.com";
	$password = "#noida15";
	
	/*$username = "jake.shaw@euracogroup.co.uk";
	$password = "#aniket55";*/
	
	$multi = AuthMethods::Multilogin($username, $password);
	
	$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);
	
	$token = $auth->Token;	
	$server = $auth->Server;
	//filters={"TextFields":[{"Type":0,"Text":"sample string 1","FieldCode":0}
	//GetOpenOrders('','1',$filters,'','00000000-0000-0000-0000-000000000000','',$token, $server)
	
	$result	=	OrdersMethods::GetOpenOrders('5','1','','','00000000-0000-0000-0000-000000000000','',$token, $server);
	echo "<pre>";
	print_r($result);
	exit;
	$orderId = '696e9699-62f0-4584-a5c1-744745dbf16d';
	$scanPerformed = true;
	$fulfilmentCenter = '00000000-0000-0000-0000-000000000000';
	//$result = OrdersMethods::ProcessOrder($orderId,$scanPerformed,$token, $server); //done
	
	//$result = OrdersMethods::CancelOrder($orderId,$fulfilmentCenter,86.2,'it is test order',$token, $server); //done
	
	$pkOrderId = 'e35b1f81-1f98-44ef-a9a9-1c7a0d3263f7';
	$despatchLocation = '00000000-0000-0000-0000-000000000000';
	$category = 'Health & Beauty';
	$reason = 'In Transit';
	$additionalCost = 15.04;
	
	//$result = ProcessedOrdersMethods::CreateFullResend($pkOrderId,$despatchLocation,$category,$reason,$additionalCost,$token, $server); //done
	
	//$result = PrintServiceMethods::GetTemplateList('Invoice Template',$token, $server); //done
	
	$orderIdArray[] = 'ffd3fdef-2af3-4a5c-8b18-445affdaf8ab';
	$orderIdArray[] = '696e9699-62f0-4584-a5c1-744745dbf16d';
	$IDs = $orderIdArray;
	$parameters = '[]';
	$result = PrintServiceMethods::CreatePDFfromJobForceTemplate('Invoice Template',$IDs,16,$parameters,'EuracoGroup',$token, $server);
	
	echo "<pre>";
	print_r($result);	
	exit;
	
	//$result = PrintServiceMethods::DownloadVirtualPrinterClient($token, $server);  //done
	
	$result = PrintServiceMethods::VP_GetPrinters($token, $server);  //done
	
	/*echo "<pre>";
	print_r($result);	
	exit;*/
	
	$result = PrintServiceMethods::PrintTemplatePreview(16,$token, $server);  //done
	$url = $result->URL;
	//https://usprinting1.linnworks.net/Download.svc/File/2f457d721aac04e984a48c0f83c08fa5-28f613a3-808e-43fb-ba75-ccd2cb33e96d/pdf	
	?>
	<script>
		var url = 'https://usprinting1.linnworks.net/Download.svc/File/2f457d721aac04e984a48c0f83c08fa5-50e99fe3-c24c-467c-abf8-2479fcd2221b/pdf';
		var win=window.open(url, '_blank');
		win.focus();
	</script>
	<?php
	
	exit;
	//$result = OrdersMethods::RemoveOrderItem('b0cb3352-fba8-4c92-8d43-841f6763a756','eed796c7-d1ab-4641-934a-26a5f6cecf5a',$fulfilmentCenter,$token, $server); //done
	
	//$result = OrdersMethods::UpdateOrderItem('b0cb3352-fba8-4c92-8d43-841f6763a756',$orderItem,$fulfilmentCenter,'Direct','MyStore',$token, $server);
	
	
	
	/*echo "<pre>";
	print_r($result);	
	exit;*/
	
	/*$imports = ImportExportMethods::GetImports($token, $server);
	echo "<pre>";
	print_r($imports);*/
	
	
?>
