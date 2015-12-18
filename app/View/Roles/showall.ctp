<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>
		
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
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Role Name: activate to sort column ascending">Role Name</th>
												<!--<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Role Type: activate to sort column ascending">Role Type</th>-->
												<th role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" title = "Edit Role Name" >Action</th>
												<!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 200px;" aria-label="Browser: activate to sort column ascending">Browser</th>
												<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 182px;" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th>
												<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 153px;" aria-label="Engine version: activate to sort column ascending">Engine version</th>
												<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 113px;" aria-label="CSS grade: activate to sort column ascending">CSS grade</th></tr>-->
										</thead>
										
										<!--<tfoot>
											<tr>
												<th rowspan="1" colspan="1">Rendering engine</th>
												<th rowspan="1" colspan="1">Browser</th>
												<th rowspan="1" colspan="1">Platform(s)</th>
												<th rowspan="1" colspan="1">Engine version</th>
												<th rowspan="1" colspan="1">CSS grade</th>
											</tr>
										</tfoot>-->
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?php
											if( count( $getRoleArray ) > 0 ) :
										?>
											<?php
												$roleArray = Configure::read( 'roles_key' );													
												$i = 0;foreach( $getRoleArray as $index => $value ) :
												$id = $value['Role']['id'];													
											?>
													<tr class="odd">
														<td class="  sorting_1"><?php print $value['Role']['id']; ?></td>
														<td class="  sorting_1"><?php print $value['Role']['role_name']; ?></td>
														<!--<td class="  sorting_1"><?php print $value['roletypes']['type_name']; ?></td>-->
														<td><a href="editRoles/<?php print $id; ?>" class="btn btn-success btn-xs margin-right-10"><i class="fa fa-pencil"></i></a></td>                                                                    
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

