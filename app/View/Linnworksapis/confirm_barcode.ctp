<?php 
$id = $detail['NumOrderId'];
$pkId = $detail['OrderId'];
?>

<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php echo "Confirm"; ?></h1>
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="panel">
			  <div class="panel-title">
					<div class="panel-head">Barcode Scan Section</div>
					<div class="panel-tools">
						<a href="" class="loading-image" style="display:none;"><?php echo $this->Html->image('image_889915.gif', array('width' => '20', 'height' => '20')); ?></a>
						<a href="/wms/linnworksapis/dispatchConsole"  class="btn bg-orange-500 color-white btn-dark ">Skip</a>
						<a href="javascript:void(0);"  for = "<?php echo $id; ?>" class="printlable btn bg-orange-500 color-white btn-dark"  style="opacity : .5;" >Print Slip</a>
						<a href="javascript:void(0);"  for = "<?php echo $id; ?>" class="printorder btn bg-orange-500 color-white btn-dark"  style="opacity : .5;" >Print Label</a>
						<a href="javascript:void(0);" for = "<?php echo $id; ?>" class="processedorder processedorder_<?php echo $id; ?> btn bg-green-500 color-white btn-dark" style="display:none;" >Process</a>
					</div>
			  </div>
			  <div class="panel-body">
              <div class="barcodemsg" ></div>                            
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-1">
                            
								<div class="input text"><label for="LinnworksapisBarcode">Barcode</label>
									<input type="text" id="LinnworksapisBarcode" index="0" class="form-control get_sku_string" value="" name="data[Linnworksapis][barcode]">
									<p class="help-block">Please scan again to processing order</p>
									</div>
									<input type ="hidden" id="Linnworksapisid" value="<?php echo $detail['NumOrderId']; ?>"/>
							</div>
							<div class="tracking col-lg-4 col-lg-offset-1" style="display:none;">
								<div class="input text"><label for="Linnworksapispostal">Postal Tracking</label>
									<input type="text" id="Linnworksapispostaltracking" index="0" class="form-control" value="" name="data[Linnworksapis][barcode]" >
									<p class="help-block">Please fill postal tracking here</p>
									</div>
									<input type ="hidden" id="Linnworksapispkorderid" value="<?php echo $id; ?>"/>
									<input type ="hidden" id="Linnworksapispostalservice" value="<?php echo $detail['ShippingInfo']['PostalServiceName']; ?>"/>
								</div>
							</div>
							<label><span>Orders containing barcode : <span><span class="searchbarcode"></span></label>
						<div class="outer_bin_addMore">
					<table class="table table-bordered table-striped dataTable" >
							<tr>
								<th>Order</th>
								<th>SKU</th>
								<th>BarCode</th>
								<th>Scanned Qty</th>
								<th>Quantity</th>
								<!--<th>Unit Cost</th>
								<th>Disc. %</th>
								<th>Tax</th>
								<th>Line</th>
								<th>Postal Service</th>-->
								<th>Postal Service</th>
								<th>Completed</th>
							</tr>
							<?php $i = 0; foreach($detail['Items'] as $item ) { 
								
								$orderId	=	$detail['NumOrderId'];
								$barcode	=	$item['OrderItem']['barcode'];
								
								App::import('Controller', 'Linnworksapis');
								$checkproduct =	new LinnworksapisController;
								$qty	=	$checkproduct->getQuantity( $orderId, $barcode );
								?>
							<tr class="quantity" id="<?php echo $detail['NumOrderId']; ?>" >
									<td><?php echo $detail['NumOrderId']; ?></td>
									<td><?php echo $item['OrderItem']['sku']; ?></td>
									<td><?php echo $item['OrderItem']['barcode']; ?></td>
									<td for = "<?php echo $i ?>" id = "barco_<?php echo $item['OrderItem']['barcode']; ?>" class="upqty_<?php echo $i; ?>_<?php echo $detail['NumOrderId']; ?>" id="aaa"><?php echo $qty; ?></td>
									<td for = "<?php echo $i ?>" class="qty_<?php echo $i; ?>_<?php echo $detail['NumOrderId']; ?>"><?php echo $item['OrderItem']['quantity']; ?></td>
									<!--<td><?php echo $item['PricePerUnit']; ?></td>
									<td><?php echo $item['Discount']; ?></td>
									<td><?php echo $item['Tax']; ?></td>
									<td><?php echo $item['CostIncTax']; ?></td>-->
									<td class="postal_service" ><?php echo $detail['ShippingInfo']['PostalServiceName']; ?> &nbsp;</td>
									<td class="complete_<?php echo $i; ?>_<?php echo $detail['NumOrderId']; ?>">No</td>
							</tr>
							<?php $i++; } ?>
						</table>
					</div>	
						</div>
						</div>
					</div>
					
				</div>
				
			</div>
		</div>        
	</div>

<script>

$(function() { 
  $("#LinnworksapisBarcode").focus();
	//var Barcode	=	$('#LinnworksapisBarcode').val();
	//var pkorder	=	$('#Linnworksapisid').val();
	//var count = $('#barco_'+Barcode).attr('for');
  
 			var innercount = 0;
			var outercount = 0;
			var i=0;
			$('.quantity ').each(function()
				{
					
					innercount++;
						var id = $(this).attr('id');
						if($('.upqty_'+i+'_'+id).text() == $('.qty_'+i+'_'+id).text())
						{ 
							$('.complete_'+i+'_'+ id ).html('<a class=" count btn btn-success btn-xs margin-right-10" title="" href=""><i class="ion-checkmark"></i></a>');
						}
						i = i+1;
				});
				
			$('.count').each(function()
				{
					outercount++;
						var id = $(this).attr('id');
						
				});
				if(innercount == outercount)
				{
					var id = $('.printlable').attr('for');
					var service	=	$('.postal_service').text();
					var serviceResult	=	service.split(' ');
					if(serviceResult[0] == 'Express' || serviceResult[0] == 'Tracked' )
														{
															$('.tracking').show();
															$("#Linnworksapispostaltracking").focus();
														}
					$('.loading-image').hide();
					$.ajax({
						
							'url'            : getUrl() + '/Linnworksapis/generatepdfdirect',
							'type'           : 'POST',
							'data'           : { pkorderid : id },
							'beforeSend'	 : function() {
															$('.loading-image').show();
														  },
							'success'		 : function( data )
												{
													var result = data.split("#");
												
													$('.processedorder').css('opacity','1');
													$('.printlable').css('opacity','1');
													$('.printorder').css('opacity','1');
													var service	=	$('.postal_service').text();
													var serviceResult	=	service.split(' ');
													if(serviceResult[0] == 'Express' || serviceResult[0] == 'Tracked' )
														{
															$('.tracking').show();
															$("#Linnworksapispostaltracking").focus();
														}
													$('.loading-image').hide();
													$('.processedorder').show();
													
												}
						});
						
					$.ajax({
																			
								'url'            : getUrl() + '/Linnworksapis/domeshippingnew',
								'type'           : 'POST',
								'data'           : { pkorderid : id},
								'beforeSend'	 : function() {
																$('.loading-image').show();
																},
								'success'		 : function( data )
													{
														var result = data.split("#");
														$('.printlable').css('opacity','1');
														$('.printorder').css('opacity','1');
														$('.loading-image').hide();
														$('.processedorder').show();
													}	
						});
					
				}
				
			$("body").on("click", ".processedorder", function(){
				var id	=	$(this).attr('for');
				var user	=	'<?php echo $this->session->read('Auth.User.id'); ?>'
				
				$.ajax(
					{
						'url'          : getUrl() + '/Linnworksapis/processorder',
						'type'         : 'POST',
						'data'         : { id : id,  userID : user },
						'beforeSend'	 : function() {
															$('.loading-image').show();
															},
						'success' 	   : function( msgArray )
													{
														if(msgArray == 1)
														{
															$('.loading-image').hide();
															window.location.href = getUrl()+"/linnworksapis/dispatchConsole";
														}
														else
														{
															
														}
													}  
					});  
				});
				
				
				$("body").on("click", ".printorder", function(){
				var id	=	$(this).attr('for');
				
				$.ajax(
					{
						'url'          : getUrl() + '/Linnworksapis/domeshippingnew',
						'type'         : 'POST',
						'data'         : { pkorderid : id },
						'success' 	   : function( msgArray )
													{
														if(msgArray == 1)
														{
															
														}
														else
														{
															
														}
													}  
					});  
				});
				
				$("body").on("click", ".printlable", function(){
				var id	=	$(this).attr('for');
				
				$.ajax(
					{
						'url'          : getUrl() + '/Linnworksapis/generatepdfdirect',
						'type'         : 'POST',
						'data'         : { pkorderid : id },
						'success' 	   : function( msgArray )
													{
														if(msgArray == 1)
														{
													
														}
														else
														{
															
														}
													}  
					});  
				});
				
				
				
});
		
$(document).keypress(function(e) {
   if(e.which == 13) {
	   if($('#Linnworksapispostaltracking').val() == '')
		{
			submitSanningValue();
		}
		else
		{
			submitTrackingSanningValue();
		}
    }
});

function submitTrackingSanningValue()
{
	
	var trackingBarcode 	=	$('#Linnworksapispostaltracking').val();
	var pkorder				=	$('#Linnworksapispkorderid').val();
	var postalservice		=	$('#Linnworksapispostalservice').val();
	$('#LinnworksapisBarcode').val('');
		$.ajax({
						'url'            : getUrl() + '/Linnworksapis/asigntrackid',
						'type'           : 'POST',
						'data'           : { trackingBarcode : trackingBarcode,  pkorder : pkorder, postalservice : postalservice },
						'beforeSend'	 : function(){
														$('.loading-image').show();
													 },
						'success' 		 : function( msgArray )
													{
														   $('.loading-image').hide();
														   $('.processedorder').show();
														   $('.printlable').css('opacity','1');
														   $('.printorder').css('opacity','1');
														   $('.loading-image').hide();
														   
														   /* print slip and label after asing the track id */
														   
														   $.ajax({
						
																	'url'            : getUrl() + '/Linnworksapis/generatepdfdirect',
																	'type'           : 'POST',
																	'data'           : { pkorderid : pkorder },
																	'beforeSend'	 : function() {
																									$('.loading-image').show();
																								  },
																	'success'		 : function( data )
																						{
																							var result = data.split("#");
																						
																							$('.processedorder').css('opacity','1');
																							$('.printlable').css('opacity','1');
																							$('.printorder').css('opacity','1');
																							var service	=	$('.postal_service').text();
																							var serviceResult	=	service.split(' ');
																							if(serviceResult[0] == 'Express' || serviceResult[0] == 'Tracked' )
																								{
																									$('.tracking').show();
																									$("#Linnworksapispostaltracking").focus();
																								}
																							$('.loading-image').hide();
																							$('.processedorder').show();
																							
																						}
																			});
																		
																	$.ajax({
																															
																				'url'            : getUrl() + '/Linnworksapis/domeshippingnew',
																				'type'           : 'POST',
																				'data'           : { pkorderid : pkorder},
																				'beforeSend'	 : function() {
																												$('.loading-image').show();
																												},
																				'success'		 : function( data )
																									{
																										var result = data.split("#");
																										$('.printlable').css('opacity','1');
																										$('.printorder').css('opacity','1');
																										$('.loading-image').hide();
																										$('.processedorder').show();
																									}	
																		});
																	}
																});
																									
}

function submitSanningValue()
{
	var Barcode	=	$('#LinnworksapisBarcode').val();
	var pkorder	=	$('#Linnworksapisid').val();
	var count = $('#barco_'+Barcode).attr('for');
	
	
	$('#LinnworksapisBarcode').val('');
	$.ajax({
						'url'            : getUrl() + '/Linnworksapis/completethebarcode',
						'type'           : 'POST',
						'dataType'		 : "json",
						'data'           : { barcode : Barcode,  pkorder : pkorder},
						'success' 		 : function( msgArray )
														{
															$('.upqty_'+count+'_'+msgArray.id).text(msgArray.msg);
															if(msgArray.status == 1)
															{
																var innercount = 0;
																var outercount = 0;
																var flag;
																var i = 0;
																$('.quantity ').each(function()
																	{
																		
																			innercount++;
																			var id = $(this).attr('id');
																			if($('.upqty_'+i+'_'+id).text() == $('.qty_'+i+'_'+id).text())
																			{ 
																				$('.complete_'+i+'_'+id).html('<a class=" count btn btn-success btn-xs margin-right-10" title="" href=""><i class="ion-checkmark"></i></a>');
																			}
																			i = i+1;
																	});
																	
																$('.count').each(function()
																	{
																		outercount++;
																			var id = $(this).attr('id');
																			
																	});
																	if(innercount == outercount)
																	{
																		var id = $('.printlable').attr('for');
																		var service	=	$('.postal_service').text();
																										var serviceResult	=	service.split(' ');
																										if(serviceResult[0] == 'Express' || serviceResult[0] == 'Tracked' )
																											{
																												$('.tracking').show();
																												$("#Linnworksapispostaltracking").focus();
																											}
																		
																		if(serviceResult[0] != 'Express' && serviceResult[0] != 'Tracked' )
																		 {
																		$.ajax({
																			
																				'url'            : getUrl() + '/Linnworksapis/generatepdfdirect',
																				'type'           : 'POST',
																				'data'           : { pkorderid : id},
																				'beforeSend'	 : function() {
																												$('.loading-image').show();
																												},
																				'success'		 : function( data )
																									{
																										var result = data.split("#");
																										$('.printlable').css('opacity','1');
																										$('.printorder').css('opacity','1');
																										$('.loading-image').hide();
																										$('.processedorder').show();
																									}
																			});
																		
																		$.ajax({
																			
																				'url'            : getUrl() + '/Linnworksapis/domeshippingnew',
																				'type'           : 'POST',
																				'data'           : { pkorderid : id},
																				'beforeSend'	 : function() {
																												$('.loading-image').show();
																												},
																				'success'		 : function( data )
																									{
																										var result = data.split("#");
																										$('.printlable').css('opacity','1');
																										$('.printorder').css('opacity','1');
																										$('.loading-image').hide();
																										$('.processedorder').show();
																									}
																		});
																	}
																	}
															}
															if(msgArray == 2)
															{
																$('.barcodemsg').html('<p>Item Completed  OR Barcode dose not exist.</p>')
															}
															
														}  
						});  
					
}

$(document).keypress(function(e) {
    if(e.which == 32) {
        processOrder();
    }
});
function processOrder()
{
	var id	=	$('.processedorder').attr('for');
	$.ajax({
				'url'          : getUrl() + '/Linnworksapis/processorder',
				'type'         : 'POST',
				'data'         : { id : id },
				'beforeSend'	 : function() {
													$('.loading-image').show();
													},
				'success' 	   : function( msgArray )
											{
												if(msgArray == 1)
												{
													$('.loading-image').hide();
													window.location.href = getUrl()+"/linnworksapis/dispatchConsole";
												}
												else
												{
													
												}
											}  
			});
	
}
		
		
</script>



