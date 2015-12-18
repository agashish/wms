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
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending" aria-label="Id: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending" aria-label="Client: activate to sort column descending">Client</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending" aria-label="Country: activate to sort column ascending">Country</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending" aria-label="State: activate to sort column ascending">State</th>
												<!--<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending" aria-label="City: activate to sort column ascending">City</th>-->
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending" aria-label="City: activate to sort column ascending">Address</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending" aria-label="City: activate to sort column ascending">Return Address</th>
												<th rowspan="1" colspan="1" style="width: 177px;" >Client Image</th>												
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending" aria-label="Status Type: activate to sort column ascending">Status</th>
												<th rowspan="1" colspan="1" style="width: 177px;" title = "Edit County Name" >Action</th>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
                                    <?php
                                    //pr($getClientArray);
                                        $i = 0;foreach( $getClientArray as $index => $value ) :
                                        
                                        $id = $value['Client']['id'];
                                        $alertClass = ( $value['ClientDesc']['is_deleted'] == 1 ) ? "alert-danger" : "";
                                        $status = ( $value['Client']['status'] == 0 ) ? "Active" : "Deactive";
                                    ?>
                                            <tr class="odd <?php print $alertClass; ?> ">
												<td class="  sorting_1"><?php print $value['Client']['id']; ?></td>
												<td class="  sorting_1"><?php print $value['Client']['client_name']; ?></td>                                                
												<td class="  sorting_1"><?php print $value['Location']['county_name']; ?></td>
												<td class="  sorting_1"><?php print $value['State']['state_name']; ?></td>
                                                <!--<td class="  sorting_1"><?php print $value['City']['city_name']; ?></td>-->
                                                <td class="  sorting_1"><?php print $value['ClientDesc']['address']; ?></td>
                                                <td class="  sorting_1"><?php print $value['ClientDesc']['return_address']; ?></td>
												<td class="  sorting_1">
													<ul id="icons" class="iconButtons">
														<li>
														<?php 
														$value['ClientImage']['client_image']=="demo.png" ? $icon = '<img src="'.Router::url('/', true).'app/webroot/img/client/'.$value['ClientImage']['client_image'].'" style="width:35px; height:35px; border-radius:50px;" />' : $icon = '<a href="#" data-toggle="modal" data-target=".pop-up-'.$i.'"><img src="'.Router::url('/', true).'app/webroot/img/client/'.$value['ClientImage']['client_image'].'" style="width:35px; height:35px; border-radius:50px;" /></i></a>';												
														echo $icon;
														?>
														</li>
														</ul>
														
													<div class="modal fade pop-up-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
																<div class="modal-dialog modal-lg">
																  <div class="modal-content">

																	<div class="modal-header">
																	  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																	  <h4 class="modal-title" id="myLargeModalLabel-1">User Image</h4>
																	</div>
																	<div class="modal-body">
																	<img src="<?php echo Router::url('/', true).'app/webroot/img/client/'.$value['ClientImage']['client_image']; ?>" class="img-responsive img-center" style="width:450px; " />
																	</div>
																  </div><!-- /.modal-content -->
																</div><!-- /.modal-dialog -->
															  </div><!-- /.modal mixer image -->
													
													
													
													
													
													<?php
														//print $this->html->image( 'client/'.$value['ClientImage']['client_image'], array( "class" => "manage_image", "style" => "border-radius: 158px; height: 78px; width: 77px;", "title" => $value['Client']['client_name'] ) );
													?>
												</td>
                                                
                                                
                                                <td class="  sorting_1"><?php print $status; ?></td>
                                                <td>
													<ul id="icons" class="iconButtons">
													<a href="List/edit/<?php print $id; ?>" class="btn btn-success btn-xs margin-right-10"><i class="fa fa-pencil"></i></a>
													<?php
														if( $value['Client']['status'] == 1 )
														{
													?>
													<a href="List/lock/UnlockCL/<?php print $id; ?>/<?php print $status; ?>/<?php print "CLAction"; ?>" alt="Unlock" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-unlock"></i></a>
													<?php }	else {	?>
													<a href="List/lock/UnlockCL/<?php print $id; ?>/<?php print $status; ?>/<?php print "CLAction"; ?>" alt="Lock" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-lock"></i></a>
													<?php }	?>
													<?php
														if( $value['ClientDesc']['is_deleted'] == 1 )
														{
													?>
													<a href="List/delete/CL/<?php print $id; ?>/<?php print $value['ClientDesc']['is_deleted']; ?>" alt="Retrieve" class="btn btn-danger btn-xs"><i class="ion-plus-circled"></i></a>
													<?php
														}
														else
														{
													?>
													<a href="List/delete/CL/<?php print $id; ?>/<?php print $value['ClientDesc']['is_deleted']; ?>" alt="Delete" class="btn btn-danger btn-xs"><i class="ion-minus-circled"></i></a>
													<?php
														}
													?>
														
													<a href="/wms/clients/AddShippingDetail/<?php print $id; ?>" alt="Delete" class="btn btn-danger btn-xs"><i class="fa fa-th-list"></i></a>
													
													</ul>	
												</td>												
                                            </tr>
                                    <?php
                                        $i++;
                                        endforeach;
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

