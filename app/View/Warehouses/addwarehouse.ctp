<div class="rightside bg-grey-100">
    <!-- BEGIN PAGE HEADING -->
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php print $role;?></h1>
		<div class="submenu">
					<div class="navbar-header">
				<ul class="nav navbar-nav pull-left">
				<li>
								<a class="btn btn-success" href="#" data-toggle="modal" data-target=".pop-up-5"><i class="fa fa-server" style="transform: rotate(-90deg);"></i> Manage Section </a>
							</li>
							<li>
								<a class="btn btn-success" href="#" data-toggle="modal" data-target=".pop-up-3"><i class="fa fa-tasks"></i> Manage Level </a>
							</li>
							<li>
								<a class="btn btn-success" href="#" data-toggle="modal" data-target=".pop-up-1"><i class="fa fa-archive"></i> Manage Bin </a>
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
                                print $this->form->create( 'Warehouse', array( 'class'=>'form-horizontal', 'url' => '/manageWarehouse', 'type'=>'post','id'=>'warehouse' ) );
                                print $this->form->input( 'Warehouse.id', array( 'type'=>'hidden' ) );
								print $this->form->input( 'WarehouseDesc.id', array( 'type'=>'hidden' ) );
                            ?>
            <div class="col-lg-12 warehouseDetails">
              <div class="panel">
						<div class="panel-title">
									<div class="panel-head">Warehouse Details</div>
									
						</div>
					<div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                                
                                <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Type</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
												$getType	=	array('1' => 'Default', '2' => 'FBA( amazon )');
                                                print $this->form->input( 'WarehouseDesc.warehouse_type', array( 'type'=>'select', 'empty'=>'Choose Warehouse Type','options'=>$getType,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
                                
                                <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Country</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
                                                if( count( $getLocationArray ) > 0 )
                                                    print $this->form->input( 'WarehouseDesc.location_id', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$getLocationArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>                           
								  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">State</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
                                                if( count( $getStateList ) > 0 )
                                                    print $this->form->input( 'WarehouseDesc.state_id', array( 'type'=>'select', 'empty'=>'Choose State','options'=>$getStateList,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
						          <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">City</label>                                        
                                    <div class="col-lg-8">                                            
                                        <?php
                                                    print $this->form->input( 'WarehouseDesc.city_id', array( 'type'=>'text','class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
                                        ?>  
                                    </div>
                                  </div>
								  
                                  <div class="form-group">
                                    <label for="username" class="control-label col-lg-3">Name</label>                                        
                                     <div class="col-lg-8">                                            
                                            <?php
                                                print $this->form->input( 'Warehouse.warehouse_name', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                     <label for="username" class="control-label col-lg-3">Phone</label>                                        
                                     <div class="col-lg-8">                                            
                                           <?php
                                                print $this->form->input( 'WarehouseDesc.warehouse_number', array( 'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control', 'required'=>false ) );
                                            ?>
                                     </div>
                                  </div>
								  <div class="form-group">
									 <label for="username" class="control-label col-lg-3">Status</label>                                        
									 <div class="col-lg-8">                                            
										<?php
												$statusArray = Configure::read( 'status_key' );
												if( count( $statusArray ) > 0 )
													print $this->form->input( 'Warehouse.status', array( 'type'=>'select', 'empty'=>'Choose Status','options'=>$statusArray,'class'=>'form-control selectpicker','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										?> 
									 </div>
                                  </div>
							</div>
						</div>
					</div>
            </div><!-- /.col -->
			
			
        </div><!-- /.row -->
		<div class="col-lg-6 rackDetails">
			<div class="panel rackdetail" style="display:none;">
                <div class="panel-title">
					<div class="panel-head">Rack Details</div>
					<div class="panel-tools">
						<a class="add_fieldset" id="btnAdd" style="display:none;" href="javascript:void(0);"><i class="fa fa-plus-circle"></i></a>
					</div>
				</div>
                <div class="panel-body">
					<div class="row rack_block" style="display:none;" >
						<div class="rackContainer">
							<div class="col-lg-3">
								<div class="rackBox">
									<a class="add_rack btn btn-labeled btn-success panel-tile margin-bottom-10">
										<span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>New
									</a>
										<span class="label bg-red-500 border-grey-100 label-rounded"> 1</span>
								</div>
								<?php
									print $this->form->input( ' ', array( 'type'=>'hidden','div'=>false,'label'=>false,'default'=>'1','class'=>'form-control', 'required'=>false , 'name' => 'data[WarehouseRack][warehouse_rack_label][]') );
								?>
							</div>
						</div>
					</div>
			       </div>
                  </div>
				</div>
				
				<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
                                     <?php
											echo $this->Form->button(
												'Go Back', 
												array(
													'formaction' => Router::url(
														array('controller' => 'showallWarehouses')
													 ),
													'escape' => true,
													'class'=>'btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40'	
												)
											);	
									?>
                                     
									<?php
											echo $this->Form->button('Add Warehouse', array(
												'type' => 'submit',
												'escape' => true,
												'class'=>'btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
										         ));	
									?>
			
				</div>
			</form>
		<!-- Start here listing of countries whose would be active or deactive -->
    </div>        
</div>

<script>
	
</script>
