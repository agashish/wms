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
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Country Name</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status Type: activate to sort column ascending">Status</th>
												<th rowspan="1" colspan="1" title = "Edit County Name" >Action</th>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
                                    <?php												
                                        $i = 0;foreach( $getLocationArray as $index => $value ) :
                                        $id = $value['Location']['id'];
                                        $status = ( $value['Location']['status'] == 0 ) ? "Active" : "Deactive";
                                    ?>
                                            <tr class="odd">
                                                <td class="  sorting_1"><?php print $value['Location']['id']; ?></td>
                                                <td class="  sorting_1"><?php print $value['Location']['county_name']; ?></td>
                                                <td class="  sorting_1"><?php print $status; ?></td>
                                                <td>
													<ul id="icons" class="iconButtons">
													<a href="editCounty/<?php print $id; ?>" class="btn btn-success btn-xs margin-right-10"><i class="fa fa-pencil"></i></a>
																										
													<?php
														if( $value['Location']['status'] == 1 )
														{
													?>
														
														<a href="lockUnlock/<?php print $id; ?>/<?php print $status; ?>/<?php print "countyAction"; ?>" alt="Unlock" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-unlock"></i></a>
														
													<?php
														}
														else
														{
													?>
															<a href="lockUnlock/<?php print $id; ?>/<?php print $status; ?>/<?php print "countyAction"; ?>" alt="Lock" class="btn btn-warning btn-xs margin-right-10"><i class="fa fa-lock"></i></a>
													<?php
														}
													?>
													
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

