<div class="top_panel rightside bg-grey-100" style="display:none;">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php echo "Open Order"; ?></h1>
        		<div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
									<?php
										echo  $this->form->create('Linnworksapis', array( 'class'=>'form-horizontal bv-form', 'type'=>'post','id'=>'getFilterOrderCsv','enctype'=>'multipart/form-data', 'action' => 'generatePickList'));
										echo  $this->form->hidden('Linnworksapis.orderid', array('class' => 'get_sku_string' ));
										echo  $this->Form->button('Pick List', array('type' => 'submit', 'escape' => true,'class'=>'btn btn-success'));
										echo  $this->form->end();
									?>
							</li>
							<li>
								<a class="switch btn btn-success" href="javascript:void(0)" data-toggle="modal" data-target=""><i class=""></i> Switch </a>
							</li>
							<li>
								<a href="/wms/linnworksapis" type="submit" class="printorder btn bg-orange-500 color-white btn-dark padding-left-40 padding-right-40" >Go Back</a>
							</li>
						</ul>
					</div>
				</div>
			<div class="panel-title no-radius bg-green-500 color-white no-border">
			</div>
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>
			<div class="api_message" style="display:none; color:green; padding 10px 0 0 10px;"></div>
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
										<thead class="parentCheck" >
											<tr role="row" class="parentInner" >
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Order no.</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">SKU</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Currency</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Total</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Action</th>
											</tr>
										</thead>
										<tbody role="alert" aria-live="polite" aria-relevant="all">
                                            <?php $i = 1;
												foreach($results->Data as $result)
													{
														$id	=	$result->OrderId;
                                            ?>
                                            <tr class="odd">
												<td class="  sorting_1">
												<input type="hidden" class ="case" name="skutouploadID" id="<?php echo $result->NumOrderId; ?>" onclick="get_sku();" >
												<?php echo $result->NumOrderId; ?>
												</td>
												<td class="  sorting_1 pick_sku" >
													<?php 
													foreach($result->Items as $item)
														{ 
															echo "<b>".$item->Quantity."</b> &nbsp; ".$item->SKU ."</br>";
															echo "<input type=hidden class=get_hidden_sku id=" .$item->SKU ."  />";
														}
												?>
												</td>
												<td class="  sorting_1"><?php echo $result->TotalsInfo->Currency; ?></td>
												<td class="  sorting_1"><?php echo $result->TotalsInfo->TotalCharge; ?></td>
												<td class="  sorting_1">
													<ul id="icons" class="iconButtons">
														<input type="hidden" value="<?php echo $id; ?>" class="processid" />
														<a href="/wms/Linnworksapis/getOrderdetail/<?php echo $result->NumOrderId; ?>/<?php echo $result->OrderId; ?>" title="Show Order Description" class="btn btn-success btn-xs margin-right-10"><i class="ion-android-desktop"></i></a>
														<a href="javascript:void(0);" for="<?php echo $id; ?>##$#<?php echo "00000000-0000-0000-0000-000000000000"; ?>##$#<?php echo $result->TotalsInfo->TotalCharge; ?>" title="Cancel Order" class="ordercancel btn btn-danger btn-xs margin-right-10" ><i class="ion-minus-round"></i></a>
														<a class="loading-image_<?php echo $id; ?>" style="display:none;"><img src="http://localhost/wms/app/webroot/img/image_889915.gif" hight ="20" width="20" /></a>
													</ul>
												</td>
										    </tr>
                                            <?php $i++; } ?>
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
  <!--Start for arrange -->

<div class="bottom_panel rightside bg-grey-100" >
    <div class="page-head bg-grey-100">
		 <h1 class="page-title"><?php echo "Open Order"; ?></h1>
				<div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
													<?php
														echo  $this->form->create('Linnworksapis', array( 'class'=>'form-horizontal bv-form', 'type'=>'post','id'=>'getFilterOrderCsv','enctype'=>'multipart/form-data', 'action' => 'generatePickList'));
														echo  $this->form->hidden('Linnworksapis.orderid', array('class' => 'get_sku_string' ));
														echo  $this->Form->button('Pick List', array('type' => 'submit', 'escape' => true,'class'=>'btn btn-success'));
														echo  $this->form->end();
													?>
							</li>
							<li>
								<a class="switch btn btn-success" href="javascript:void(0)" data-toggle="modal" data-target=""><i class=""></i> Switch </a>
							</li>
							<li>
								<a class="btn btn-xs btn-success" href="/wms/linnworksapis/dispatchConsole" data-toggle="modal" data-target="">Dispatch Console</a>
							</li>	
							<li>
								<a href="/wms/linnworksapis" type="submit" class="printorder btn bg-orange-500 color-white btn-dark padding-left-40 padding-right-40" >Go Back</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="panel-title no-radius bg-green-500 color-white no-border">
					<div class="panel-head"><?php print $this->Session->flash(); ?></div>
				</div>
    </div>
   
    <div class="container-fluid" >
        <div class="row">
		    <div class="col-lg-6 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head">Group 1</div>
						</div>
					<div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
							<table class="table table-bordered table-striped dataTable">
								<tr>
									<th>OrderID</th>
									<th>Postal</th>
									<th>SKU</th>
									<th>Total</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
								<?php foreach($express1 as $expressOne) {  ?> 
								<tr style="border-bottom: 1px solid #ccc;" ><td><?php echo $expressOne->NumOrderId; ?></td>
								<td><?php echo $expressOne->ShippingInfo->PostalServiceName; ?></td>
								<td><?php echo $expressOne->Items[0]->SKU; ?></td>
								<td><?php echo $expressOne->TotalsInfo->TotalCharge; ?></td>
								<td><?php 
								$trackedDate=$expressOne->GeneralInfo->ReceivedDate;
								$trackedDate=explode('T', $trackedDate);
								echo $trackedDate[0]."<br>(".$trackedDate[1].")";
								?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $expressOne->OrderId; ?>"><i class="ion-clipboard"></i></a></td>
								</tr>
								<?php } ?>
								<?php foreach($tracked1 as $trackedOne) {  ?> 
								<tr style="border-bottom: 1px solid #ccc;" ><td><?php echo $trackedOne->NumOrderId; ?></td>
								<td><?php echo $trackedOne->ShippingInfo->PostalServiceName; ?></td>
								<td><?php echo $trackedOne->Items[0]->SKU; ?></td>
								<td><?php echo $trackedOne->TotalsInfo->TotalCharge; ?></td>
								<td><?php 
								$trackedDate=$trackedOne->GeneralInfo->ReceivedDate;
								$trackedDate=explode('T', $trackedDate);
								echo $trackedDate[0]."<br>(".$trackedDate[1].")";
								?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $trackedOne->OrderId; ?>"><i class="ion-clipboard"></i></a>
								</td>
								</tr>
								<?php } ?>
								<?php foreach($standerd1 as $standerdOne) {  ?> 
								<tr style="border-bottom: 1px solid #ccc;" ><td><?php echo $standerdOne->NumOrderId; ?></td>
								<td><?php echo $standerdOne->ShippingInfo->PostalServiceName; ?></td>
								<td><?php echo $standerdOne->Items[0]->SKU; ?></td>
								<td><?php echo $standerdOne->TotalsInfo->TotalCharge; ?></td>
								<td><?php 
								$trackedDate=$standerdOne->GeneralInfo->ReceivedDate;
								$trackedDate=explode('T', $trackedDate);
								echo $trackedDate[0]."<br>(".$trackedDate[1].")";
								?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $standerdOne->OrderId; ?>"><i class="ion-clipboard"></i></a></td>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
            </div>
	    </div>
		<div class="col-lg-6 rackDetails">
				<div class="panel">
						<div class="panel-title">
									<div class="panel-head">Group 2</div>
						</div>
					<div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
							<table class="table table-bordered table-striped dataTable">
								<tr>
									<th>OrderID</th>
									<th>Postal</th>
									<th>SKU</th>
									<th>Total</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
								<?php foreach($express2 as $expressTwo) {  ?> 
								<tr style="border-bottom: 1px solid #ccc;" ><td><?php echo $expressTwo->NumOrderId; ?></td>
								<td><?php echo $expressTwo->ShippingInfo->PostalServiceName; ?></td>
								<td><?php foreach($expressTwo->Items as $item) { 
											echo $item->SKU."<br>";
										 } ?>
								</td>
								<td><?php echo $expressTwo->TotalsInfo->TotalCharge; ?></td>
								<td><?php 
								$trackedDate=$expressTwo->GeneralInfo->ReceivedDate;
								$trackedDate=explode('T', $trackedDate);
								echo $trackedDate[0]."<br>(".$trackedDate[1].")";
								?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $expressTwo->OrderId; ?>"><i class="ion-clipboard"></i></a></td>
								</tr>
								<?php } ?>
								
								<?php foreach($tracked2 as $trackedTwo) {  ?> 
								<tr style="border-bottom: 1px solid #ccc;" ><td><?php echo $trackedTwo->NumOrderId; ?></td>
								<td><?php echo $trackedTwo->ShippingInfo->PostalServiceName; ?></td>
								<td>
								<?php foreach($trackedTwo->Items as $item) { 
											echo $item->SKU."<br>";
										 } ?>
								</td>
								<td><?php echo $trackedTwo->TotalsInfo->TotalCharge; ?></td>
								<td><?php 
								$trackedDate=$trackedTwo->GeneralInfo->ReceivedDate;
								$trackedDate=explode('T', $trackedDate);
								echo $trackedDate[0]."<br>(".$trackedDate[1].")";
								?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $trackedTwo->OrderId; ?>"><i class="ion-clipboard"></i></a></td>
								</tr>
								<?php } ?>
								
								<?php foreach($standerd2 as $standerdTwo) {  ?> 
								<tr style="border-bottom: 1px solid #ccc;" ><td><?php echo $standerdTwo->NumOrderId; ?></td>
								<td><?php echo $standerdTwo->ShippingInfo->PostalServiceName; ?></td>
								<td>
								<?php foreach($standerdTwo->Items as $item) { 
											echo $item->SKU."<br>";
										 } ?>
								</td>
								<td><?php echo $standerdTwo->TotalsInfo->TotalCharge; ?></td>
								<td><?php $trackedDate=$standerdTwo->GeneralInfo->ReceivedDate;
								$trackedDate=explode('T', $trackedDate);
								echo $trackedDate[0]."<br>(".$trackedDate[1].")";
								?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $standerdTwo->OrderId; ?>"><i class="ion-clipboard"></i></a></td>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
            </div>
		</div>
	</div>        
</div>
<!--Start despatch consol popup-->

<div class="modal modal-wide fade pop-up-despatch" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myLargeModalLabel-1">Dispatch Console</h4>
         </div>
         <div class="modal-body bg-grey-100">
           	<div class="panel" style="clear:both">
					<div class="panel-body" ></div>
					
					<div class="input text"><label for="LinnworksapisBarcode">Barcode</label><input type="text" id="LinnworksapisBarcode" index="0" class="get_sku_string" name="data[Linnworksapis][barcode]"></div>
					<button class="button_for_scanning add_search_field btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" type="submit">Submit</button>
				</div>
				<div class="outer_bin_addMore">
				
			    </div>	
			</div>
		</div>
	</div>
</div>




<!--End despatch consol popup-->

<!--Start Popup for all order-->
<?php foreach($results->Data as $result) { ?>
<div class="modal modal-wide fade pop-up-<?php echo $result->OrderId; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myLargeModalLabel-1"><?php echo $result->ShippingInfo->PostalServiceName; ?></h4>
         </div>
         <div class="modal-body bg-grey-100">
           	<div class="panel" style="clear:both">
					<div class="panel-body" >
						<table>
							<tr>
								<td>Order ID</td>
								<td><?php echo $result->NumOrderId; ?></td>
							</tr>
							<tr>
								<td>Postal Service Name</td>
								<td><?php echo $result->ShippingInfo->PostalServiceName; ?></td>
							</tr>
							<tr>
								<td>Total</td>
								<td><?php echo $result->TotalsInfo->TotalCharge; ?></td>
							</tr>
							<tr>
								<td>SKU</td>
								<td><?php echo $result->Items[0]->SKU; ?></td>
							</tr>
							<tr>
								<td>Country</td>
								<td><?php echo $result->CustomerInfo->Address->Country; ?></td>
							</tr>
							<tr>
								<td>TotalWeight</td>
								<td><?php echo $result->ShippingInfo->TotalWeight; ?></td>
							</tr>
						</table>
					 </div>
				</div>
				<div class="outer_bin_addMore">
			    </div>	
				<div class="row">
					<div class="col-lg-10 col-lg-offset-1">
						<a href="javascript:void(0);" for = "<?php echo $result->OrderId; ?>" class="assignpostelservice assignpostelservice_<?php echo $result->OrderId; ?> btn bg-orange-500 color-white btn-dark padding-left-40 padding-right-40" >Assign Postal Service</a>
						<a href="javascript:void(0);" for = "<?php echo $result->OrderId; ?>" class="processedorder processedorder_<?php echo $result->OrderId; ?> btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40" style="display:none;" >Processed</a>
						<a href="" class="loading-image_<?php echo $result->OrderId; ?>" style="display:none;"><img src="http://localhost/wms/app/webroot/img/image_889915.gif" hight ="20" width="20" /></a>
						<a href=""  target="_blank" for = "<?php echo $result->OrderId; ?>" class="printorder_<?php echo $result->OrderId; ?> btn bg-orange-500 color-white btn-dark padding-left-40 padding-right-40" style="display:none;" target="_blank" >Print Label</a>
						<a href=""  target="_blank" for = "<?php echo $result->OrderId; ?>" class="printlable_<?php echo $result->OrderId; ?> btn bg-orange-500 color-white btn-dark padding-left-40 padding-right-40" style="display:none;" target="_blank" >Print Slip</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--End Popup for all order-->

<script>
$(document).keypress(function(e) {
    if(e.which == 13) {
        submitSanningValue();
    }
});

function submitSanningValue()
{
	var Barcode	=	$('#LinnworksapisBarcode').val();
	
	$.ajax(
				{
						'url'            : getUrl() + '/Linnworksapis/getsearchlist',
						'type'           : 'POST',
						'data'           : { barcode : Barcode },
						'beforeSend'	 : function() {
															$('.loading-image').show();
														},
						'success' 		 : function( msgArray )
														{
															$('.outer_bin_addMore').html(msgArray)
														}  
						});  
					
}


$(function() {
  $("#LinnworksapisBarcode").focus();
});
	$(document).ready(function()
        { 
			<!--set product id-->
			
					 var skuArray = [];
					 var countryArraynew = [];
					 var blkstr = [];
					 var i = 0;
					 $('.case').each(function()
									{
										skuArray[i]	=	$(this).attr('id');
										i++;
									});
			
					$.each(skuArray, function(idx2,val2) {                    
							 var str =  val2;
							 blkstr.push(str);
						});
					
						var skuStr	=	blkstr.join("---");
						$('.get_sku_string').val(skuStr);
			
			<!--set product id-->
			
			$("body").on("click", ".assignpostelservice", function(){
				var id	=	$(this).attr('for');
				$.ajax(
				{
						'url'            : getUrl() + '/Linnworksapis/assignService',
						'type'           : 'POST',
						'data'           : { id : id },
						'beforeSend'	 : function() {
															$('.loading-image_'+id).show();
														},
						'success' 		 : function( msgArray )
														{
															$('.pop-up-'+id+' h4').text(msgArray);
															$('.loading-image_'+id).hide();
															$('.processedorder_'+id).show();
															$('.assignpostelservice_'+id).hide();
														}  
						});  
					});
			
			$("body").on("click", ".processedorder", function(){
				var id	=	$(this).attr('for');
				$.ajax(
					{
						'url'          : getUrl() + '/Linnworksapis/labelAssign',
						'type'         : 'POST',
						'data'         : { id : id },
						'beforeSend'   : function() {
														$('.loading-image_'+id).show();
													 },
						'success' 	   : function( msgArray )
													{
														var result = msgArray.split("#");
														$('.printorder_'+id).attr('href', result[0]);
														$('.printlable_'+id).attr('href', result[1]);
														$('.loading-image_'+id).hide();
														$('.printorder_'+id).show();
														$('.printlable_'+id).show();
														$('.processedorder_'+id).hide();
													}  
					});  
				});
				
			$("body").on("click", ".switch", function(){
				if($(".top_panel").is(":visible") == true)
				{
					$('.top_panel').hide();
					$('.bottom_panel').show();
				}
				else
				{
					$('.top_panel').show();
					$('.bottom_panel').hide();
				}
				
				});
			
			/*$('div#example1_wrapper table#example1 thead.parentCheck tr.parentInner th.sorting_asc').click(function()
			{ 		
				 if( $(this).children().hasClass( 'checked' ) )
				 {
					$(this).children().removeClass( 'checked' )
					$('.icheckbox_square-green').removeClass('checked');
					$('.download_button').css('display', 'none');								
				 }
				 else
				 {
					$('.icheckbox_square-green').addClass('checked');
					$('.download_button').css('display', 'block');				
				 }
				 
					 var skuArray = [];
					 var countryArraynew = [];
					 var blkstr = [];
					 var i = 0;
					 $('div.checked .case').each(function()
									{
											skuArray[i]	=	$(this).attr('id');
										i++;
									});
			
					$.each(skuArray, function(idx2,val2) {                    
							 var str =  val2;
							 blkstr.push(str);
						});
					
						var skuStr	=	blkstr.join("---");
						$('.get_sku_string').val(skuStr);
					});*/
			
						
			$("body").on("click", ".sortingChild", function ()
				{
					
					 var skuArray = [];
					 var countryArraynew = [];
					 var blkstr = [];
					 $('.download_button').css('display', 'none');
				
					 var i = 0;
					 $('div.checked .case').each(function()
						{
								skuArray[i]	=	$(this).attr('id');
							i++;
							if( i >= 1)
							{
								$('.download_button').css('display', 'block');
							}
						});
					 $.each(skuArray, function(idx2,val2) 
						{
							 var str =  val2;
							 blkstr.push(str);
						});
					
						var skuStr	=	blkstr.join("---");
						$('.get_sku_string').val(skuStr);
						 
					});
						
			
					
			
			/* Code for order cancel */			
			$("body").on("click", ".ordercancel", function(){
				var content	=	$(this).attr('for');
				var res 	= content.split("##$#");
				var id		=	res[0];
				$.ajax(
				{
					'url'                     : getUrl() + '/jijGroup/Order/orderCancel',
					'type'                    : 'POST',
					'data'                    : { content : content },
					'beforeSend'			  : function() {
																$('.loading-image_'+id).show();
															 },
					'success' 				  : function( msgArray )
						{
							if ( msgArray == 1 )
							{
								$('.panel-head').html('<p class="alert alert-success"> Order Cancelled Successfully.</p>').show(500).delay(5000).fadeOut();
								$('.loading-image_'+id).hide();
								location.reload();
							}
						}  
				});  
			});
		});
		
		
</script>

