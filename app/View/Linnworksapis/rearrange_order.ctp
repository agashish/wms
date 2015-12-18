<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">
		 <h1 class="page-title"><?php echo "Order Rearrange"; ?></h1>
				<div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
								<a class="btn btn-success" href="/wms/linnworksapis/rearrangeOrder" data-toggle="modal" data-target=""><i class=""></i> Synchronize </a>
							</li>
							<li>
								<a href="/wms/JijGroup/Generic/Order/GetOpenFilter" type="submit" class="printorder btn bg-orange-500 color-white btn-dark padding-left-40 padding-right-40" >Go Back</a>
							</li>
						</ul>
					</div>
				</div>
		<div class="panel-title no-radius bg-green-500 color-white no-border">
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>
		</div>
    </div>
    <div class="container-fluid">
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
								//echo $expressOne->GeneralInfo->ReceivedDate; ?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $expressOne->OrderId; ?>"><i class="ion-clipboard"></i></a></td>
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
								//echo $standerdOne->GeneralInfo->ReceivedDate; ?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $standerdOne->OrderId; ?>"><i class="ion-clipboard"></i></a></td>
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
								//echo $trackedOne->GeneralInfo->ReceivedDate; ?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $trackedOne->OrderId; ?>"><i class="ion-clipboard"></i></a>
								</td>
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
								
								//echo $expressTwo->GeneralInfo->ReceivedDate; ?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $expressTwo->OrderId; ?>"><i class="ion-clipboard"></i></a></td>
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
								
								//echo $standerdTwo->GeneralInfo->ReceivedDate; ?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $standerdTwo->OrderId; ?>"><i class="ion-clipboard"></i></a></td>
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
								//pr($trackedDate);
								//echo $trackedTwo->GeneralInfo->ReceivedDate; ?></td>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target=".pop-up-<?php echo $trackedTwo->OrderId; ?>"><i class="ion-clipboard"></i></a></td>
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

<!--Start Popup for all order-->
<?php foreach($results as $result) { ?>
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
						<a href="javascript:void(0);" for = "<?php echo $result->OrderId; ?>" class="assignpostelservice assignpostelservice_<?php echo $result->OrderId; ?> btn bg-orange-500 color-white btn-dark padding-left-40 padding-right-40" >Assign Postel Service</a>
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

	$(document).ready(function()
        { 
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
		});
		
		

</script>
