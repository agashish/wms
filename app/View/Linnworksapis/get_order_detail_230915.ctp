<?php

$Token = Configure::read('access_token');
$soapUrl = "http://api.linnlive.com/order.asmx?op=GetFilteredOrders";

$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <GetFilteredOrders xmlns="http://api.linnlive.com/order">
      <Token>'.$Token.'</Token>
      <Filter>'./*
		<OrderDateFromIsSet>boolean</OrderDateFromIsSet>
        <OrderDateFrom>dateTime</OrderDateFrom>
        <OrderDateToIsSet>boolean</OrderDateToIsSet>
        <OrderDateTo>dateTime</OrderDateTo>
        <OrderProcessDateFromIsSet>boolean</OrderProcessDateFromIsSet>
        <OrderProcessDateFrom>dateTime</OrderProcessDateFrom>
        <OrderProcessDateToIsSet>boolean</OrderProcessDateToIsSet>
        <OrderProcessDateTo>dateTime</OrderProcessDateTo>*/
		'<OrderIdIsSet>true</OrderIdIsSet>
		<OrderId>'.$orderID.'</OrderId>
		<pkOrderIdIsSet>true</pkOrderIdIsSet>
        <pkOrderId>'.$pkOrderId.'</pkOrderId>'.
        /*<ProcessedIsSet>boolean</ProcessedIsSet>
        <Processed>boolean</Processed>
        <Source>string</Source>
        <SubSource>string</SubSource>
        <Location>string</Location>
        <OrderFolder>string</OrderFolder>
        <StatusIsSet>boolean</StatusIsSet>
        <Status>int</Status>
        <ExcludeOnHold>boolean</ExcludeOnHold>
        <Cancel>boolean</Cancel>
        <ExcludeParked>boolean</ExcludeParked>
        <EntriesPerPage>int</EntriesPerPage>
        <PageNumber>int</PageNumber>
        <AuditTrailFilter>
          <AuditTrailFilter>
            <OrderIncludesAuditTrail>boolean</OrderIncludesAuditTrail>
            <HistoryNote>string</HistoryNote>
            <IsSetHistoryNote>boolean</IsSetHistoryNote>
            <fkOrderHistoryTypeId>string</fkOrderHistoryTypeId>
            <IsSetfkOrderHistoryTypeId>boolean</IsSetfkOrderHistoryTypeId>
            <Tag>string</Tag>
            <IsSetTag>boolean</IsSetTag>
          </AuditTrailFilter>
          <AuditTrailFilter>
            <OrderIncludesAuditTrail>boolean</OrderIncludesAuditTrail>
            <HistoryNote>string</HistoryNote>
            <IsSetHistoryNote>boolean</IsSetHistoryNote>
            <fkOrderHistoryTypeId>string</fkOrderHistoryTypeId>
            <IsSetfkOrderHistoryTypeId>boolean</IsSetfkOrderHistoryTypeId>
            <Tag>string</Tag>
            <IsSetTag>boolean</IsSetTag>
          </AuditTrailFilter>
        </AuditTrailFilter>
        <DetailLevel>
          <OrderDetailLevel>ALL or ORDERNOTES or ORDERITEMOPTIONS or ORDERITEMDETAILS or ORDERAUDITTRAIL or ORDERRETURNS or ORDERRELATION or ORDERPACKAGING or ORDERFOLDERS or ORDERITEMSUPPLIER or MINIMUMORDERDATA or ORDEREXTENDEDPROPERTIES</OrderDetailLevel>
          <OrderDetailLevel>ALL or ORDERNOTES or ORDERITEMOPTIONS or ORDERITEMDETAILS or ORDERAUDITTRAIL or ORDERRETURNS or ORDERRELATION or ORDERPACKAGING or ORDERFOLDERS or ORDERITEMSUPPLIER or MINIMUMORDERDATA or ORDEREXTENDEDPROPERTIES</OrderDetailLevel>
        </DetailLevel>*/
      '</Filter>
    </GetFilteredOrders>
  </soap:Body>
</soap:Envelope>';

$headers = array(
"POST /order.asmx HTTP/1.1",
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
//exit;

?>


<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php echo "Order ( Linnworks API ) "; ?></h1>
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
											<table class="table table-bordered table-striped" id="" aria-describedby="example1_info">
													<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">Label</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="2" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Description</th>
											</tr>
										</thead>
										<tbody role="alert" aria-live="polite" aria-relevant="all">
                                            <tr class="odd">
												<td class="  sorting_1"><b>Order Id</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->OrderId; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Full Name</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->FullName; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Email</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->Email; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Buyer Phone Number</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->BuyerPhoneNumber; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Country Name</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->ShippingAddress->CountryName; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Order Date</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->OrderDate; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Order Processed Date</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->OrderProcessedDate; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Order Processed Date</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->OrderProcessedDate; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Postage Cost</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->PostageCost; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Postage Cost</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->PostageCost; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Sub Total</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->Subtotal; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Total Cost</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->TotalCost; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Total Discount</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->TotalDiscount; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Bank Name</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->BankName; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Currency Code</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->CurrencyCode; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Source</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->Source; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Postal Service Name</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->PostalServiceName; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Packaging Group</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->PackagingGroup; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Ordet Items</b></td>
												<td><table width="100%" class="table table-bordered table-striped">
													<tr>
														<td><b>SKU</b></td>
														<td><b>Qty</b></td>
														<td><b>UnitCost</b></td>
														<td><b>PurchasePrice</b></td>
													</tr>
													<?php 
														foreach($parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order->OrderItems->OrderItem as $item)
														{
															echo "<tr><td>".$item->SKU."</td>";
															echo "<td>".$item->Qty."</td>";
															echo "<td>".$item->UnitCost."</td>";
															echo "<td>".$item->PurchasePrice."</td>";
															echo "<td>".$item->Barcode."</td></tr>";;
														}
													?>
												</table>
												</td>
										    </tr>
                                      </tbody>
									</table>		
								 <div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">                                                                            
                                	 <a href="/wms/Linnworksapis/getOpenOrder" class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40">Go Back</a>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
				<!-- BEGIN FOOTER -->
					<?php echo $this->element('footer'); ?>
				<!-- END FOOTER -->
            </div>
    </div>
</div>
