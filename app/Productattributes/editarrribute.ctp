<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"></h1>
			<div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
								<a class="btn btn-success" href="/wms/Productattributes/addAttributeSet" data-toggle="modal" data-target=""><i class="fa fa-tasks"></i> Attributes Set </a>
							</li>
						</ul>
					</div>	
			</div>
		<div class="panel-head"><?php print $this->Session->flash(); ?></div>
    </div>
   
    <div class="container-fluid">
		 <div class="row">
					<?php
						print $this->form->create( 'Attribute', array( 'class'=>'form-horizontal', 'url' => '/Productattributes/addAttribute', 'type'=>'post','id'=>'warehouse' ) );
						print $this->form->input( 'Attribute.id', array( 'type'=>'hidden' ) );
						print $this->form->input( 'Attribute.attribute_code', array( 'type'=>'hidden','val'=>'' ) );
					?>
            <div class="col-lg-5 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
							<div class="panel-head">Edit Attribute</div>
						</div>
					<div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        
                                  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3"> Code </label>                                        
                                     <div class="col-lg-8">                                            
										<?php
											print $this->form->input( 'Attribute.attribute_code', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false) );
										?>
                                     </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3"> Label </label>                                        
                                     <div class="col-lg-8">                                            
										<?php
											print $this->form->input( 'Attribute.attribute_label', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false) );
										?>
                                     </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3"> Required </label>                                        
                                     <div class="col-lg-8">                                            
										<?php
											$required	=	array('0'=>'Yes', '1' => 'No');
											print $this->form->input( 'Attribute.is_required', array( 'type'=>'select', 'empty'=>'Choose Required','options'=>$required,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										?>
                                     </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3"> System Generated </label>                                        
                                     <div class="col-lg-8">                                            
										<?php
											$systemgen	=	array('0'=>'Yes', '1' => 'No');
											print $this->form->input( 'Attribute.system_generated', array( 'type'=>'select', 'empty'=>'Choose System Generated','options'=>$systemgen,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										?>
                                     </div>
                                  </div>
                                  
								  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3"> Type </label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
											$getType	=	Configure::read( 'attribute_type' );
											print $this->form->input( 'Attribute.attribute_type', array( 'type'=>'select', 'empty'=>'Choose Attribute Type','options'=>$getType,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
                                  
								  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3"> Status </label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
											$getType	=	array( '0'=>'Yes', '1'=>'No');
											print $this->form->input( 'Attribute.attribute_status', array( 'type'=>'select', 'empty'=>'Choose Status','options'=>$getType,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
							  </div>
						</div>
						<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
							
							<a href="/wms/Productattributes/addAttribute" class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" >Go Back</a>
							<?php
								echo $this->Form->button('Submit', array(
									'type' => 'submit',
									'escape' => true,
									'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
									 ));	
							?>
						</div>
					</div>
				</div>
			</form>
	    </div>
	    <!--------------------------------------- Left UI ------------------------------------------>
      <div class="col-lg-7">
			<div class="panel rackdetail" >
                <div class="panel-title">
					<div class="panel-head"> All Attributes</div>
					<div class="panel-tools">
						<a class="add_fieldset" id="btnAdd" style="display:none;" href="javascript:void(0);"><i class="fa fa-plus-circle"></i></a>
					</div>
				</div>
                <div class="panel-body attr_show">
					<table class="table table-bordered table-striped" id="example1" aria-describedby="example1_info">
													<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Name</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Code</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Type</th>
												<!--<th rowspan="1" colspan="1" title = "Edit County Name" >Action</th>-->
											</tr>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
											<?php												
												$i = 1;foreach( $allAttributes as $allAttribute ) { 
												$id = $allAttribute['Attribute']['id'];
												$alertClass = ( $allAttribute['Attribute']['is_deleted'] == 1 ) ? "alert-danger" : "";
												$status = ( $allAttribute['Attribute']['attribute_status'] == 0 ) ? "Active" : "Deactive";
											?>
                                            <tr class="odd <?php print $alertClass; ?>">
												<td class="  sorting_1"><?php echo $i; ?></td>
												<td class="  sorting_1"><?php echo $allAttribute['Attribute']['attribute_label']; ?></td>
												<td class="  sorting_1"><?php echo $allAttribute['Attribute']['attribute_code']; ?></td>
												<td class="  sorting_1"><?php echo $allAttribute['Attribute']['attribute_type']; ?></td>                                                
												<!--<td>
														<ul id="icons" class="iconButtons">
														<a href="/wms/Productattributes/editarrribute/<?php print $id; ?>" class="btn btn-success btn-xs margin-right-10" title="Edit Attribute"><i class="fa fa-pencil"></i></a>
														
														<?php if( $allAttribute['Attribute']['attribute_status'] == 1 ) { ?>
															<a href="/wms/Productattributes/lockunlockattr/<?php print $id; ?>/<?php print $status; ?>" class="btn btn-info btn-xs margin-right-10" title="Deactive Attribute" ><i class="fa fa-lock"></i></a>
														<?php } else { ?>
															<a href="/wms/Productattributes/lockunlockattr/<?php print $id; ?>/<?php print $status; ?>" class="btn btn-info btn-xs margin-right-10" title="Active Attribute"><i class="fa fa-unlock"></i></a>
														<?php }	if( $allAttribute['Attribute']['system_generated'] == '0' ) { ?>
															<a href="deleteAttr/<?php print $id; ?>/<?php print $allAttribute['Attribute']['is_deleted']; ?>" class="btn btn-danger btn-xs margin-right-10" title="Retrieved Attribute"><i class="fa fa-close"></i></a>
														<?php } ?>
														<?php if( $allAttribute['Attribute']['attribute_type'] == 'Multiple Select' || $allAttribute['Attribute']['attribute_type'] == 'Dropdown') { ?>
															<a href="addoptions/<?php print $id; ?>" class="btn btn-warning btn-xs margin-right-10" title="Add Attribute Option"><i class="fa fa-navicon"></i></a>
														<?php } ?>
														</ul>
												</td>-->	
										    </tr>
											<?php $i++; } ?>
										</tbody>
									</table>	
							</div>
						</div>
					</div>
	</div>        
</div>
