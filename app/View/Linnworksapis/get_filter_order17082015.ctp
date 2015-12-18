	<?php

		if(!empty($data))
		{
			$parser	=	$this->Soap->getFilteredOrder( $data );
		}
		else
		{
			$parser	=	$this->Soap->getOpenOrder( $data );
		}
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
									<div class="date_error"></div>
									<div class="panel-title bg-white no-border">
										<?php
											print $this->form->create( 'Linnworksfilter', array( 'class'=>'form-horizontal bv-form', 'type'=>'post','id'=>'getFilterOrder','enctype'=>'multipart/form-data' ));
											?>									
											<div class="form-group">
												<label for="username" class="control-label col-lg-2">Order Type</label>                                        
												<div class="col-lg-2">                                            
													<?php
                                                    $orderArray = array('Open Order','Processed Order', 'Canceled Order');
                                                    if( count( $orderArray ) > 0 )
                                                        print $this->form->input( 'Linnworksapi.order_type', array( 'type'=>'select', 'empty'=>'Choose Order Type','options'=>$orderArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false ) );
													?> 
												</div>
											  </div>
											  
											<div class="form-group" style="display:none;">
												<label for="username" class="control-label col-lg-2">Location</label>                                        
												<div class="col-lg-2">                                            
													<?php
                                                    $getlist = $this->Soap->getLocation();
                                                    if( count( $getlist ) > 0 )
                                                        print $this->form->input( 'Linnworksapi.location', array( 'type'=>'select', 'empty'=>'Location','options'=>$getlist,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false ) );
													?> 
												</div>
											  </div>
											  
											<div class="form-group">
												<label for="username" class="control-label col-lg-2">Source</label>                                        
												<div class="col-lg-2">                                            
													<?php
														print $this->form->input( 'Linnworksapi.source', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
													?>
												</div>
											  </div>
											  
											<div class="form-group">
												<label for="username" class="control-label col-lg-2">Subsource</label>                                        
												<div class="col-lg-2">                                            
													<?php
														print $this->form->input( 'Linnworksapi.subsource', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
													?>
												</div>
											  </div>
											
											<div class="form-group">
												<label for="username" class="control-label col-lg-2">From</label>  
												<div class="col-lg-2">                                            
												<?php
													print $this->form->input( 'Linnworksapi.datefrom', array( 'type'=>'text','id'=>'datepicker','div'=>false,'label'=>false,'class'=>'form-control datepicker from_date', 'required'=>false, 'value' => '08/07/15') );
												?>
												</div>
											</div>
											<div class="form-group">
												<label for="username" class="control-label col-lg-2">To</label>                                        
												<div class="col-lg-2">                                            
												<?php
													print $this->form->input( 'Linnworksapi.dateto', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control datepicker to_date', 'required'=>false, 'value' => '08/12/15' ) );
												?>
												</div>
											</div>
											
											<div class="form-group">
												<label for="username" class="control-label col-lg-2">Order by ID</label>                                        
												<div class="col-lg-2">                                            
													<?php
														print $this->form->input( 'Linnworksapi.orderid', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
													?>
												</div>
											  </div>
											<div class="form-group">
												 <?php
														echo $this->Form->button('Submit', array(
															'type' => 'submit',
															'escape' => true,
															'class'=>'add_search_field btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
														 ));	
												?>	
											</div>
											</form>
										</div>
										<div>
											<?php
													if( isset( $data['Linnworksapi']['order_type'] ) && $data['Linnworksapi']['order_type'] == 0 )
													{
														echo  $this->form->create('Linnworksapis', array( 'class'=>'form-horizontal bv-form', 'type'=>'post','id'=>'getFilterOrderCsv','enctype'=>'multipart/form-data', 'action' => 'downloadExcel'));
														echo  $this->form->hidden('Linnworksapis.order_type', array('value' => $data['Linnworksapi']['order_type'] ));
														echo  $this->form->hidden('Linnworksapis.location', array('value' => $data['Linnworksapi']['location'] ));
														echo  $this->form->hidden('Linnworksapis.source', array('value' => $data['Linnworksapi']['source'] ));
														echo  $this->form->hidden('Linnworksapis.subsource', array('value' => $data['Linnworksapi']['subsource'] ));
														echo  $this->form->hidden('Linnworksapis.datefrom', array('value' => $data['Linnworksapi']['datefrom'] ));
														echo  $this->form->hidden('Linnworksapis.dateto', array('value' => $data['Linnworksapi']['dateto'] ));
														echo  $this->form->hidden('Linnworksapis.orderid', array('value' => $data['Linnworksapi']['orderid'] ));
														echo  $this->Form->button('Open Order Csv Download', array('type' => 'submit','escape' => true,'class'=>'add_search_field btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'));
													}
													
													if( isset( $data['Linnworksapi']['order_type'] ) && $data['Linnworksapi']['order_type'] == 1 )
													{
														echo  $this->form->create('Linnworksapis', array( 'class'=>'form-horizontal bv-form', 'type'=>'post','id'=>'getFilterOrderCsv','enctype'=>'multipart/form-data', 'action' => 'downloadExcel'));
														echo  $this->form->hidden('Linnworksapis.order_type', array('value' => $data['Linnworksapi']['order_type'] ));
														echo  $this->form->hidden('Linnworksapis.location', array('value' => $data['Linnworksapi']['location'] ));
														echo  $this->form->hidden('Linnworksapis.source', array('value' => $data['Linnworksapi']['source'] ));
														echo  $this->form->hidden('Linnworksapis.subsource', array('value' => $data['Linnworksapi']['subsource'] ));
														echo  $this->form->hidden('Linnworksapis.datefrom', array('value' => $data['Linnworksapi']['datefrom'] ));
														echo  $this->form->hidden('Linnworksapis.dateto', array('value' => $data['Linnworksapi']['dateto'] ));
														echo  $this->form->hidden('Linnworksapis.orderid', array('value' => $data['Linnworksapi']['orderid'] ));
														echo  $this->Form->button('Processed Order Csv Download', array('type' => 'submit','escape' => true,'class'=>'add_search_field btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'));
													}
													
													if( isset( $data['Linnworksapi']['order_type'] ) && $data['Linnworksapi']['order_type'] == 2 )
													{
														echo  $this->form->create('Linnworksapis', array( 'class'=>'form-horizontal bv-form', 'type'=>'post','id'=>'getFilterOrderCsv','enctype'=>'multipart/form-data', 'action' => 'downloadExcel'));
														echo  $this->form->hidden('Linnworksapis.order_type', array('value' => $data['Linnworksapi']['order_type'] ));
														echo  $this->form->hidden('Linnworksapis.location', array('value' => $data['Linnworksapi']['location'] ));
														echo  $this->form->hidden('Linnworksapis.source', array('value' => $data['Linnworksapi']['source'] ));
														echo  $this->form->hidden('Linnworksapis.subsource', array('value' => $data['Linnworksapi']['subsource'] ));
														echo  $this->form->hidden('Linnworksapis.datefrom', array('value' => $data['Linnworksapi']['datefrom'] ));
														echo  $this->form->hidden('Linnworksapis.dateto', array('value' => $data['Linnworksapi']['dateto'] ));
														echo  $this->form->hidden('Linnworksapis.orderid', array('value' => $data['Linnworksapi']['orderid'] ));
														echo  $this->Form->button('Cancelled  Order Csv Download', array('type' => 'submit','escape' => true,'class'=>'add_search_field btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'));
													}
											?>	
											
											</form>
											</div>
						       <div class="panel-body no-padding-top bg-white">											
									<table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
									<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Order no.</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">SKU (Location) </th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Source</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">SubSource</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Currency</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Total</th>
												<!--<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Action</th>-->
											</tr>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
                                            <?php
                                            
                                            if(isset($parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order) && count($parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order) > 0) {
												$i = 1;
												foreach($parser->GetFilteredOrdersResponse->GetFilteredOrdersResult->Orders->Order as $order)
													{ 
                                            ?>
                                            <tr class="odd">
												<td class="  sorting_1"><?php echo $i; ?></td>
												<td class="  sorting_1"><?php echo $order->OrderId; ?></td>
												<td class="  sorting_1">
												<?php 
													foreach($order->OrderItems->OrderItem as $item)
														{ 
															echo "<b>".$item->Quantity."</b> &nbsp; ".$item->SKU ."(".$item->Location. ")</br>";
														}
												?>
												</td>
												<td class="  sorting_1"><?php echo $order->Source; ?></td>
												<td class="  sorting_1"><?php echo $order->SubSource; ?></td>
												<td class="  sorting_1"><?php echo $order->CurrencyCode; ?></td>
												<td class="  sorting_1"><?php echo $order->TotalCost; ?></td>
												<!--<td class="  sorting_1">
													<ul id="icons" class="iconButtons">
														<a href="/wms/Linnworksapis/getOrder/<?php echo $order->nOrderId; ?>/<?php echo $order->OrderId; ?>" title="Show Order Description" class="btn btn-success btn-xs margin-right-10"><i class="ion-android-desktop"></i></a>
														<a href="/wms/Linnworksapis/getOrder/<?php echo "deleteOrder"; ?>/<?php echo $order->pkOrderId; ?>" title="Retrieved Attribute" class="btn btn-danger btn-xs margin-right-10" ><i class="fa fa-close"></i></a>
													</ul>
												</td>-->
										    </tr>
                                            <?php $i++; } } else { ?>
												<tr>No record found. </tr>
											<?php } ?>
                                      </tbody>
									</table>		
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
<script>

$('body').on('click', '.add_search_field', function(event){
		var from	=	$('.from_date').val();
		var to		=	$('.to_date').val();
		if(from == '' || to == '')
		{
			$('.date_error').html('<p style="color:red; padding: 11px 0 0 15px;">Please fill from and to date</p>');
			event.preventDefault();
		}
	})

</script>

