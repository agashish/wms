<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>
		<div class="submenu">
					<div class="navbar-header">
				<ul class="nav navbar-nav pull-left">
					<li>
						<a class="btn btn-success" href="/wms/attribute" data-toggle="modal" data-target="">
							<i class="fa fa-server" style="transform: rotate(-90deg);"></i> Add Attribute 
						</a>
					</li>
				</ul>
			</div>	
				</div>
			<div class="panel-title no-radius bg-green-500 color-white no-border">
				<div class="panel-head"><?php print $this->Session->flash(); ?></div>
			</div>
		
    </div>
    <!-- END PAGE HEADING -->
    <div class="container-fluid">
        <div class="row">
					<?php
						print $this->form->create( 'Attribute', array( 'class'=>'form-horizontal', 'url' => '/addattribute', 'type'=>'post','id'=>'warehouse' ) );
						print $this->form->input( 'Attribute.id', array( 'type'=>'hidden' ) );
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
                                    <label for="username" class="control-label col-lg-3"> Name </label>                                        
                                     <div class="col-lg-8">                                            
										<?php
											print $this->form->input( 'Attribute.attribute_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
										?>
                                       </div>
                                  </div>
                                  
								  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3"> Type </label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
											$getType	=	Configure::read( 'attribute_type_key' );
											print $this->form->input( 'Attribute.attribute_type', array( 'type'=>'select', 'empty'=>'Choose Attribute Type','options'=>$getType,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
                                  
							</div>
						</div>
						<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
                            <a class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" href="/wms/attribute">Cancel</a>
							<?php
								echo $this->Form->button('Edit Attribute', array(
									'type' => 'submit',
									'escape' => true,
									'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
									 ));	
							?>
						</div>
					</div>
	        </div><!-- /.col -->
			</form>
	    </div><!-- /.row -->
		<div class="col-lg-7 ">
			<div class="panel rackdetail" >
                <div class="panel-title">
					<div class="panel-head">All Attributes</div>
					<div class="panel-tools">
						<a class="add_fieldset" id="btnAdd" style="display:none;" href="javascript:void(0);"><i class="fa fa-plus-circle"></i></a>
					</div>
				</div>
                <div class="panel-body">
					<table class="table table-bordered table-striped" id="example1" aria-describedby="example1_info">
													<thead>
											<tr role="row">
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending">Id</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Warehouse Name: activate to sort column descending">Name</th>
												<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="County Name: activate to sort column ascending">Type</th>
												<th rowspan="1" colspan="1" title = "Edit County Name" >Action</th>
										</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
											<?php												
												$i = 1;foreach( $allAttributes as $allAttribute ) {
												$id = $allAttribute['Attribute']['id'];
												$alertClass = ( $allAttribute['Attribute']['is_deleted'] == 1 ) ? "alert-danger" : "";
												$status = ( $allAttribute['Attribute']['status'] == 0 ) ? "Active" : "Deactive";
											?>
                                            <tr class="odd <?php print $alertClass; ?>">
												<td class="  sorting_1"><?php echo $i; ?></td>
												<td class="  sorting_1"><?php echo $allAttribute['Attribute']['attribute_name']; ?></td>
												<td class="  sorting_1"><?php echo $allAttribute['Attribute']['attribute_type']; ?></td>                                                
												<td>
													<ul id="icons" class="iconButtons">
														<a href="<?php print $id; ?>" class="btn btn-success btn-xs margin-right-10" title="Edit Attribute"><i class="fa fa-pencil"></i></a>
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
			</div>

