<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $title;?></h1>
		<?php print $this->Session->flash();  ?>
			<div class="panel-title no-radius bg-green-500 color-white no-border">
				
				<div class="panel-head">
					<?php
						print $this->form->create( 'User', array( 'class'=>'form-horizontal') );
					?>
					
				</div>
			</div>
		
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
       <div class="row">
				<div class="col-lg-12">
						<div class="panel no-border ">
							<div class="panel-title bg-white no-border">
							<div class="panel-body no-padding-top bg-white">																		
								<div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper">
									<div class="row">
										<table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
										<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Role Name: activate to sort column ascending">First Name</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Role Type: activate to sort column ascending">User Email</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Role Type: activate to sort column ascending">Username</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Role Type: activate to sort column ascending">Image</th>
												<th role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" title = "Edit Role Name" >Action</th>
										</thead>
											<tbody role="alert" aria-live="polite" aria-relevant="all">
												<?php if( count( $allUsers ) > 0 ) : ?>
											<?php
												$i = 0;foreach( $allUsers as $index => $value ) :
												$id = $value['User']['id'];	
												$alertClass = ( $value['User']['is_deleted'] == 1 ) ? "alert-danger" : "";
												$status 	= 	($value['User']['status'] == 1) ? "Deactive" : "Active";
												$isDeleted	=	$value['User']['is_deleted'];
												$value['User']['user_image'] ? $value['User']['user_image'] : $value['User']['user_image'] = "demo.png"												
											?>
													<tr class="odd <?php print $alertClass; ?> ">
														<td class="  sorting_1"><?php print $value['User']['id']; ?></td>
														<td class="  sorting_1"><?php print $value['User']['first_name']; ?></td>
														<td class="  sorting_1"><?php print $value['User']['email']; ?></td>
														<td class="  sorting_1"><?php print $value['User']['username']; ?></td>
														<td class="  sorting_1">
														<ul id="icons" class="iconButtons">
														<li>
														
														<?php 
														$value['User']['user_image']=="demo.png" ? $icon = '<img src="'.Router::url('/', true).'app/webroot/img/upload/'.$value['User']['user_image'].'" style="width:35px; height:35px; border-radius:50px;" />' : $icon = '<a href="#" data-toggle="modal" data-target=".pop-up-'.$i.'"><img src="'.Router::url('/', true).'app/webroot/img/upload/'.$value['User']['user_image'].'" style="width:35px; height:35px; border-radius:50px;" /></i></a>';												
														echo $icon;
														?>

														</li>
														</ul>
														<!--<img src="<?php echo Router::url('/', true).'app/webroot/img/upload/'.$value['User']['user_image']; ?>" style="width:50px; height:50px; border-radius:50px;" />-->

															<div class="modal fade pop-up-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
																<div class="modal-dialog modal-lg">
																  <div class="modal-content">

																	<div class="modal-header">
																	  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																	  <h4 class="modal-title" id="myLargeModalLabel-1">User Image</h4>
																	</div>
																	<div class="modal-body">
																	<img src="<?php echo Router::url('/', true).'app/webroot/img/upload/'.$value['User']['user_image']; ?>" class="img-responsive img-center" style="width:450px; " />
																	</div>
																  </div><!-- /.modal-content -->
																</div><!-- /.modal-dialog -->
															  </div><!-- /.modal mixer image -->
														</td>
														
														<td>														
														
															<ul id="icons" class="iconButtons">
															<a href="editUsers/<?php print $id; ?>" title="Edit" class="btn btn-success btn-xs margin-right-10"><i class="fa fa-pencil"></i></a>
															
															<a href="sendMail/<?php print $id;?>" title="Mail" class="btn btn-info btn-xs margin-right-10"><i class="fa fa-envelope"></i></a>
																
														
																<?php 	
																	if( $value['User']['status'] == 1 )	{	?>
																
																	<a href="lockUnlockUser/<?php print $id; ?>/<?php print $status; ?>/<?php print "userAction"; ?>" alt="Deactive" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-unlock"></i></a>
																	
																<?php } else { ?>
																
																<a href="lockUnlockUser/<?php print $id; ?>/<?php print $status; ?>/<?php print "userAction"; ?>" alt="Active" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-lock"></i></a>
																<?php } ?>
																<?php if( $value['User']['is_deleted'] == 1 ){ ?>
																
																<a href="deleteUser/<?php print $id; ?>/<?php print $isDeleted; ?>" alt="Retrieve" class="btn btn-danger btn-xs margin-right-10"><i class="ion-plus-circled"></i></a>
																
																
																<?php } else { ?>
																<a href="deleteUser/<?php print $id; ?>/<?php print $isDeleted; ?>" alt="Delete" class="btn btn-danger btn-xs margin-right-10"><i class="ion-minus-circled"></i></a>
																
													</ul>
													<?php } ?>	
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
			
		</div> 
    </div><!-- BEGIN FOOTER -->
			<?php echo $this->element('footer'); ?>
			<!-- END FOOTER -->
</div>

