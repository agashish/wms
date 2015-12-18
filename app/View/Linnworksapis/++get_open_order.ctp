<?php
		App::import('Vendor', 'linnwork/api/Auth');
		App::import('Vendor', 'linnwork/api/Factory');
		App::import('Vendor', 'linnwork/api/Orders');
	
		$username = "jijgrouptest@gmail.com";
		$password = "#noida15";
		$multi = AuthMethods::Multilogin($username, $password);
		
		$auth = AuthMethods::Authorize($username, $password, $multi[0]->Id);	

		$token = $auth->Token;	
		$server = $auth->Server;
		
		$results	=	OrdersMethods::GetOpenOrders('100','1','','','00000000-0000-0000-0000-000000000000','',$token, $server);
		//echo "<pre>";
		//print_r($results);
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
								  		<div style="float:right; download_button" style="display:none;" >
													<?php
														echo  $this->form->create('Linnworksapis', array( 'class'=>'form-horizontal bv-form', 'type'=>'post','id'=>'getFilterOrderCsv','enctype'=>'multipart/form-data', 'action' => 'generatePickList'));
														echo  $this->form->hidden('Linnworksapis.orderid', array('class' => 'get_sku_string' ));
														echo  $this->Form->button('Download', array('type' => 'submit', 'style'=>'display:none', 'escape' => true,'class'=>'download_button add_search_field btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'));
														echo  $this->form->end();
													?>
										</div>
										<div style="float:right;">
											<?php 
														echo  $this->form->create('Linnworksapis', array( 'class'=>'form-horizontal bv-form', 'type'=>'post','id'=>'rearrangeorder','enctype'=>'multipart/form-data', 'action' => 'rearrangeOrder'));
														foreach($results->Data as $result)
																{
																	$ids[]	=	$result->OrderId;
																}
																$id		=	 implode("##$#",$ids);
														echo  $this->form->hidden('Linnworksapis.data', array('class' => '', 'value'=>$id));
														echo  $this->Form->button('Rearrange', array('type' => 'submit', 'escape' => true,'class'=>'download_button add_search_field btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'));
														echo  $this->form->end();
											?>
										</div>
										
								  		<table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
										<thead class="parentCheck" >
											<tr role="row" class="parentInner" >
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
													<input type="checkbox" name="skutouploadID" id="selectall" class="select_all" >Select All
													</th>
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
												<td class=" sorting_1 sortingChild" style="width:100px;" >	
													<input type="checkbox" class ="case" name="skutouploadID" id="<?php echo $result->NumOrderId; ?>" onclick="get_sku();" >
												</td>
												<td class="  sorting_1"><?php echo $result->NumOrderId; ?></td>
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
														<a href="javascript:void(0);" for="<?php echo $id; ?>" title="Delete Order" class="orderDelete btn btn-danger btn-xs margin-right-10" ><i class="fa fa-close"></i></a>
														<a href="javascript:void(0);" for="<?php echo $id; ?>" title="Process Order" class="orderProcess btn btn-success btn-xs margin-right-10" ><i class="ion-clipboard"></i></a>
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
</div>


<script>

 $(document).ready(function()
        { 
			$('div#example1_wrapper table#example1 thead.parentCheck tr.parentInner th.sorting_asc').click(function()
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
						 
					});
			
						
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
						
			
			/* Code for process order */
			$("body").on("click", ".orderProcess", function(){
				var id	=	$(this).attr('for');
				$.ajax(
				{
					'url'                     : getUrl() + '/jijGroup/Order/orderProcess',
					'type'                    : 'POST',
					'data'                    : { id : id },
					'beforeSend'			  : function() {
																$('.loading-image_'+id).show();
															 },
					'success' 				  : function( msgArray )
						{
							
							if ( msgArray == 1 )
							{
								$('.panel-head').html('<p class="alert alert-success"> Order Processed Successfully.</p>').show(500).delay(5000).fadeOut();
								$('.loading-image_'+id).hide();
								location.reload();
							}
						}  
				});  
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
						
			/* Ajax Code for order delete */	
			$("body").on("click", ".orderDelete", function(){
				var id	=	$(this).attr('for');
				
				$.ajax(
				{
					'url'                     : getUrl() + '/jijGroup/Order/orderDelete',
					'type'                    : 'POST',
					'data'                    : { id : id },
					'beforeSend'			  : function() {
																$('.loading-image_'+id).show();
															 },
					'success' 				  : function( msgArray )
						{
							if ( msgArray == 1 )
							{
								$('.panel-head').html('<p class="alert alert-success"> Order Deleted Successfully.</p>').show(500).delay(5000).fadeOut();
								$('.loading-image_'+id).hide();
								location.reload();
							}
						}  
				});  
			});
				
					
					
			});
			
			
</script>

