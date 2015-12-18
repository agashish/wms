<div class="rightside bg-grey-100">
    <div class="page-head bg-grey-100">        
        <h1 class="page-title"><?php //print $role;?></h1>
				<div class="submenu">
					<div class="navbar-header">
						<ul class="nav navbar-nav pull-left">
							<li>
								<a class="switch btn btn-success" href="/wms/JijGroup/Showallplatformfee" data-toggle="modal" data-target=""><i class=""></i> Show Platform Fee </a>
							</li>
						</ul>
					</div>
				</div>
					<div class="panel-head"><?php print $this->Session->flash(); ?></div>
				</div>
				<div class="container-fluid">
					<div class="row">
					<?php
						print $this->form->create( 'AmazonFee', array( 'class'=>'form-horizontal', 'url' => '/Platformcharges/AddCategoryFee', 'type'=>'post','id'=>'amazonpplatformfee' ) );
						print $this->form->input( 'AmazonFee.id', array( 'type'=>'hidden') );
					?>
				<div class="col-lg-12 warehouseDetails">
				<div class="panel">
						<div class="panel-title">
							<div class="panel-head">Edit Category Fee</div>
						</div>
					<div class="panel-body">
                    <div class="row">
							<div class="col-lg-12">
								  <div class="form-group" >
									<label for="username" class="control-label col-lg-3">Categories</label>                                        
									<div class="col-lg-6">                                            
									   <?php
											print $this->form->input( 'AmazonFee.category', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
									   ?> 
									</div>
								  </div>
			
								  <div class="form-group" >
									<label for="username" class="control-label col-lg-3">Referral Fee, %</label>                                        
									  <div class="col-lg-6">                                            
										   <?php
												print $this->form->input( 'AmazonFee.referral_fee', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
										   ?> 
								    </div>
								  </div>
							
								  <div class="form-group" >
									<label for="username" class="control-label col-lg-3">Applicable Minimum Referral Fee</label>                                        
									 <div class="col-lg-6">                                            
									   <?php
											print $this->form->input( 'AmazonFee.app_min_referral_fee', array( 'type'=>'text', 'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
									   ?> 
									</div>
								 </div>
								 
								 <div class="form-group" >
									<label for="username" class="control-label col-lg-3">Country</label>                                        
									 <div class="col-lg-6">                                            
									   <?php
											if( count( $CountryList ) > 0 )
											print $this->form->input( 'AmazonFee.country', array( 'type'=>'select', 'empty'=>'Choose Country','options'=>$CountryList,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
									  ?> 
									</div>
								 </div>
								 
								 <div class="form-group" >
									<label for="username" class="control-label col-lg-3">Platform</label>                                        
									 <div class="col-lg-6">                                            
									   <?php
									   $platform	=	array('Amazon' => 'Amazon', 'Ebay' => 'Ebay', 'Magento' => 'Magento');
											if( count( $platform ) > 0 )
											print $this->form->input( 'AmazonFee.platform', array( 'type'=>'select', 'empty'=>'Choose Platform','options'=>$platform,'class'=>'form-control','data-style'=>'btn-dropdown', 'div'=>false, 'label'=>false, 'required'=>false) );
									  ?>  
									</div>
								 </div>
								 
							</div>
						</div>
						
						<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100" style="clear:both">                                                                            
							<a class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40" href="/wms/JijGroup/ShowAllCategoryFee">Go Back</a>
							<?php echo $this->Form->button( $title , array(
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
