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
								<a class="switch btn btn-success" href="/wms/JijGroup/showallmatrix" data-toggle="modal" data-target=""><i class=""></i> Show Postal Service </a>
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
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Provider Name</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Action</th>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
                                    <?php $i = 1; foreach($getAllProviders as $getAllProvider) { ?>
                                            <tr class="odd">
												<td class="sorting_1"><?php print $i; ?></td>
												<td class="sorting_1"><?php print $getAllProvider['PostalProvider']['provider_name']; ?></td>                                                
											    <td class="sorting_1">
													<ul id="icons" class="iconButtons">
														<li>
															<a href="/wms/Matrices/editprovider/<?php print $getAllProvider['PostalProvider']['id']; ?>" class="btn btn-success btn-xs margin-right-10" title="Edit Provider" ><i class="fa fa-pencil"></i></a>
														</li>
														<li>
															<!--<a href="/wms/Matrices/deleteprovider/<?php print $getAllProvider['PostalProvider']['id']; ?>" class="btn btn-danger btn-xs margin-right-10" title="Delete Provider" ><i class="fa fa-close"></i></a>-->
															<a href="javascript:void(0);" for="<?php print $getAllProvider['PostalProvider']['id']; ?>" class="delete_provider btn btn-danger btn-xs margin-right-10" title="Delete Provider" ><i class="fa fa-close"></i></a>
														</li>
													</ul>
                                                </td>
                                            </tr>
                                            <?php $i++; } ?>
                                    </tbody>
									</table>		
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
			$("body").on("click", ".delete_provider", function(){
				var id	=	$(this).attr('for');
				swal({
					title: "Are you sure?",
					text: "You want to delete service provider !",
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
				'url'            : getUrl() + '/Matrices/deleteprovider',
						'type'           : 'POST',
						'data'           : { id : id },
						'success' 		 : function( msgArray )
														{
															if(msgArray == 1)
															{
																 swal("Please delete postal service first", "" , "success");
																 location.reload();
															}
															if(msgArray == 2)
															{
																swal("Postal provider delete successfully!", "" , "success");
																location.reload();
															}
														}  
                              
            });            
        }
        else
        {
            swal("Cancelled", "Your provider is safe :)", "error");
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



