<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
			<h1 class="page-title"><?php //print $role;?></h1>
			<div class="panel-title no-radius bg-green-500 color-white no-border"></div>
				<div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
								<a class="switch btn btn-success" href="/wms/JijGroup/addPostalProvider" data-toggle="modal" data-target=""><i class=""></i> Add Postal Provider </a>
							</li>
							<li>
								<a class="switch btn btn-success" href="/wms/JijGroup/showallpostalprovider" data-toggle="modal" data-target=""><i class=""></i> Show Postal Provider </a>
							</li>
						</ul>
					</div>
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
								<?php //pr($getallservices); ?>
                                <div class="panel-body no-padding-top bg-white">	
<div class="table-responsive">								
											<table style="table-layout:fixed" class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
													<thead><tr>
<th width="30px">Id</th>
<th width="100px">Warehouse</th>
<th width="100px">Courier</th>
<th width="125px">Delivery Country</th>
<th width="220px">Service Name</th>
<th width="140px">Provider Ref Code</th>
<th width="100px">Service Level</th>
<th width="100px">Per item</th>
<th width="100px">Per kilo</th>
<th width="100px">CCY of Prices</th>
<th width="110px">Max Weight(kg)</th>
<th width="100px">Tracked</th>
<th width="110px">Min Length (mm)</th>
<th width="130px">Max Length (mm)</th>
<th width="110px">Min Width (mm)</th>
<th width="110px">Max Width (mm)</th>
<th width="110px">Min Height (mm)</th>
<th width="110px">Max Height (mm)</th>
<th width="100px">Delivery Time</th>
<th width="100px">CN22 Required</th>
<th width="100px">Manifest</th>
<th width="100px">LVCR</th>
<th width="100px">Max Product Amount</th>
<th width="100px">Max Shipping Amount</th>
<th width="140px">Action</th>
</tr>
</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
                                    <?php 
											$conversionRate	=	$this->Common->getconversionrate();
											$conRate	=	$conversionRate[0]['CurrencyExchange']['rate'];
											
											foreach($getallservices as $getallservice) { 
											$id 	= $getallservice['PostalServiceDesc']['id'];
											$status = $getallservice['PostalServiceDesc']['status'];
										?>
                                            <tr>
												<td><?php print $getallservice['PostalServiceDesc']['id']; ?></td>
												<td><?php print $getallservice['PostalServiceDesc']['warehouse']; ?></td>                                                
												<td><?php print $getallservice['PostalProvider']['provider_name']; ?></td>
												<td><?php print $getallservice['Location']['county_name']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['service_name']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['provider_ref_code']; ?></td>
                                                <td><?php print $getallservice['ServiceLevel']['service_name']; ?></td>
                                                <td><?php print $this->Number->precision($getallservice['PostalServiceDesc']['per_item']*$conRate, 3); ?></td>
                                                <td><?php print $this->Number->precision($getallservice['PostalServiceDesc']['per_kilo']*$conRate, 3); ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['ccy_prices']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['max_weight']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['tracked']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['min_length']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['max_length']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['min_width']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['max_width']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['min_height']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['max_height']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['delivery_time']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['cn_required']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['manifest']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['lvcr']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['lvcr_max_product_amount']; ?></td>
                                                <td><?php print $getallservice['PostalServiceDesc']['lvcr_max_shipping_amount']; ?></td>
                                                <td>
													<ul id="icons" class="iconButtons">
														<li>
															<a href="/wms/Matrices/editdeleverymatrix/<?php print $id; ?>" class="btn btn-success btn-xs margin-right-10"><i class="fa fa-pencil"></i></a>
														</li>
														<li>
															<?php if( $getallservice['PostalServiceDesc']['status'] == 1 )	{ ?>
																<a href="/wms/Matrices/lockunlockamtrix/<?php print $id; ?>/<?php print $status; ?>" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-unlock"></i></a>
															<?php }	else {	?>
																<a href="/wms/Matrices/lockunlockamtrix/<?php print $id; ?>/<?php print $status; ?>" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-lock"></i></a>
															<?php }	?>
														</li>
														<li>
															<a href="javascript:void(0);" for ="<?php print $id; ?>" class="delete_service btn btn-danger btn-xs margin-right-10" title = "Delete service" ><i class="fa fa-close"></i></a>
														</li>
														</ul>
                                                
                                                
                                                </td>
                                            </tr>
                                     <?php } ?>
                                   	</tbody>
									</table>
</div>									
								</div>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /. row -->
				<!-- BEGIN FOOTER -->
				<?php echo $this->element('footer'); ?>
				<!-- END FOOTER -->
            </div>
    </div>
</div>


<script>


$(document).ready(function()
        { 
			$("body").on("click", ".delete_service", function(){
				var id	=	$(this).attr('for');
				swal({
					title: "Are you sure?",
					text: "You want to delete postal service !",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, delete it!",
					cancelButtonText: "No, cancel!",
					closeOnConfirm: false,
					closeOnCancel: false
				},
    function(isConfirm)
    {
        /* isConfirm tell us true or false */
        if (isConfirm)
        {
            var strAction = "update";
            /* Start here updating section */
            $.ajax(
            {
						'url'            : getUrl() + '/Matrices/deletepostalservice',
						'type'           : 'POST',
						'data'           : { id : id },
						'success' 		 : function( msgArray )
														{
															if(msgArray == 1)
															{
																 swal("Postal service deleted successfully.", "" , "success");
																 location.reload();
															}
															if(msgArray == 2)
															{
																swal("There is an error !", "" , "success");
																location.reload();
															}
														}  
                              
            });            
        }
        else
        {
            swal("Cancelled", "Your service is safe :)", "error");
        }
				});
				
			});
		});


</script>


