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
										<a href="/wms/linnworksapis/dispatchConsole"   class="btn bg-orange-500 color-white btn-dark ">Skip</a>
										<a href=""  target="_blank" for = "<?php echo $id; ?>" class="printorder btn bg-orange-500 color-white btn-dark "  target="_blank" style="opacity : .5;" >Print Label</a>
										<a href=""  target="_blank" for = "<?php echo $id; ?>" class="printlable btn bg-orange-500 color-white btn-dark "  target="_blank" style="opacity : .5;">Print Slip</a>
										<a href="javascript:void(0);" for = "<?php echo $id; ?>" class="processedorder processedorder_<?php echo $id; ?> btn bg-green-500 color-white btn-dark " style="opacity : .5;" >Process</a>
										
										
							</div>
						</div>
<div class="panel-body">
              <div class="barcodemsg" ></div>						
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-1 panel-body">
								<label class="control-label col-lg-2" for="LinnworksapisBarcode">Barcode</label>
									<div class="input text col-lg-6"><input type="text" id="LinnworksapisBarcode" index="0" class="get_sku_string col-lg-6 form-control" value="" name="data[Linnworksapis][barcode]"></div>
									<input type ="hidden" id="Linnworksapisid" value="<?php echo $getOrderDeatils['Order']['id']; ?>"/>
							</div>
							<div class="tracking col-lg-4 panel-body" style="display:none;">
								<label class="control-label col-lg-2" for="Linnworksapispostal">Postal Tracking</label>
									<div class="input text col-lg-6"><input type="text" id="Linnworksapispostaltracking" index="0" class="" value="" name="data[Linnworksapis][barcode]" ></div>
									<input type ="hidden" id="Linnworksapispkorderid" value="<?php echo $id; ?>"/>
									<input type ="hidden" id="Linnworksapispostalservice" value="<?php echo $getOrderDeatils['Order']['postal_service']; ?>"/>
								</div>
							</div>
							
							<div class="outer_bin_addMore">
					<table class="table table-bordered table-striped dataTable" >
							<tr>
								<th>SKU</th>
								<th>Item title</th>
								<th>BarCode</th>
								<th>Scanned Qty</th>
								<th>Quantity</th>
								<th>Unit Cost</th>
								<th>Disc. %</th>
								<th>Tax</th>
								<th>Line</th>
								<th>Completed</th>
							</tr>
							<?php foreach($getOrderDeatils['Item'] as $item ) { ?>
							<tr class="quantity" id="<?php echo $item['id']; ?>" >
									<td><?php echo $item['sku']; ?></td>
									<td><?php echo $item['title']; ?></td>
									<td><?php echo $item['barcode']; ?></td>
									<td class="upqty_<?php echo $item['id']; ?>" id="aaa"><?php echo $item['updatequantity']; ?></td>
									<td class="qty_<?php echo $item['id']; ?>"><?php echo $item['quantity']; ?></td>
									<td><?php echo $item['priceperunit']; ?></td>
									<td><?php echo $item['discount']; ?></td>
									<td><?php echo $item['tax']; ?></td>
									<td><?php echo $item['costinctax']; ?></td>
									<td class="postal_service" ><?php echo $getOrderDeatils['Order']['postal_service']; ?> &nbsp;</td>
									<td class="complete_<?php echo $item['id']; ?>">No</td>
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
	</div>
<script>

$(function() {
  $("#LinnworksapisBarcode").focus();
 			var innercount = 0;
			var outercount = 0;
			$('.quantity ').each(function()
				{
					innercount++;
						var id = $(this).attr('id');
						if($('.upqty_'+id).text() == $('.qty_'+id).text())
						{ 
							$('.complete_'+id).html('<a class=" count btn btn-success btn-xs margin-right-10" title="" href=""><i class="ion-checkmark"></i></a>');
						}
				});
				
			$('.count').each(function()
				{
					outercount++;
						var id = $(this).attr('id');
						
				});
				if(innercount == outercount)
				{
					var id = $('.printlable').attr('for');
					$.ajax({
						
							'url'            : getUrl() + '/Linnworksapis/generatepdf',
							'type'           : 'POST',
							'data'           : { pkorderid : id},
							'beforeSend'	 : function() {
															$('.loading-image').show();
															},
							'success'		 : function( data )
												{
													var result = data.split("#");
													$('.printorder').attr('href', result[0]);
													$('.printlable').attr('href', result[1]);
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
												}
						});
				}
			
			$("body").on("click", ".processedorder", function(){
				var id	=	$(this).attr('for');
				$.ajax(
					{
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
							'dataType'		 : "json",
							'data'           : { trackingBarcode : trackingBarcode,  pkorder : pkorder, postalservice : postalservice },
							'beforeSend'	 : function(){
															$('.loading-image').show();
														 },
							'success' 		 : function( msgArray )
														{
															   $('.loading-image').hide();
																window.location.href = getUrl()+"/linnworksapis/dispatchConsole";
														}
						});
	}
function submitSanningValue()
{
	var Barcode	=	$('#LinnworksapisBarcode').val();
	var pkorder	=	$('#Linnworksapisid').val();
	$('#LinnworksapisBarcode').val('');
	$.ajax(
				{
						'url'            : getUrl() + '/Linnworksapis/completethebarcode',
						'type'           : 'POST',
						'dataType'		 : "json",
						'data'           : { barcode : Barcode,  pkorder : pkorder},
						'success' 		 : function( msgArray )
														{
															$('.upqty_'+msgArray.id).text(msgArray.msg);
															if(msgArray.status == 1)
															{
																var innercount = 0;
																var outercount = 0;
																var flag;
																$('.quantity ').each(function()
																	{
																		innercount++;
																			var id = $(this).attr('id');
																			if($('.upqty_'+id).text() == $('.qty_'+id).text())
																			{ 
																				$('.complete_'+id).html('<a class=" count btn btn-success btn-xs margin-right-10" title="" href=""><i class="ion-checkmark"></i></a>');
																			}
																	});
																	
																$('.count').each(function()
																	{
																		outercount++;
																			var id = $(this).attr('id');
																			
																	});
																	if(innercount == outercount)
																	{
																		var id = $('.printlable').attr('for');
																		$.ajax({
																			
																				'url'            : getUrl() + '/Linnworksapis/generatepdf',
																				'type'           : 'POST',
																				'data'           : { pkorderid : id},
																				'beforeSend'	 : function() {
																												$('.loading-image').show();
																												},
																				'success'		 : function( data )
																									{
																										var result = data.split("#");
																										$('.printorder').attr('href', result[0]);
																										$('.printlable').attr('href', result[1]);
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
																										window.open(result[0],'_blank');
																										window.open(result[1],'_blank');
																									}
																			});
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
	$.ajax(
					{
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
