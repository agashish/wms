<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>
				 <div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
								<a class="btn btn-success" href="/wms/manageBrand" data-toggle="modal" data-target=""><i class="fa fa-tasks"></i> Add Brand </a>
							</li>
						</ul>
					</div>
					</div>	
			<div class="panel-title no-radius bg-green-500 color-white no-border">
			</div>
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>
		
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
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Brand: activate to sort column descending">Brand Name</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Alias: activate to sort column ascending">Alias</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status Type: activate to sort column ascending">Status</th>
												<th rowspan="1" colspan="1" title = "Action" >Action</th>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
                                            <?php foreach($getAllBrands as $getAllBrand) { 
												$alertClass = ( $getAllBrand['Brand']['is_deleted'] == 1 ) ? "alert-danger" : "";
												?>
                                            <tr class="odd <?php print $alertClass; ?> ">
												<td class="  sorting_1"><?php echo $getAllBrand['Brand']['id']; ?></td>
												<td class="  sorting_1"><?php echo $getAllBrand['Brand']['brand_name']; ?></td>                                                
												<td class="  sorting_1"><?php echo $getAllBrand['Brand']['brand_alias']; ?></td>                                                
											    <td class="  sorting_1"><?php echo ($getAllBrand['Brand']['status'] == 0) ? "Active" : "Deactive"; ?></td>
                                                <td>
													<ul id="icons" class="iconButtons">
													<a href="Brand/edit/<?php echo $getAllBrand['Brand']['id']; ?>" class="btn btn-success btn-xs margin-right-10"><i class="fa fa-pencil"></i></a>
													<?php if($getAllBrand['Brand']['status'] == 0) { ?>	
													<a href="Brand/lock/UnlockCL/<?php echo $getAllBrand['Brand']['id']; ?>/<?php echo "active"; ?>" alt="Unlock" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-unlock"></i></a>
													<?php } else { ?>
													<a href="Brand/lock/UnlockCL/<?php echo $getAllBrand['Brand']['id']; ?>/<?php echo "deactive"; ?>" alt="Lock" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-lock"></i></a>
													<?php } if($getAllBrand['Brand']['is_deleted'] == 0) { ?>
													<a href="Brand/delete/CL/<?php echo $getAllBrand['Brand']['id']; ?>/<?php echo $getAllBrand['Brand']['is_deleted']; ?>" alt="Retrieve" class="btn btn-danger btn-xs"><i class="ion-plus-circled"></i></a>
													<?php } else { ?>
													<a href="Brand/delete/CL/<?php echo $getAllBrand['Brand']['id']; ?>/<?php echo $getAllBrand['Brand']['is_deleted']; ?>" alt="Delete" class="btn btn-danger btn-xs"><i class="ion-minus-circled"></i></a>
													<?php }  ?>
													</ul>	
												</td>												
                                            </tr>
                                            <?php } ?>
                                    
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

