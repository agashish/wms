<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php echo "Order ( Linnworks API ) "; ?></h1>
					<?php echo $this->element('api_top_menu'); ?>
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
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->NumOrderId; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Full Name</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->CustomerInfo->Address->FullName; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Email</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->CustomerInfo->Address->EmailAddress; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Buyer Phone Number</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->CustomerInfo->Address->PhoneNumber; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Country Name</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->CustomerInfo->Address->Country; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Order Date</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->GeneralInfo->ReceivedDate; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Postage Cost</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->TotalsInfo->PostageCost; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Sub Total</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->TotalsInfo->Subtotal; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Total Charge</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->TotalsInfo->TotalCharge; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Total Discount</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->TotalsInfo->TotalDiscount; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Currency Code</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->TotalsInfo->Currency; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Source</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->GeneralInfo->Source; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Postal Service Name</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->ShippingInfo->PostalServiceName; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Package Category</b></td>
												<td colspan="2" class="  sorting_1"><?php echo $getDetail->ShippingInfo->PackageCategory; ?></td>
										    </tr>
                                            <tr class="odd">
												<td class="  sorting_1"><b>Ordet Items</b></td>
												<td><table width="100%" class="table table-bordered table-striped">
													<tr>
														<td><b>SKU</b></td>
														<td><b>Qty</b></td>
														<td><b>Barcode</b></td>
													</tr>
													<?php 
														foreach($getDetail->Items as $item)
														{
															echo "<tr><td>".$item->OrderItem->sku."</td>";
															echo "<td>".$item->OrderItem->quantity."</td>";
															echo "<td>".$item->OrderItem->barcode."</td></tr>";
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
