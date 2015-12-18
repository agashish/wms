<?php
$Token = Configure::read('access_token');

$soapUrl = "http://api.linnlive.com/inventory.asmx?op=GetStockItem";
$xml_post_string = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><GetStockItem xmlns="http://api.linnlive.com/inventory"><Token>'.$Token.'</Token><filter><EntriesPerPage>100</EntriesPerPage><PageNumber>1</PageNumber></filter></GetStockItem></soap:Body></soap:Envelope>';

$headers = array(
"POST /inventory.asmx HTTP/1.1",
"Host: api.linnlive.com",
"Content-Type: text/xml; charset=utf-8",
"Content-Length: ".strlen($xml_post_string)
);

$url = $soapUrl;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch); 

curl_close($ch);

$response = str_replace( "</soap:Body>" ,"" , str_replace( "<soap:Body>" , "" , $response ) );
$parser = simplexml_load_string($response);
//echo "<pre>";
//print_r($parser);
?>
<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
			<h1 class="page-title"><?php echo $title; ?></h1>
				<!-- api top menu -->
					<?php echo $this->element('api_top_menu'); ?>
				<!-- api top menu -->
			<div class="panel-title no-radius bg-green-500 color-white no-border">
			</div>
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>
    </div>
    <div class="container-fluid">
		<div class="row">
                        <div class="col-lg-12">
							<div class="panel no-border ">
                                <div class="panel-title bg-white no-border">									
									<div class="panel-tools">																	
									</div>
								</div>
						       <div class="panel-body no-padding-top bg-white">											
											<table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
													<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">SKU</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">PurchasePrice</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">RetailPrice</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Item Title</th>
											</tr>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
                                            <?php 
												$i = 1;
												foreach($parser->GetStockItemResponse->GetStockItemResult->StockItems->StockItem as $stock)
													{ 
                                            ?>
                                            <tr class="odd">
												<td class="  sorting_1"><?php echo $i; ?></td>
												<td class="  sorting_1"><?php echo $stock->SKU; ?></td>                                                
												<td class="  sorting_1"><?php echo $stock->PurchasePrice; ?></td> 
												<td class="  sorting_1"><?php echo $stock->RetailPrice; ?></td>                                                
												<td class="  sorting_1"><?php echo $stock->ItemTitle; ?></td>
									        </tr>
                                            <?php $i++; } ?>
                                      </tbody>
									</table>		
								</div>
                            </div>
                        </div>
                    </div>
				<!-- FOOTER -->
				<?php echo $this->element('footer'); ?>
				<!-- FOOTER -->
            </div>
		</div>
	</div>
