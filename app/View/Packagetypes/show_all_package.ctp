<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>
        <?php print $this->Session->flash(); ?>
			<div class="panel-title no-radius bg-green-500 color-white no-border">
				<div class="panel-head"></div>
			</div>
    </div>
    <!-- END PAGE HEADING -->
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
													<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Role Name: activate to sort column ascending">PackageType Name</th>																								
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Role Name: activate to sort column ascending">Action</th>																								
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?php
											if( count( $packageType ) > 0 ) :
										?>
											<?php
												$roleArray = Configure::read( 'roles_key' );													
												$i = 1;foreach( $packageType as $index => $value ) :
												$id = $value['Packagetype']['id'];													
											?>
													<tr class="odd">
														<td class="  sorting_1"><?php print $i; ?></td>
														<td class="  sorting_1"><?php print $value['Packagetype']['package_type_name']; ?></td>	
														<td class="  sorting_1">
															<a href="/wms/Packagetypes/editPackage/<?php print $value['Packagetype']['id']; ?>" title="Edit" class="btn btn-success btn-xs margin-right-10"><i class="fa fa-pencil"></i></a>
															<a href="javascript:void(0);" alt="Retrieve" for = "<?php print $value['Packagetype']['id']; ?>" class="delete_package_type btn btn-danger btn-xs margin-right-10"><i class="fa fa-close"></i></a>
														</td>													
													</tr>
											<?php
												$i++;
												endforeach;
											?>
										<?php
											endif;
										?>
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
			$("body").on("click", ".delete_package_type", function(){
				var id	=	$(this).attr('for');
				swal({
					title: "Are you sure?",
					text: "You want to delete package type !",
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
            /* delete the  package envelope */
            $.ajax(
            {
				'url'            : getUrl() + '/Packagetypes/deletepackagetype',
				'type'           : 'POST',
				'data'           : { id : id },
				'success' 		 : function( msgArray )
										{
											if(msgArray == 1)
											{
												 swal("package type delete successfully", "" , "success");
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
            swal("Cancelled", "Your PackageType is safe :)", "error");
        }
			});
		});
	});
</script>

