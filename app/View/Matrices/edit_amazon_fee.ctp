<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php //print $role;?></h1>
				<div class="submenu">
					<div class="navbar-header">
				</div>	
				</div>
					<div class="panel-head"><?php print $this->Session->flash(); ?></div>
				</div>
				<div class="container-fluid">
					<div class="row">
					<?php
						print $this->form->create( 'AmazonPlatformFee', array( 'class'=>'form-horizontal', 'url' => '/Matrices/addAmazonPlatformFee', 'type'=>'post','id'=>'amazonpplatformfee' ) );
						print $this->form->input( 'AmazonPlatformFee.id', array( 'type'=>'hidden') );
					?>
				<div class="col-lg-12 warehouseDetails">
				<div class="panel">
						<div class="panel-title">
							<div class="panel-head">Add Platform Fee</div>
						</div>
				<div class="panel-body">
				<div class="row">
					<div class="col-lg-4">
						  <div class="form-group" >
							<label for="username" class="control-label col-lg-3">Packaging Type</label>                                        
							<div class="col-lg-6">                                            
							   <?php
									print $this->form->input( 'AmazonPlatformFee.packaging_type', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							   ?> 
							</div>
						  </div>
						  <div class="form-group" >
							<label for="username" class="control-label col-lg-3">Fee</label>                                        
							  <div class="col-lg-6">                                            
								   <?php
										print $this->form->input( 'AmazonPlatformFee.fee', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
								   ?> 
							  </div>
						 </div>
					     <div class="form-group" >
							<label for="username" class="control-label col-lg-3">Country</label>                                        
							  <div class="col-lg-6">                                            
								  <?php
									if( count( $CountryList ) > 0 )
									print $this->form->input( 'AmazonPlatformFee.country', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$CountryList,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
								   ?>  
							  </div>
						</div>
						<div class="form-group" >
							<label for="username" class="control-label col-lg-3">Min Weight</label>                                        
							<div class="col-lg-6">                                            
							   <?php
									print $this->form->input( 'AmazonPlatformFee.min_weight', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							   ?> 
							</div>
						 </div>
						 <div class="form-group" >
							<label for="username" class="control-label col-lg-3">Max Weight</label>                                        
							<div class="col-lg-6">                                            
							   <?php
									print $this->form->input( 'AmazonPlatformFee.max_weight', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							   ?> 
							</div>
						 </div>
					</div>
					<div class="col-lg-4">
						  <div class="form-group" >
							<label for="username" class="control-label col-lg-3">Length</label>                                        
							<div class="col-lg-6">                                            
							   <?php
									print $this->form->input( 'AmazonPlatformFee.length', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							   ?> 
							</div>
						  </div>
						  <div class="form-group" >
							<label for="username" class="control-label col-lg-3">Width</label>                                        
							<div class="col-lg-6">                                            
							   <?php
									print $this->form->input( 'AmazonPlatformFee.width', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							   ?> 
							</div>
						  </div>
						  <div class="form-group" >
							<label for="username" class="control-label col-lg-3">Height</label>                                        
							<div class="col-lg-6">                                            
							   <?php
									print $this->form->input( 'AmazonPlatformFee.height', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							   ?> 
							</div>
						  </div>
						  <div class="form-group" >
							<label for="username" class="control-label col-lg-3">Packaging Min Fee</label>                                        
							<div class="col-lg-6">                                            
							   <?php
									print $this->form->input( 'AmazonPlatformFee.packaging_min_fee', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							   ?> 
							</div>
						  </div>
						  <div class="form-group" >
							<label for="username" class="control-label col-lg-3">Packaging Max Fee</label>                                        
							<div class="col-lg-6">                                            
							   <?php
									print $this->form->input( 'AmazonPlatformFee.packaging_max_fee', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
							   ?> 
							</div>
						  </div>
							</div>
						</div>
						<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
							<a class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" href="/wms/JijGroup/Showallplatformfee">Go Back</a>
							<?php echo $this->Form->button( 'Edit Platform Fee', array(
									'type' => 'submit',
									'escape' => true,
									'class'=>'add_attribute btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40'
									));	
							?>
						</div>
					</div>
				</div>	
			</form>
	    </div>
	</div>        
</div>
