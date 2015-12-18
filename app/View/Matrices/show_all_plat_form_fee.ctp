<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
			<h1 class="page-title"><?php //print $role;?></h1>
			<div class="panel-title no-radius bg-green-500 color-white no-border"></div>
			<div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
								<a class="switch btn btn-success" href="/wms/JijGroup/addplatformfee" data-toggle="modal" data-target=""><i class=""></i> Add Platform Fee </a>
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
											<table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
													<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">S.No.</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Country Name</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Packaging Type</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Dimensions</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Shipping Weight(Kg)</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Packaging Fee</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">fee</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Action</th>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
                                    <?php $i = 1; foreach($plateformfeeDetails as $plateformfeeDetail) {  
										?>
                                            <tr class="odd">
												<td class="sorting_1"><?php print $i; ?></td>
												<td class="sorting_1"><?php print $plateformfeeDetail['Location']['county_name']; ?></td>                                                
												<td class="sorting_1"><?php print $plateformfeeDetail['AmazonPlatformFee']['packaging_type']; ?></td>                                                
												<td class="sorting_1"><?php print '('.$plateformfeeDetail['AmazonPlatformFee']['length'].' x '. $plateformfeeDetail['AmazonPlatformFee']['width'].' x '.$plateformfeeDetail['AmazonPlatformFee']['height'].')' ?></td>                                                
												<td class="sorting_1"><?php print $plateformfeeDetail['AmazonPlatformFee']['min_weight'].' - '. $plateformfeeDetail['AmazonPlatformFee']['max_weight']; ?></td>                                                
												<td class="sorting_1"><?php print $plateformfeeDetail['AmazonPlatformFee']['packaging_min_weight'].' - '. $plateformfeeDetail['AmazonPlatformFee']['packaging_max_weight']; ?></td>                                                
												<td class="sorting_1"><?php print $plateformfeeDetail['AmazonPlatformFee']['fee']; ?></td>                                                
											    <td class="sorting_1">
													<ul id="icons" class="iconButtons">
														<li>
															<a href="/wms/Matrices/editAmazonFee/<?php print $plateformfeeDetail['AmazonPlatformFee']['id']; ?>" class="btn btn-success btn-xs margin-right-10" title="Edit Provider" ><i class="fa fa-pencil"></i></a>
														</li>
														<li>
															<a href="javascript:void(0);" for="<?php print $plateformfeeDetail['AmazonPlatformFee']['id']; ?>" class="delete_fee btn btn-danger btn-xs margin-right-10" title="Delete Plateform Fee" ><i class="fa fa-close"></i></a>
														</li>
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
			$("body").on("click", ".delete_fee", function(){
				var id	=	$(this).attr('for');
				swal({
					title: "Are you sure?",
					text: "You want to delete Plateform fee !",
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
				'url'            : getUrl() + '/Matrices/deleteamazonfee',
						'type'           : 'POST',
						'data'           : { id : id },
						'success' 		 : function( msgArray )
														{
															if(msgArray == 1)
															{
																 swal("Plateform fee delete successfully", "" , "success");
																 location.reload();
															}
															if(msgArray == 2)
															{
																swal("There is an error!", "" , "success");
																location.reload();
															}
														}  
                              
            });            
        }
        else
        {
            swal("Cancelled", "Your record is safe :)", "error");
        }
    });
				
				
				
				
				
				
				
				/*$.ajax(
				{
						'url'            : getUrl() + '/Matrices/deleteprovider',
						'type'           : 'POST',
						'data'           : { id : id },
						'success' 		 : function( msgArray )
														{
															if(msgArray == 1 || msgArray == 2)
															{
																location.reload();
															}
														}  
						}); */ 
					});
		});
</script>



