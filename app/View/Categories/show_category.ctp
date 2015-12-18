<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>
			<div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
								<a class="btn btn-success" href="/wms/manageCategory" data-toggle="modal" data-target=""><i class="fa fa-tasks"></i> Add Category </a>
							</li>
						</ul>
					</div>
				</div>	
				
			<div class="panel-title no-radius bg-green-500 color-white no-border">
			</div>
			
			<div class="panel-head"><?php print $this->Session->flash(); ?></div>
		
    </div>
    <!-- END PAGE HEADING -->
    <?php //pr($getAllCategories); ?>
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
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Category Name</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status Type: activate to sort column ascending">Status</th>
												<th rowspan="1" colspan="1" title = "Edit County Name" >Action</th>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?php foreach($getAllCategories as $category) { 
											$alertClass = ( $category['Category']['is_deleted'] == 1 ) ? "alert-danger" : "";
											?>
                                            <tr class="odd <?php print $alertClass; ?>">
												<td class="  sorting_1"><?php echo $category['Category']['id']; ?></td>
												<td class="  sorting_1"><?php echo $category['Category']['category_name']; ?></td>                                                
											    <td class="  sorting_1"><?php echo ($category['Category']['status'] == 0) ? "Active" : "Deactive"; ?></td>
                                                <td>
													<ul id="icons" class="iconButtons">
														
														<a href="editCategory/<?php echo $category['Category']['id']; ?>" class="btn btn-success btn-xs margin-right-10"><i class="fa fa-pencil"></i></a>
														<?php if($category['Category']['status'] == 0) { ?>	
														<a href="activedeactive/<?php echo $category['Category']['id']; ?>/<?php print "active"; ?>" class="btn btn-info btn-xs margin-right-10"><i class="fa fa-unlock"></i></a>
														<?php } else { ?>
														<a href="activedeactive/<?php echo $category['Category']['id']; ?>/<?php print "deactive"; ?>" class="btn btn-info btn-xs margin-right-10"><i class="fa fa-lock"></i></a>
														<?php } if($category['Category']['is_deleted'] == 0) { ?>
														<a href="deleteCAT/<?php echo $category['Category']['id']; ?>/<?php print $category['Category']['is_deleted']; ?>" class="btn btn-warning btn-xs margin-right-10"><i class="ion-plus-round"></i></a>
														<?php } else { ?>
														<a href="deleteCAT/<?php echo $category['Category']['id']; ?>/<?php print $category['Category']['is_deleted']; ?>" class="btn btn-warning btn-xs margin-right-10"><i class="ion-minus-round"></i></a>
														<?php } ?>
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

